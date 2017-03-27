<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><span>
                    @if(Auth::check())
                        {{Auth::user()->username}}
                    @endif
                </span>Admin</a>
                <ul class="user-menu">
                    <a href="{{route('getStoreRequest')}}" style="position: relative;"><i class="glyphicon glyphicon-globe" style="font-size:16px;"></i>
                        @php
                            $storeRequest=App\Models\Store::where('approval','0')->get();

                        @endphp
                    <span class="span noti" style="position: absolute;left: -6px;top: -12px;color: white;">
                        {{count($storeRequest)}}
                    </span>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <li class="dropdown pull-right" style="margin:0px 10px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-stop" ></i> Restuarant <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('csv')}}"><i class="fa fa-upload" ></i> Import</a></li>
                            <li><a href="{{route('export')}}"><i class="fa fa-download" ></i> Export</a></li>
                           
                          
                        </ul>
                    </li>
                     <li class="dropdown pull-right" style="margin-left:15px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Account<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('updateprofile',array('user'=>\Auth::user()->id))}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                            <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                            <li><a href="{{route('logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
                            
        </div><!-- /.container-fluid -->
    </nav>