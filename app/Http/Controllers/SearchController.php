<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([
            'search' => 'required|max:100',
        ]);


        $search = trim($request->search);

        $products = Product::getProducts(false, 3, [['products.title', 'LIKE', "%{$search}%"]]); //getSearchProducts($condition_arr, 3);

        if (!count($products)) {
            return redirect()->back()->with('alert', 'по запросу "' . $search . '" ничего не найдено');
        }

        return view('search_products', compact('products',  'search'));

    }
}
