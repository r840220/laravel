@extends('layouts.master')

@section('content')

    <div id ="content" class="row">
    @foreach($product->chunk(3) as $productchunk)
        @foreach($productchunk as $product)

                <div class="col-sm-6 col-md-4" style="max-width: 430px; min-width:200px">
                    <div class="thumbnail">
                        <img src="{{$product->imagePath}}" alt="...">
                        <div class="caption">
                            <h3>{{$product->title}}</h3>
                            <h6>{{$product->price}}</h6>
                            <p>{{$product->description}}</p>
                            <p><a class="btn btn-primary" role="button" data-id = "{{ $product->id }}">加入購物車</a></p>
                        </div>
                    </div>
                </div>
        @endforeach
    @endforeach
    </div>
@endsection
