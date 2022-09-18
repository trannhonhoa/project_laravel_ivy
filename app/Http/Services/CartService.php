<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Carts;
use App\Models\Customers;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num-product');
        $product_id = (int)$request->input('product_id');
        // if < 0 session khong chinh xac return false
        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }
        $carts[$product_id] = $qty;
        Session::put(
            'carts',
            $carts
        );
        return true;
    }
    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];
        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }
    public function update($request)
    {
        Session::put('carts', $request->input('num-product'));
        return true;
    }
    public function destroy($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);

        return true;
    }
    public function addCart()
    {
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if (is_null($carts)) {
                return false;
            }
            $customer = Auth::user();
            $email = Auth::user()->email;
            $this->inforProduct($carts, $customer->id);
            DB::commit();
            Session::flash('success', 'Đặt hàng thành công');
            Session::forget('carts');
            SendMail::dispatch($email)->delay(now()->addSeconds(5));
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', 'Đặt hàng thất bại');
            return false;
        }
        return true;
    }
    public function inforProduct($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products =  Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
        $data = [];

        foreach ($products as $key => $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'qty' => $carts[$product->id],
                'price' => $product->sale_price != 0 ? $product->sale_price  : $product->price
            ];
        }
        Carts::insert($data);
    }
}