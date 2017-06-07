@extends('layouts.master')

@section('content')
    <div id ="content" class="row">
        <div class="col-md-6 col-md-offset-1">
            <h1>購物車商品</h1>
           <ul class="list-group">
                <li class="list-group-item">
                    <ul class="list-inline">
                        <li>商品</li>
                        <li>數量</li>
                        <li>價格</li>
                        <li>小計</li>
                    </ul>
                </li>
               <?php $cart = session()->get('cart')->items ?>
               @foreach($cart as $item)
                <li class="list-group-item">
                    <ul class="list-inline">
                        <li>{{ $item['item']['title'] }}</li>
                        <li>{{ $item['qty'] }}</li>
                        <li>{{ $item['price'] }}</li>
                    </ul>
                </li>
                @endforeach
               <li class="list-group-item">
                   <ul class="list-inline">
                       <li>總數量:{{ session()->get('cart')->total_Qty }}</li>
                       <li>總價格:{{ session()->get('cart')->total_Price }}</li>
                   </ul>
               </li>
            </ul>

            <h1>購買人資訊</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{ route('sale.create_order') }}">
                <ul class="list-group">
                    {{ csrf_field() }}
                    <li class="list-group-item">會員姓名:
                        <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                    </li>
                    <li class="list-group-item">住址:
                        <input type="text" name="address" id="address" class="form-control" value="{{ Auth::user()->address }}">
                    </li>
                    <li class="list-group-item">電話:
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ Auth::user()->phone }}">
                    </li>
                    <li class="list-group-item">信箱:
                        <input type="text" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
                    </li>
                </ul>
                <button type="submit" class="btn-primary">確認送出</button>
            </form>
        </div>
    </div>
@endsection
