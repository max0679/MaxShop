<?php


namespace App\Models;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Queries\EloquentBuilder;
use Illuminate\Database\Eloquent\Model;

class MainModel
{

    public static function getParams(array &$query_mass, string &$get_params)
    {

        // потом переделать во view composer (app service provider)
        if (count($_GET)) {
            foreach ($_GET as $key => $value) {

                if ($key == 'page') {
                    continue;
                }

                $query_mass[] = [$key, '=', $value];

                $get_params == '' ? $get_params .= '?' . $key . '=' . $value :
                    $get_params .= '&' . $key . '=' . $value;
            }
        }

    }


}
