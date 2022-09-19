<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartAdminService;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartAdminService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index()
    {
        return view('admin.cart.list_order', [
            "title" => "Danh sách đơn đặt hàng",
            "orders" => $this->cartService->getOrder()
        ]);
    }
    public function view(User $user)
    {
        return view('admin.cart.list_order_detail', [
            "title" => "Chi tiết đơn đặt hàng: " . $user->name,
            "user" => $user,
            'orders' => $user->orders()->with(['product' => function ($query) {
                $query->select('id', 'name', 'thumb',);
            }])->get()
        ]);
    }
    // public function destroy(Request $request)
    // {
    //     $result = $this->sliderService->destroy($request);

    //     if ($result) {
    //         return response()->json([
    //             'error' => false,
    //             "message" => "Xóa thành công sản phẩm"
    //         ]);
    //     } else {
    //         return response()->json([
    //             'error' => true,
    //             "message" => "Xóa sản phẩm thất bại"
    //         ]);
    //     }
    // }
}
