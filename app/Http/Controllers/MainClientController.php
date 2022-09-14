<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogRequest;
use App\Http\Services\BLogClientService;
use App\Http\Services\MenuService;
use App\Http\Services\ProductClientService;
use App\Http\Services\SliderService;
use Illuminate\Http\Request;

class MainClientController extends Controller
{
    protected $sliderService;
    protected $menuService;
    protected $productServie;
    protected $blogService;
    public function __construct(BLogClientService $blogService, SliderService $sliderService, MenuService $menuService, ProductClientService $productServie)
    {
        $this->sliderService = $sliderService;
        $this->menuService = $menuService;
        $this->productServie = $productServie;
        $this->blogService = $blogService;
    }
    public function index()
    {
        return view('client.home', [
            "title" => "Shop nước hoa ABC",
            "sliders" => $this->sliderService->show(),
            "menus" => $this->menuService->show(),
            "products" => $this->productServie->getSlideProductClient(),
            "blogs" => $this->blogService->getMainBlogClient()
        ]);
    }
    public function loadProduct(Request $request)
    {
        $page = $request->input('page');

        $result = $this->productServie->get($page);
        if (count($result) != 0) {
            $html = view('client.product.list', ['products' => $result])->render();
            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' => ''
        ]);
    }
}
