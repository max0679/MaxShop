<?php

namespace App\Models;

use App\Http\Traits\TPicture;
use App\Queries\EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    //use HasFactory;
    use Sluggable;

    use TPicture;

    protected $fillable = [
        'title',
        'category_id',
        'manufacturer_id',
        'description',
        'content'
    ];

    public function newEloquentBuilder($query): EloquentBuilder // переопределить конструктор запроса на пользовательский
    {
        return new EloquentBuilder($query);
    }


    public static function getProducts(bool $only_first, int $count_elems_on_page = 3, array $condition_arr = [], string $cache = null)
    {

        if (!is_null($cache) && Cache::has($cache)) {
            return Cache::get($cache);  //pull - взять и удалить
        }


        $products = Product::with('category', 'manufacturer', 'stockStatus')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->leftJoin('stock_statuses', 'stock_statuses.id', '=', 'products.status_id')
            ->leftJoin('manufacturers', 'manufacturers.id', '=', 'products.manufacturer_id')
            ->where($condition_arr)
            ->select('products.*')
            ->firstOrPaginate($only_first, $count_elems_on_page);

        if (!is_null($cache)) {
            Cache::put($cache, $products, 60); //в секундах //pull - взять и удалить
        }

        return $products;

    }

    public function fillFields($request, $picture = null)
    {
        $this->title = $request->title;

        if ($this->category_id != $request->category_id) {
            //сменили категорию
            $count_properties = (int)AppSetting::getSetting('count_category_properties');

            if ($count_properties) {
                for ($i=1; $i <= $count_properties; $i++) {
                    $str = 'X' . $i;
                    $this->$str = null; //обнуляем все свойства продукта в базе
                }
            }

        }

        $this->category_id = $request->category_id;

        $this->manufacturer_id = $request->manufacturer_id;

        $this->price = str_replace(',', '.', $request->price);
        $this->count = $request->count;
        $this->status_id = $request->status_id;

        if ($request->hasFile('picture')) {

            if ($picture) {
                Storage::delete($this->picture); // если это редактирование, то удаляем старую картинку, если она была
            }

            $path = date('Y-m-d');
            $this->picture = $request->file('picture')->store("images/products/{$path}");
        }

        $this->description = $request->description;

        $category_properties = PropertyDescription::where('category_id', $this->category_id)->orderBy('property_column')->get();

        if ($category_properties) {
            foreach($category_properties as $category_property) {
                $title_prop = $category_property->property_column;
                $this->$title_prop = $request->$title_prop;
            }
        }

    }

    // урок 22 - scope - вернуть часть запроса конструктора


    public function updateViews() {
        $this->update(['count_views' => $this->count_views++]);
    }


    public function stockStatus()
    {
        return $this->belongsTo('App\Models\StockStatus', 'status_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function manufacturer()
    {
        return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id'); //здесь 2-ой арг. не обязателен, т.к. конвенции
    }

    public function sluggable(): array
    {
        return [
            'alias' => [
                'source' => 'title'
            ]
        ];
    }
}
