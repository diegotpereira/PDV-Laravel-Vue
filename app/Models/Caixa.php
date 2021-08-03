<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Caixa extends Model
{
    use HasFactory;
    public static function checkOpen() {
        if (Caixa::today() != false && Sistema::getVal('caixa_aberto')) {
            # code...

            return true;
        } else {
            # code...

            return false;
        }
        
    }

    public static function today() {
        try {
            //code...
            $caixa = Caixa::where('data', '=', date('Y-m-d'))->first();
            if ($caixa != null) {
                # code...
                return $caixa;
            } else {
                # code...
                return false;
            }
            
        } catch (QueryException $e) {
            //throw $th;

            return false;
        }
    }

    public static function add($int ) {
        if (Caixa::checkOpen()) {
            # code...
            $caixa = Caixa::where('data', '=', date('Y-m-d'))->first();
            $caixa->valor = $caixa->valor + $int;
            $caixa->save();
        } else
        return false;
    }

    public static function getOff($int) {
        if (Caixa::checkOpen()) {
            # code...
            $caixa = Caixa::where('data','=', date('Y-m-d'))->first();
            $caixa->valor = $caixa->valor - $int;
            $caixa->save();
        } else 
        return false;
    }
}
