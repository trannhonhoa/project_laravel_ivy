<?php

namespace App\Http\Controllers;

use App\Http\Services\BLogClientService;
use App\Http\Services\BlogService;
use Illuminate\Http\Request;

class BlogClientController extends Controller
{
    protected $blogService;
    public function __construct(BLogClientService $blogService)
    {
        $this->blogService = $blogService;
    }
    public function index()
    {
        $blogs = $this->blogService->get();
        // $productRelated = $this->blogService->related($id);
        return view('client.blog.list', [
            "title" => "Bài viết",
            "blogs" => $blogs
        ]);
    }
    public function show($id = '', $slug = '')
    {
        $blog = $this->blogService->show($id);
        // $productRelated = $this->blogService->related($id);
        return view('client.blog.blog_details', [
            "title" => "Chi tiết bài viết",
            "blog" => $blog
        ]);
    }
}
