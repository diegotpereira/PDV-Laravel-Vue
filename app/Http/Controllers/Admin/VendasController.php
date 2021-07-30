<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caixa;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    //
    public function vendasView() {
        return view('admin.vendas.index', ['aberto'=>Caixa::checkOpen()]);
    }
}
