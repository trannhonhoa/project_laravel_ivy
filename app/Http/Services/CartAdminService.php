<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Carts;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartAdminService
{
    public function getOrder()
    {
        return User::orderByDesc('id')->paginate(15);
    }
    public function getOrderDetail()
    {
        return User::orderByDesc('id')->paginate(15);
    }
    // public function destroy(){
    // }
}
