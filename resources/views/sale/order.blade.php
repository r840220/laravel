@extends('layouts.master')

@section('content')
    @foreach($user_order as $order)
        {{ print_r($order) }}
        @foreach($order_detail as $detail)
            @if($detail->order_id == $order->id)
                {{ print_r($detail) }}
            @endif
        @endforeach
    @endforeach
@endsection
