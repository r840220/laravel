<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('ProductController.index') }}">阿榮~~</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">全部 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">全部</a></li>
            <li role="separator" class="divider"></li>
          @for($i = 0, $count = count(request()->product_type); $i < $count; $i++)
            @if(request()->product_type[$i]->level == 1 )
                <li><a>{{ request()->product_type[$i]->name }}</a></li>
              @endif
            @endfor
            <!--
            <li><a href="#">電腦</a></li>
            <li><a href="#">&nbsp 桌上型電腦</a></li>
            <li><a href="#">&nbsp 筆記型電腦</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">電腦周邊</a></li>
            <li><a href="#">零件</a> </li>
            <li role="separator" class="divider"></li>
            <li><a href="#">家電</a></li>
            -->
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="商品搜尋">
        </div>
        <button type="submit" class="btn btn-default">搜尋</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('sale.index') }}" id = 'shopping_cart'>購物車{{ session()->get('cart') ? '('.session()->get('cart')->total_Qty.')' : '' }}</a></li>
        <li class="dropdown">
          @if(Auth::check())
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi~ {{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="#">會員資料</a></li>
              <li><a href="#">訂單查詢</a></li>
              <li><a href="#">歷史訂單</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('user.logout') }}">登出</a></li>
            @else
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">會員中心 <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href=" {{ route('user.signin') }}">會員登入</a> </li>
              <li><a href="{{ route('user.signup') }}">會員註冊</a> </li>
            @endif
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
