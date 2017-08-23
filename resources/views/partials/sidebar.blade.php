<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">Modificar</a></li>
                        <li><a href="#">Reportar</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Informes</a></li>
                    </ul>
                </li>

                <li ><a href="#">Libros<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>
                <li ><a href="#">Tags<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
                -->
                @for($i = 0, $count = count(request()->product_type); $i < $count; $i++)
                    @if(request()->product_type[$i]->level == 1 )
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ request()->product_type[$i]->name }}<span class="caret"></span><!--<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span>--></a>
                            <ul class="dropdown-menu forAnimate" role="menu">
                                @for($j = $i; $j < $count; $j++)
                                    @if(request()->product_type[$j]->parent == request()->product_type[$i]->id)
                                        <li><a href="{{ route('ProductController.getPage') }}?type={{ request()->product_type[$j]->id  }}">{{ request()->product_type[$j]->name }}</a></li>
                                    @endif
                                @endfor
                            </ul>
                        </li>
                    @endif
                @endfor
            </ul>
        </div>
    </div>
</nav>