<?php

namespace App\Models;

use App\Http\Traits\TPicture;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;


class Category extends Model
{

    protected $fillable = ['title', 'description', 'picture'];

    // use HasFactory;

    use Sluggable;

    use TPicture;

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function categoryProperties()
    {
        return $this->hasMany('App\Models\PropertyDescription');
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
