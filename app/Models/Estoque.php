<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use App\Models\Estoque\Estoque_aux;

class Estoque extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $maps = ['estoque' => 'number'];

    public function auX() {

        return $this->hasMany('App\Models\Estoque\Estoque_aux', 'codigo_estoque', 'codigo');
    }

    public static function getOff($codigo, $quantidade) {
        $estoque = Estoque::where(['codigo', '=', $codigo])->first();
        $estoque->estoque -= $quantidade;

        try {
            //code...
            $estoque->save();

            return true;
        } catch (QueryException $e) {
            
            return false;
        }
    }

    public static function getAdd($codigo, $quantidade) {
        $estoque = Estoque::where(['codigo', '=', $codigo])->first();
        $estoque->estoque += $quantidade;

        try {
            //code...
            $estoque->save();

            return true;
            
        } catch (QueryException $e) {
            
            return false;
        }
    }

    public static function Total() {

        return Estoque_aux::all()->sum('estoque');
    }

    public static function valorTotalRS() {
        $total = 0;

        foreach (Estoque::all() as $estoque) {
            # code...
            $total = $total + ($estoque->estoque * $estoque->preco);
        }

        return number_format($total,2,',','.');
    }

    public function toRS() {

        return number_format($this->preco,2,',','.');
    }
}
