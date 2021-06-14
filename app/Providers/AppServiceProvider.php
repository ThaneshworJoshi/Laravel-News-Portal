<?php

namespace App\Providers;

use App\Category;
use App\Post;
use App\Setting;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting = Setting::all();

        foreach ($setting as $key => $value) {

            if ($key === 0) {
                $system_name = $setting[0]->value;
            } else if ($key === 1) {
                $favicon = $setting[1]->value;
            } else if ($key === 2) {
                $front_logo = $setting[2]->value;
            } else if ($key === 3) {
                $admin_logo = $setting[3]->value;
            }
        }
        $categories = Category::where('status', 1)->get();
        $auhors = User::where('id', '<>', 1)->get();
        $most_viewed = Post::with(['creator', 'comments'])->where('status', 1)->orderBy('view_count', 'DESC')->limit(5)->get();
        $most_commented = Post::withCount(['comments'])->where('status', 1)->orderBy('comments_count', 'DESC')->limit(5)->get();

        $shareData = array(
            'system_name' => $system_name,
            'favicon' => $favicon,
            'front_logo' => $front_logo,
            'admin_logo' => $admin_logo,
            'categories' => $categories,
            'authors' => $auhors,
            'most_viewed' => $most_viewed,
            'most_commented' => $most_commented,
        );
        view()->share('shareData', $shareData);
    }
}
