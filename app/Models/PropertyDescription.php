<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PropertyDescription extends Model
{

    protected $fillable = [
        'category_id', 'property_column', 'property_title'
    ];

    public function __construct($category_id = null)
    {
        $this->category_id = $category_id;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public static function count_properties()
    {
        $count_property = DB::table('app_settings')->where('setting_title', 'count_category_properties')->first();

        if ($count_property) {
            return (int)$count_property->setting_value;
        }

        return 0;

    }

    public static function get_busy_columns($category_id)
    {
        return self::where('category_id', $category_id)->orderBy('property_column')->pluck('property_title', 'property_column')->all();
    }

    public static function get_free_properties($category_id)
    {
        $all_columns = self::count_properties();
        $busy_columns = self::get_busy_columns($category_id);

        $free_columns = [];

        if ($busy_columns) {
            for ($i = 1; $i <= $all_columns; $i++) {
                if (!array_key_exists("X$i", $busy_columns)) {
                    $free_columns += ["X$i" => $i];
                }
            }
        }
        else {
            for ($i = 1; $i <= $all_columns; $i++) {
                $free_columns += [ "X$i" => $i ];
            }
        }

        return $free_columns;
    }

}
