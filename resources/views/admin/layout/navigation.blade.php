<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            {{-- http://127.0.0.1:8000/others/admin_logo.jpeg --}}
            <a class="navbar-brand" href="{{ url('/back') }}"><img src="{{ asset('others/') }}/{{ $shareData['admin_logo'] }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="{{  url('/back') }}"><img src="{{ asset('others/') }}/{{ $shareData['admin_logo'] }}" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('/back') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    {{-- @permission(['Permission Add', 'All']) --}}
                    @ability('Master Admin, Blogger', 'All, Post List')
                        <a href="{{ url('/back/permission') }}"> <i class="menu-icon fa fa-dashboard"></i>Permission </a>
                    @endability
                    {{-- @endpermission --}}
                    <a href="{{ url('/back/roles') }}"> <i class="menu-icon fa fa-dashboard"></i>Roles </a>
                    <a href="{{ url('/back/authors') }}"> <i class="menu-icon fa fa-dashboard"></i>Authors </a>
                    @ability('Master Admin', 'Category List,All')
                    <a href="{{ url('/back/categories') }}"> <i class="menu-icon fa fa-dashboard"></i>Categories </a>
                    @endability
                    @ability('Master Admin,Blogger,Editor', 'All,Post List')
                        <a href="{{ url('/back/posts') }}"> <i class="menu-icon fa fa-dashboard"></i>Posts </a>
                    @endability
                    @ability('Master Admin,Blogger,Editor', 'All,Post List')
                        <a href="{{ url('/back/setting') }}"> <i class="menu-icon fa fa-dashboard"></i>Setting </a>
                    @endability
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->
