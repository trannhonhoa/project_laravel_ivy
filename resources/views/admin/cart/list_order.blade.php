@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Ngày đặt</th>

                <th>Cài đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a class="btn btn-primary" href="/admin/orders/view/{{ $order->id }}"><i class="fa fa-eye"
                                aria-hidden="true"></i></a>
                        {{-- <a class="btn btn-danger" href="#"
                            onclick="removeRow({{ $order->id }},'/admin/orders/destroy')"><i class="fas fa-trash"></i></a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
