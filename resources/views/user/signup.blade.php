@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-2">
        <h1>註冊會員</h1>
        <form action="{{ route('user.signup') }}" method="post">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <label for="name">姓名:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">信箱:</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">密碼:</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
                {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">註冊</button>

        </form>
    </div>
</div>
@endsection