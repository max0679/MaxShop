<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;

    public static function getSetting($title)
    {
        return AppSetting::where('setting_title', '=', $title)->limit(1)->value('setting_value');
    }

}
