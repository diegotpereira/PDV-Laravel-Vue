<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Transacoes extends Model
{
    use HasFactory;

    public static function month(){
        try {
            $transacoes = Transacoes::whereMonth('data','=', date('m'))->get();
            if($transacoes != null){
                return $transacoes;
            }else return false;
        }catch(QueryException $e){
            return false;
        }
    }
}
