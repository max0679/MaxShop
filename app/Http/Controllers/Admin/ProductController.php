<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidation;
use App\Models\Category;
use App\Models\MainModel;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\PropertyDescription;
use App\Models\StockStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $query_mass = [];
        $get_params = '';

        MainModel::getParams($query_mass, $get_params);

        if (empty($query_mass)) {
            $products = Product::with('category', 'manufacturer')->paginate(2);
        }
        else {
            $products = Product::with('category', 'manufacturer')->where($query_mass)->paginate(2);
        }

        if (isset($_GET['page'])) {
            session()->put('page', $_GET['page']);
        }

        $title = 'Управление товарами';
        return view('admin.products.index', compact('products',  'title', 'get_params'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $title = 'Создание товара';

        if (!count($categories = Category::pluck('title', 'id')->all())) {
            return redirect()->route('products.index')->with('alert', "Должна быть создана хотя бы одна категория");
        }

        if (!count($manufacturers = Manufacturer::pluck('title', 'id')->all())) {
            return redirect()->route('products.index')->with('alert', "Должен быть создан хотя бы один производитель");
        }

        if (!count($stock_statuses = StockStatus::pluck('title', 'id')->all())) {
            return redirect()->route('products.index')->with('alert', "Должен быть создан хотя бы один статус товара");
        }

//        $category_properties_arr = []; // свойства данной категории
//
//        foreach ($categories as $category) {
//
//            $category_properties_arr[$category->id] = [];
//
//            foreach ($category->categoryProperties as $property) {
//               $category_properties_arr[$category->id] += [$property->property_column => $property->property_title];
//            }
//
//        }

        if (isset($_GET['category_id'])) {
            $category_properties = PropertyDescription::where('category_id', (int)$_GET['category_id'])->orderBy('property_column')->pluck('property_title', 'property_column');
        } else {
            $category_properties = null;
        }

        //$category_properties_arr_json = json_encode($category_properties_arr);

        return view('admin.products.create', compact( 'title',  'categories', 'manufacturers', 'stock_statuses', 'category_properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductValidation $request)
    {

        $product = new Product();

        $product->fillFields($request);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Товар добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('alert', "Товара с id '{$id}' не существует");
        }

        $title = 'Редактирование товара ' . $product->title;

        $categories = Category::pluck('title', 'id')->all(); // массив значение => ключ
        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $stock_statuses = StockStatus::pluck('title', 'id')->all();
        $category_properties = PropertyDescription::where('category_id', $product->category_id)->orderBy('property_column')->pluck('property_title', 'property_column');

        return view('admin.products.edit', compact('product', 'title',  'categories', 'manufacturers', 'stock_statuses', 'category_properties'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductValidation $request, $id)
    {
        $product = Product::find($id);

        $product->fillFields($request, $product->picture);

        $product->update();

        // pull - прочитать и забыть
        return redirect()->route('products.index', 'page=' . session()->pull('page', '1'))->with('success', 'Товар ' . $product->title . ' изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->picture) {
            Storage::delete($product->picture); // удалим все картинки у свойств, принадлежащих продукту
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Товар ' . $product->title . ' удален');
    }
}
