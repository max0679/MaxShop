<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\PropertyDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropertyDescriptionController extends Controller
{
    public function index($alias)
    {
        $category = DB::table('categories')->where('alias', $alias)->first();

        if ($category) {

            $property_descriptions = PropertyDescription::where('category_id', '=', $category->id)->orderBy('property_column')->paginate(10);

            $title = "Описание дополнительных свойств категории '{$category->title}'";

            return view('admin.property_descriptions.index', compact('category', 'property_descriptions',  'title'));
        }
        else {
            return redirect()->route('categories.index')->with('alert', "Категории с alias '{$alias}' не существует");
        }
    }

    public function create($alias)
    {
        $category = DB::table('categories')->where('alias', $alias)->first();

        if ($category) {

            $free_columns = PropertyDescription::get_free_properties($category->id);

            if ($free_columns) {
                $title = "Создание свойства у категории '{$category->title}'";
                return view('admin.property_descriptions.create', compact( 'title', 'category', 'free_columns'));
            }
            else return redirect()->route('categories.index')->with('alert', "Нет свободных свойств для категории {$category->title}");


        }
        else {
            return redirect()->route('categories.index')->with('alert', "Категории с alias '{$alias}' не существует");
        }
    }

    public function store(Request $request, $alias)
    {
        $request->validate([
            'property_column' => 'regex:#^[X][0-9]{1,2}$#',
            'property_title' => 'required|max:32',
        ]);

        $category = DB::table('categories')->where('alias', $alias)->first();

        if ($category) {

            $property_description = new PropertyDescription($category->id);
            $property_description->property_column = $request->property_column;
            $property_description->property_title = $request->property_title;
            $property_description->description = $request->description;

            $property_description->save();

            return redirect()->route('property_descriptions', ['alias' => $alias])->with('success', 'Свойство категории добавлено');

        }
        else {
            return redirect()->route('categories.index')->with('alert', "Ошибка создания свойства");
        }

    }


    public function edit($alias, $id)
    {
        $category = DB::table('categories')->where('alias', $alias)->first();
        $property_description = PropertyDescription::where('id', '=', $id)->first();

        if ($category && $property_description) {

            $free_columns = PropertyDescription::get_free_properties($category->id);

            //array_unshift($free_columns, [$property_description->property_column => (int)str_replace('X', '', $property_description->property_column)]);

            $free_columns = [$property_description->property_column => (int)str_replace('X', '', $property_description->property_column)] + $free_columns;

            if ($free_columns) {
                $title = "Редактирование свойства у категории '{$category->title}'";
                return view('admin.property_descriptions.edit', compact( 'title', 'category', 'property_description', 'free_columns'));
            }
            else return redirect()->route('categories.index')->with('alert', "Нет свободных свойств для категории {$category->title}");


        }
        else {
            if (!$property_description) {
                return redirect()->route('categories.index')->with('alert', "Свойства с '{$alias}' не существует");
            }
            return redirect()->route('categories.index')->with('alert', "Категории с alias '{$alias}' не существует");
        }
    }

    public function update(Request $request, $alias, $id)
    {

        $request->validate([
            'property_column' => 'regex:#^[X][0-9]{1,2}$#',
            'property_title' => 'required|max:32',
        ]);

        $property_description = PropertyDescription::find($id);

        //dd($request);
        if ($property_description) {

            $old_column = $property_description->property_column;
            $new_column = $request->property_column;

            if ($old_column != $new_column) { // обновить поле в product_property, если изменили номер столбца свойства

                $products = Product::where('category_id', $property_description->category_id)->get();

                foreach ($products as $product) {

                    $product_properties = ProductProperty::where('product_id', $product->id)->get();

                    foreach ($product_properties as $product_property) {
                        $product_property->$new_column = $product_property->$old_column;
                        $product_property->$old_column = null;
                        $product_property->update();
                    }

                }

            }

            $property_description->property_column = $request->property_column;
            $property_description->property_title = $request->property_title;
            $property_description->description = $request->description;

            $property_description->update();

            return redirect()->route('property_descriptions', ['alias' => $alias])->with('success', "Свойство изменено");

        }
        else {
            return redirect()->route('property_descriptions', ['alias' => $alias])->with('alert', "Свойства с id $id не существует");
        }
    }

    public function destroy($alias, $id)
    {
        // сначала обнулить свойство у всех продуктов этой категории
        $property_description = PropertyDescription::find($id);

        if ($property_description) {

            $title_prop = $property_description->property_column;

            $products = Product::where('category_id', $property_description->category_id)->get();

            foreach ($products as $product) {

                $product_properties = ProductProperty::where('product_id', $product->id)->get();

                foreach ($product_properties as $product_property) {
                    $product_property->$title_prop = null;
                    $product_property->update();
                }

            }

            //PropertyDescription::destroy($id);
            $property_description->delete();

            return redirect()->route('property_descriptions', ['alias' => $alias])->with('success', 'Свойство категории удалено');

        }
        else {
            return redirect()->route('property_descriptions', ['alias' => $alias])->with('alert', 'Ошибка удаления');
        }

    }
}
