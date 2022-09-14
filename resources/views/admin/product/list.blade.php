@extends('admin.main')
@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>giá gốc</th>
                <th>giá khuyến mãi</th>
                <th>Active</th>
                <th>Update</th>
                <th>Cài đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ number_format($product->price_sale, 2) }}</td>
                    <td> {!! \App\Helpers\Helper::isActive($product->active) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary" href="/admin/products/edit/{{ $product->id }}"><i
                                class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="#"
                            onclick="removeRow({{ $product->id }},'/admin/products/destroy')"><i
                                class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $products->links() !!}
@endsection
