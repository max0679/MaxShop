<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation;
use App\Models\Product;
use App\Models\StockStatus;
use Illuminate\Http\Request;

class StockStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $stock_statuses = StockStatus::paginate(10);
        $title = 'Управление статусами';
        return view('admin.stock_statuses.index', compact('stock_statuses', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Создание статуса';
        return view('admin.stock_statuses.create', compact( 'title'));
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
            'title' => 'required|max:32',
        ]);

        /*$stock_status = new StockStatus();
        $stock_status->title = $request->title;
        $stock_status->save();*/

        StockStatus::create([
            'title' => $request->title
        ]);

        return redirect()->route('stock_statuses.index')->with('success', 'Статус добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $title = 'Редактирование статуса';
        $stock_status = StockStatus::find($id);

        if ($stock_status) {
            return view('admin.stock_statuses.edit', compact('stock_status', 'title'));
        }
        else {
            return redirect()->route('stock_statuses.index')->with('alert', "Статуса с id '{$id}' не существует");
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
        ]);

        $stock_status = StockStatus::find($id);
        $stock_status->update([
            'title' => $request->title
        ]);

        return redirect()->route('stock_statuses.index')->with('success', 'Статус редактирован');
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

        StockStatus::destroy($id);

        return redirect()->route('stock_statuses.index')->with('success', 'Статус удален');
    }
}
