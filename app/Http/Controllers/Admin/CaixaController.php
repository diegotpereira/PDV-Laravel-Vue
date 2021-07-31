<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
    //
    public function historico() {
        return view('admin.transacoes.index');
    }
}
