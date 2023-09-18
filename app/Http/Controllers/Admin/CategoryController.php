<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(2);
        $title = 'Управление категориями';
        return view('admin.categories.index', compact('categories', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Создание категории';
        return view('admin.categories.create', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('picture')) {
            $path = date('Y-m-d');
            $data['picture'] = $request->file('picture')->store("images/categories/{$path}");
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Категория добавлена');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $title = 'Редактирование категории';
        $category = Category::find($id);

        if ($category) {
            return view('admin.categories.edit', compact('category', 'title'));
        }
        else {
            return redirect()->route('categories.index')->with('alert', "Категории с id '{$id}' не существует");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryValidation $request, $id)
    {
        $category = Category::find($id);

        $data = $request->all();

        if ($request->hasFile('picture')) {

            if ($category->picture) {
                Storage::delete($category->picture); // если это редактирование, то удаляем старую картинку, если она была
            }

            $path = date('Y-m-d');
            $data['picture'] = $request->file('picture')->store("images/categories/{$path}");
        }
        else {
            $data['picture'] = $category->picture; //чтоб не затереть
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Категория изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        /*
            $category = Category::find($id);
            $category->delete();
        */

        $category = Category::find($id);


        if ($category) {

            //Category::destroy($id);

            if ($category->products->count()) {

                if (isset($_GET['page'])) {
                    return redirect()->back()->with('alert', 'Ошибка удаления - у категории есть продукты!');
                }

                return redirect()->route('categories.index')->with('alert', 'Ошибка удаления - у категории есть продукты!');


            }

            if ($category->picture) {
                Storage::delete($category->picture);
            }

            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Категория удалена');
        }

        return redirect()->route('categories.index')->with('alert', 'Ошибка удаления!');

    }
}
