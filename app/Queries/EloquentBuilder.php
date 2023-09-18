<?php

namespace App\Queries;

use Illuminate\Database\Eloquent\Builder;

class EloquentBuilder extends Builder
{

//    public function customWhere() : self
//    {
//        $this->where('category_id', '=', 10);
//        return $this;
//    }

    public function firstOrPaginate(bool $only_one, $count_products = 3)
    {
        //return $this->>first();
        if ($only_one) {
            return static::first();
        }

        return static::paginate($count_products);

    }

}
