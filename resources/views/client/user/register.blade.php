@extends('client.main')
@section('content')
    <div class="container p-t-50 p-b-50">
        <div class="row">
            <div class="col-6">
                <h3 class="p-b-30">Đăng Ký</h3>
                <form action="/register" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" name="password" class="form-control" id="pwd">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
