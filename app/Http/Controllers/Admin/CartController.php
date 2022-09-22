<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartAdminService;
use App\Models\User;
use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function view(Carts $cart)
    {


        $user = User::where('id', $cart->customer_id)->first();

        $orders =  DB::table('cart_details')
            ->join('products', 'cart_details.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.thumb',
                'cart_details.cart_id',
                'cart_details.qty',
                'cart_details.price'
            )
            ->where(['cart_details.cart_id' => $cart->id])
            ->get();



        return view('admin.cart.list_order_detail', [
            "title" => "Chi tiết đơn đặt hàng: " . $user->name,
            "user" => $user,
            'orders' => $orders,
            "cart" => $cart
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
    public function confirm($id = '')
    {
        echo $id;
    }
}
