<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::paginate(10);
        $title = 'Управление странами';
        return view('admin.countries.index', compact('countries', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Создание страны';
        return view('admin.countries.create', compact( 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:64',
        ]);

        $country = new Country();
        $country->title = $request->title;
        $country->save();

        return redirect()->route('countries.index')->with('success', 'Страна добавлена');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $title = 'Редактирование страны';
        $country = Country::find($id);

        if ($country) {
            return view('admin.countries.edit', compact('country', 'title'));
        }
        else {
            return redirect()->route('countries.index')->with('alert', "Страны с id '{$id}' не существует");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:64',
        ]);

        $country = Country::find($id);
        $country->title = $request->title;
        $country->update();

        return redirect()->route('countries.index')->with('success', 'Страна редактирована');
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

        Country::destroy($id);

        return redirect()->route('countries.index')->with('success', 'Страна удалена');
    }
}
