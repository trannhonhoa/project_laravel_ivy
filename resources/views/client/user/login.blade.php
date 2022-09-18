@extends('client.main')
@section('content')
    <div class="container p-t-50 p-b-50">
        <div class="row">
            <div class="col-6 m-auto">
                <h3 class="p-b-30">Đăng Nhập</h3>
                @include('client.alert')
                <form action="{{ route('login.store') }}" method="post">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" name="password" class="form-control" id="pwd">
                    </div>
                    <div class="checkbox">
                        <p style="display: inline-flex">
                            <input type="checkbox" name="remember">
                            <span class="m-l-15">Remember me</span>
                        </p>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center">
                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                        <a href="/register">Chưa có tài khoản?</a>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
