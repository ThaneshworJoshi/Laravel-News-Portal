@extends('front.layout.master')
@section('content')
        
    <section class="breadcrumb_section">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Tech</a></li>
                    <li class="active"><a href="#">Mobile</a></li>
                </ol>
            </div>
        </div>
    </section>

    <div class="container">
    <div class="row">
    <div class="col-md-8">

    @foreach ($posts as $key=>$post)
        @if($key == 0)

            <div class="entity_wrapper">
                <div class="entity_title header_purple">
                    <h1><a href="{{ url('/category') }}/{{ $post->category_id }}">{{ $post->category->name }}</a></h1>
                </div>
                <!-- entity_title -->

                <div class="entity_thumb">
                    <img class="img-responsive" src="{{ asset('/post') }}/{{ $post->main_image }}" alt="{{ $post->title }}">
                </div>
                <!-- entity_thumb -->

                <div class="entity_title">
                    <a href="{{ url('/details') }}/{{ $post->slug }}" ><h3>{{ $post->title }} </h3></a>
                </div>
                <!-- entity_title -->

                <div class="entity_meta">
                    <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ date('F j,Y', strtotime($post->created_at)) }}</a>, by: <a href="{{ url('/author') }}/ {{ $post->creator->id }} ">{{ $post->creator->name }}</a>
                </div>
                <!-- entity_meta -->

                <div class="entity_content">
                    {{ Str::limit($post->description, 200, '...') }}
                </div>
                <!-- entity_content -->

                <div class="entity_social">
                    <span><i class="fa fa-share-alt"></i>424 <a href="#">Shares</a> </span>
                    <span><i class="fa fa-comments-o"></i>66 <a href="#">Comments</a> </span>
                </div>
                <!-- entity_social -->

            </div>
            <!-- entity_wrapper -->
       
        @else 
        @if($key == 1)
        <div class="row">
        @endif
            <div class="col-md-6">
                <div class="category_article_body">
                    <div class="top_article_img">
                        <img class="img-fluid" src="{{ asset('/post') }}/{{ $post->list_image }}" alt="feature-top">
                    </div>
                    <!-- top_article_img -->

                    <div class="category_article_title">
                        <h5><a href="{{ url('/details') }}/{{ $post->slug }}" target="_blank">{{ Str::limit($post->short_description, 100, '...') }} </a></h5>
                    </div>
                    <!-- category_article_title -->

                    <div class="article_date">
                        <a href="#">{{ date('F j,Y', strtotime($post->created_at)) }}</a>, by: <a href="#">{{ $post->creator->name }}</a>
                    </div>
                    <!-- article_date -->

                    <div class="category_article_content">
                       {{ Str::limit($post->description, 200, '...') }}
                    </div>
                    <!-- category_article_content -->

                    <div class="article_social">
                        <span><a href="#"><i class="fa fa-share-alt"></i>424 </a> Shares</span>
                        <span><i class="fa fa-comments-o"></i>{{ count($post->comments) }}<a href="#"></a> Comments</span>
                    </div>
                    <!-- article_social -->

                </div>
                <!-- category_article_body -->

            </div>
            <!-- col-md-6 -->
            @if ($loop->last)
          
        </div>
        @endif
        @endif
        @endforeach
        <!-- row -->

        <div style="margin-left:40%">
            {{ $posts->links() }}
        </div>

        <div class="widget_advertisement">
            <img class="img-responsive" src="{{ asset('front/assets/img/category_advertisement.jpg') }}" alt="feature-top">
        </div>
        <!-- widget_advertisement -->
    
       
   <!-- row -->
{{-- 
    <nav aria-label="Page navigation" class="pagination_section">
        <ul class="pagination">
            <li>
                <a href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a>
            </li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
                <a href="#" aria-label="Next" class="active"> <span aria-hidden="true">&raquo;</span> </a>
            </li>
        </ul>
    </nav> --}}
    <!-- navigation -->

    </div>
    <!-- col-md-8 -->

<div class="col-md-4">
        <div class="widget">
            <div class="widget_title widget_black">
                <h2><a href="#">Most Viewed</a></h2>
            </div>
        
            @foreach ($shareData['most_viewed'] as $post)
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('/post/') }}/{{ $post->thumb_image }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">{{ $post->title }}</a>
                    </h3> <span class="media-date"><a href="#">{{  date('j F -y', strtotime($post->created_at)) }}</a>,
                          by: <a href="{{ url('/author') }}/{{ $post->creator->id }}">{{ $post->creator->name }}</a></span>
        
                    <div class="widget_article_social">
                        <span>
                            <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self"> <i class="fa fa-share-alt"></i>424</a> Shares
                        </span> 
                        <span>
                            <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self"><i class="fa fa-comments-o"></i>{{ count($post->comments) }}</a> Comments
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        
            <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
        </div>
        <!-- Popular News -->
        
        <div class="widget hidden-xs m30">
            <img class="img-responsive adv_img" src="{{ asset('front/assets/img/right_add1.jpg') }}" alt="add_one">
            <img class="img-responsive adv_img" src="{{ asset('front/assets/img/right_add2.jpg') }}" alt="add_one">
            <img class="img-responsive adv_img" src="{{ asset('front/assets/img/right_add3.jpg') }}" alt="add_one">
            <img class="img-responsive adv_img" src="{{ asset('front/assets/img/right_add4.jpg') }}" alt="add_one">
        </div>
        <!-- Advertisement -->
        
        <div class="widget hidden-xs m30">
            <img class="img-responsive widget_img" src="{{ asset('front/assets/img/right_add5.jpg') }}" alt="add_one">
        </div>
        <!-- Advertisement -->
        
        <div class="widget reviews m30">
            <div class="widget_title widget_black">
                <h2><a href="#">Reviews</a></h2>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('front/assets/img/pop_right1.jpg') }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">DSLR is the most old camera at this time readmore about new
                            products</a>
                    </h3> 
                    <span class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i>
                    </span>
                </div>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('front/assets/img/pop_right2.jpg') }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body"><h3 class="media-heading"><a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">Samsung is the best
                    mobile in the android market.</a></h3> <span class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i>
                    </span></div>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('front/assets/img/pop_right3.jpg') }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">Apple launches photo-centric wrist watch for Android</a>
                    </h3> 
                    <span class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i>
                    </span></div>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('front/assets/img/pop_right4.jpg') }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">Yasaki camera launches new generic hi-speed shutter camera.</a>
                    </h3> 
                    <span class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-full"></i>
                    </span></div>
            </div>
            <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
        </div>
        <!-- Reviews News -->
        
        <div class="widget hidden-xs m30">
            <img class="img-responsive widget_img" src="{{ asset('front/assets/img/right_add6.jpg') }}" alt="add_one">
        </div>
        <!-- Advertisement -->
        
        <div class="widget m30">
            <div class="widget_title widget_black">
                <h2><a href="#">Most Commented</a></h2>
            </div>
            @foreach ($shareData['most_commented'] as $post)
            <div class="media">
                <div class="media-left">
                    <a href="#"><img class="media-object" src="{{ asset('/post') }}/{{ $post->thumb_image }}" alt="Generic placeholder image"></a>
                </div>
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url('/details') }}/{{ $post->slug }}" target="_self">{{ $post->title }}.</a>
                    </h3>
        
                    <div class="media_social">
                        <span><i class="fa fa-comments-o"></i><a href="#">{{ $post->comments_count }}</a> Comments</span>
                    </div>
                </div>
            </div>
            @endforeach
            <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&nbsp;&raquo; </a></p>
        </div>
        <!-- Most Commented News -->
        
        <div class="widget m30">
            <div class="widget_title widget_black">
                <h2><a href="#">Editor Corner</a></h2>
            </div>
            <div class="widget_body"><img class="img-responsive left" src="{{ asset('front/assets/img/editor.jpg') }}"
                                          alt="Generic placeholder image">
        
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                    users after installed base benefits. Dramatically visualize customer directed convergence without</p>
        
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                    users after installed base benefits. Dramatically visualize customer directed convergence without
                    revolutionary ROI.</p>
                <button class="btn pink">Read more</button>
            </div>
        </div>
        <!-- Editor News -->
        
        <div class="widget hidden-xs m30">
            <img class="img-responsive add_img" src="{{ asset('front/assets/img/right_add7.jpg') }}" alt="add_one">
            <img class="img-responsive add_img" src="{{ asset('front/assets/img/right_add7.jpg') }}" alt="add_one">
            <img class="img-responsive add_img" src="{{ asset('front/assets/img/right_add7.jpg') }}" alt="add_one">
            <img class="img-responsive add_img" src="{{ asset('front/assets/img/right_add7.jpg') }}" alt="add_one">
        </div>
        <!--Advertisement -->
        
        <div class="widget m30">
            <div class="widget_title widget_black">
                <h2><a href="#">Readers Corner</a></h2>
            </div>
            <div class="widget_body"><img class="img-responsive left" src="{{ asset('front/assets/img/reader.jpg') }}"
                                          alt="Generic placeholder image">
        
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                    users after installed base benefits. Dramatically visualize customer directed convergence without</p>
        
                <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                    users after installed base benefits. Dramatically visualize customer directed convergence without
                    revolutionary ROI.</p>
                <button class="btn pink">Read more</button>
            </div>
        </div>
        <!--  Readers Corner News -->
        
        <div class="widget hidden-xs m30">
            <img class="img-responsive widget_img" src="{{ asset('front/assets/img/podcast.jpg') }}" alt="add_one">
        </div>
        <!--Advertisement-->
        </div>
    <!-- col-md-4 -->

    </div>
    <!-- row -->

    </div>
    <!-- container -->
@endsection