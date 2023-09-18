<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Manufacturer;
use Illuminate\Http\Request;


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $manufacturers = Manufacturer::with('country')->paginate(2);
        $title = 'Управление производителями';
        return view('admin.manufacturers.index', compact('manufacturers', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {

        $countries = Country::pluck('title', 'id')->all();

        if (!count($countries)) {
            return redirect()->route('manufacturers.index')->with('alert', "Должна быть создана хотя бы одна страна производителя");
        }

        $title = 'Создание производителя';
        return view('admin.manufacturers.create', compact( 'title', 'countries'));
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
            'title' => 'required|max:32|unique:manufacturers',
            'country_id' =>  'integer',
            'description' => 'max:32'
        ]);

        Manufacturer::create($request->all());

        return redirect()->route('manufacturers.index')->with('success', 'Производитель добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $title = 'Редактирование производителя';
        $manufacturer = Manufacturer::find($id);

        $countries = Country::pluck('title', 'id')->all();

        if ($manufacturer) {
            return view('admin.manufacturers.edit', compact('manufacturer', 'title', 'countries'));
        }
        else {
            return redirect()->route('manufacturers.index')->with('alert', "Производителя с id '{$id}' не существует");
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
            'title' => 'required|max:32',
            'country_id' =>  'integer',
            'description' => 'max:32'
        ]);

        $manufacturer = Manufacturer::find($id);
        $manufacturer->update($request->all());

        return redirect()->route('manufacturers.index')->with('success', 'Производитель изменен');
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
            $manufacturer = Manufacturer::find($id);
            $manufacturer->delete();
        */

        Manufacturer::destroy($id);

        return redirect()->route('manufacturers.index')->with('success', 'Производитель удален');
    }
}
