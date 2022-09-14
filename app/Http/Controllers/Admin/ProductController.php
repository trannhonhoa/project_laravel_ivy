<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\MenuService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $productService;
    protected $menuService;
    public function __construct(ProductService $productService, MenuService $menuService)
    {
        $this->productService = $productService;
        $this->menuService = $menuService;
    }

    public function index()
    {

        return view('admin.product.list', [
            "title" => "Danh sách sản phẩm",
            "products" => $this->productService->get()
        ]);
    }


    public function create()
    {
        return view('admin.product.add', [
            "title" => "Thêm sản phẩm",
            "menus" => $this->productService->getMenu()
        ]);
    }


    public function store(ProductRequest $request)
    {

        // dd($request->input());
        $this->productService->create($request);
        return redirect()->back();
    }


    public function show(Product $product)
    {
        return view('admin.product.edit', [
            "title" => "Chỉnh sửa sản phẩm: " . $product->name,
            "menus" => $this->productService->getMenu(),
            "product" => $product
        ]);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $res = $this->productService->update($product, $request);
        if ($res) {
            return redirect('/admin/products/list');
        }

        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $result = $this->productService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                "message" => "Xóa thành công sản phẩm"
            ]);
        } else {
            return response()->json([
                'error' => true,
                "message" => "Xóa sản phẩm thất bại"
            ]);
        }
    }
}
