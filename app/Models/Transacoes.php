<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\Static_;

class Transacoes extends Model
{
    use HasFactory;

    public static function today() {
        try {
            //code...
            $transacoes = Transacoes::where('data','=', date('Y-m-d'))->get();
            if ($transacoes != null) {
                # code...
                return $transacoes;
            } else {
                # code...
                return false;
            }
            
        } catch (QueryException $e) {
            //throw $th;

            return false;
        }
    }

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

    public static function year() {
        try {
            //code...
            $transacoes = Transacoes::whereYear('data', '=', date('Y'))->get();

            if ($transacoes != null) {
                # code...
                return $transacoes;
            } else {
                # code...
                return false;
            }
            
        } catch (QueryException $e) {
            //throw $th;
            return false;
        }
    }

    public static function Faturamento($year) {
        try {
            //code...
            $date = strtotime('01/01/'.$year);
            $transacoes = Transacoes::whereYear('data', '=', date('Y', $date))->sum('total');
            if ($transacoes != null) {
                # code...
                return $transacoes;
            } else 

            return false;
            
        } catch (QueryException $th) {
            //throw $th;
            return false;
        }
    }

    public static function totalCreditoDay() {
        try {
            //code...
            $total = 0;
            $transacoes = Transacoes::where('data', '=', date('Y-m-d'))->where('pagamento','=', 'CR')->get();

            if ($transacoes != null) {
                # code...
                foreach($transacoes as $val) {
                    $total += $val->total;
                }

                return $total;
            }else 

            return false;
        } catch (QueryException $th) {
            //throw $th;

            return false;
        }
    }

    public static function totalDebitoDay() {
        try {
            //code...
            $total = 0;
            $transacoes = Transacoes::where('data', '=', date('Y-m-d'))->where('pagamento','=','DE')->get();
            if ($transacoes != null) {
                # code...
                foreach($transacoes as $val) {
                    $total += $val->total;
                }
                return $total;
            } else 
            return false;
            
        } catch (QueryException $th) {
            //throw $th;
            return false;
        }
    }
}
