<?php


namespace App\Http\Controllers;


use App\Models\AppSetting;
use App\Models\MainModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\TPicture;

class TestController extends Builder
{
    public function index()
    {
         $products = MainModel::getProducts(true, 1, [['category_id', '=', 10]]);


         //dd($products->product_title);

         //dd($products);

    }

}
