    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <ul class="nav menu">
            <li class="active"><a href="{{route('dashboard')}}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
            <li><a href="{{route('user')}}"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>Users</a></li>
            <li><a href="{{route('getLocation')}}"><svg class="glyph stroked location pin"><use xlink:href="#stroked-location-pin"/></svg> Locations</a></li>
            <li><a href="{{route('CategoresOfFoods')}}"><svg class="glyph stroked bacon burger"><use xlink:href="#stroked-bacon-burger"/></svg> Category of Foods</a></li>
            <li><a href="{{route('getFoods')}}"><svg class="glyph stroked bacon burger"><use xlink:href="#stroked-bacon-burger"/></svg> Foods</a></li>
          
            <li><a href="{{route('getslider')}}"> <i class="glyphicon glyphicon-film"> </i>&nbsp;&nbsp;  Slider</a></li>
            <li><a href="{{route('getBookmark')}}"><i class="glyphicon glyphicon-globe"></i>&nbsp;&nbsp;  Bookmarks</a></li>
            <li><a href="{{route('getTypeofFood')}}"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;Type of  Food</a></li>
             <li><a href="{{route('getTypeofPlace')}}"><i class="glyphicon glyphicon-tint"></i>&nbsp;&nbsp;&nbsp;&nbsp;Place</a></li>
             <li><a href="{{route('getStore')}}"><svg class="glyph stroked location pin"><use xlink:href="#stroked-location-pin"/></svg> Restaurant</a></li>
            <li><a href="{{route('getListFood')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;List Foods</a></li>
            <li ><a href="{{route('getBackground')}}"><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Background</a></li>
             <li ><a href="{{route('getAbout')}}"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;About Us</a></li>
            <li><a href="{{route('logout')}}"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Logout Page</a></li>
        </ul>

    </div><!--/.sidebar-->\