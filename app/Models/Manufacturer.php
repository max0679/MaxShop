<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
//    protected $table = 'my_posts';
//    protected $primaryKey = 'post_id';
//    public $incrementing = false;
//    protected $keyType = 'string';
//    public $timestamps = false;
    //use HasFactory;

    protected $fillable = ['country_id', 'title', 'description'];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
}
