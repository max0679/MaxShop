<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\Category;
use App\Models\MainModel;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\PropertyDescription;
use App\Models\StockStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::get();

        return view('home', compact('categories'));
    }

    public function singleCategory($alias)
    {
        //вынесли отдельно в AppServiceProvider - теперь доступно в шаблоне sidebar без передачи в compact
        //$categories = Category::with('products')->withCount('products')->get();

        $current_category = Category::where('alias', '=', $alias)->first();

        if ($current_category) {

            $products = Product::getProducts(false, 3, [['products.category_id', '=', $current_category->id]]);

            if (count($products)) {
                return view('single_category', compact('products', 'current_category'));
            }
            else {
                return redirect()->route('home')->with('alert', 'у категории "' . $current_category->title . '" товаров не найдено');
            }
        }
        else {
            return redirect()->route('home')->with('alert', 'категория не найдена')->setStatusCode(404);
        }
    }

    public function singleProduct($alias)
    {

        $product = Product::getProducts(true, 1, [['products.alias', '=', $alias]]);//Product::getProductInfo($alias);

        if ($product) {

            $product->updateViews();

            $category_properties = PropertyDescription::where('category_id', $product->category_id)->orderBy('property_column')->get();

            $base_properties = [
                'Производитель' => $product->manufacturer->title,
                'Цена' => $product->price,
                'Статус' => $product->stockStatus->title,
                'Количество' => $product->count,
            ];

            return view('single_product', compact('product', 'category_properties', 'base_properties'));
        }
        else {
            return back()->with('alert', 'товар не найден')->setStatusCode(404);
        }

    }


    public function allProducts()
    {
        $products = Product::getProducts(false, 3);


        //$categories = Category::with('products')->withCount('products')->get();

        if ($products) {
            return view('all_products', compact('products'));
        }
        else {
            return redirect()->route('home')->with('alert', 'Продукты не найдены!');
        }

    }

}
