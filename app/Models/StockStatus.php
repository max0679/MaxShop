<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockStatus extends Model
{
    protected $fillable = ['title'];

    public static function getStockStatus($status_id)
    {

        if ($status_id) {
            return StockStatus::where('id', '=', intval($status_id))->select('title')->limit(1)->value('title');
        }

        return '';

    }

}
