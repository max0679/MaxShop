<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation;
use App\Models\Category;
use App\Models\Product;
use App\Models\PropertyDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($alias)
    {

        switch ($alias) {
            case 'category-properties':
                if (isset($_POST['currentCategory'])) {
                    $category_id = (int)$_POST['currentCategory'];
                    $category_properties = PropertyDescription::where('category_id', $category_id)->orderBy('property_column')->pluck('property_title', 'property_column');

                    if (isset($_POST['dataPage']) &&($_POST['dataPage'] == 'create')) {
                        return view('admin.layouts.ajax.category_properties_create', compact('category_properties'));
                    } else {
                        return view('admin.layouts.ajax.category_properties_edit', compact('category_properties'));
                    }
                }


        }

    }



}
