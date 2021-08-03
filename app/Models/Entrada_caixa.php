<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Entrada_caixa extends Model
{
    use HasFactory;
    public static function today() {
        try {
            //code...
            $entrada = Entrada_caixa::whereDate('created_at', '=', date('Y-m-d'))->get();

            if ($entrada != null) {
                # code...
                return $entrada;
            } else 

            return false;
            
        } catch (QueryException $th) {
            //throw $th;
            return false;
        }
    }
}
