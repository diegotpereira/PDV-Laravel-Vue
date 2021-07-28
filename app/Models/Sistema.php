<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function getVal($conf) {

        return Sistema::where('config', '=', $conf)->first()->value;
    }

    public static function setVal($conf,$val){
        $sys = Sistema::where('config', '=',$conf)->first();
        $sys->value = $val;

        return $sys->save();
    }
}
