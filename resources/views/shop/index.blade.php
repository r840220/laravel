@extends('layouts.master')

@section('content')
    <div id="csrf_token" style="display: none" >{{ csrf_token() }}</div>
    <div id ="content" class="row" style="margin-left:200px">
        @if(isset($total))
            <h4>總共搜尋到:{{ $total }}</h4>
        @endif
    @foreach($product->chunk(3) as $productchunk)
        @foreach($productchunk as $product)

                <div class="col-sm-6 col-md-4" style="max-width: 430px; min-width:200px">
                    <div class="thumbnail">
                        <img class = "item_img" src="{{URL::asset('image'). '/' . $product->id . '.jpg'}}" alt="...">
                        <div class="caption">
                            <h3 class="item_h3">{{$product->title}}</h3>
                            <h6>{{$product->price}}</h6>
                            <!--<p>{{$product->description}}</p>-->
                            <p><a class="btn btn-primary" role="button" data-id = "{{ $product->id }}">加入購物車</a></p>
                        </div>
                    </div>
                </div>
        @endforeach

    @endforeach
        <ul class="pagination">
            @if($page != 0)
                <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}">&laquo;</a></li>
            @endif
            @if($page >= 2)
                <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}&page={{ $page-2 }}">{{ $page-1 }}</a></li>
            @endif
            @if($page >= 1)
                <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}&page={{ $page-1 }}">{{$page}}</a></li>
            @endif
            <li><a>{{ $page+1 }}</a></li>
                @if($page < ($total/9)-1)
                    <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}&page={{ $page+1 }}">{{ $page+2 }}</a></li>
                @endif
                @if($page < $total/9-2)
                    <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}&page={{ $page+2 }}">{{$page+3}}</a></li>
                @endif
                @if($page != floor($total/9))
            <li><a href="{{ route('ProductController.getPage') }}?{{ $condition }}&page={{ floor($total/9) }}">&raquo;</a></li>
                @endif
        </ul>
    </div>

@endsection
