@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h1>會員登入</h1>
            <form action="{{ route('user.signin') }}" method="post">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">信箱:</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">密碼:</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">登入</button>

            </form>
        </div>
    </div>
@endsection