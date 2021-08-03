<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Sangria extends Model
{
    use HasFactory;
    public static function today() {
        try {
            //code...
            $sangria = Sangria::where('data', '=', date('Y-m-d'))->get();
            if ($sangria != null) {
                # code...
                return $sangria;
            } else 

            return false;
            
        } catch (QueryException $th) {
            //throw $th;
            return false;
        }
    }
}
