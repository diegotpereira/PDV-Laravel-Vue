<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caixa;
use App\Models\Entrada_caixa;
use App\Models\Estoque;
use App\Models\Estoque\Estoque_aux;
use App\Models\Transacoes;
use App\Models\Venda;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class VendasController extends Controller
{
    //
    public function vendasView() {
        return view('admin.vendas.index', ['aberto'=>Caixa::checkOpen()]);
    }

    public function Registrar(Request $request) {
        try {
            //code...
            $items = array();
            $total = count($request->venda['codigo']);
            $transacao = new Transacoes();
            $transacao->cliente = $request->cliente;
            $transacao->data = date('Y-m-d');
            $transacao->pagamento = $request->pagamento;
            $transacao->parcelas = $request->parcelas;
            $transacao->valor_parcelas = $this->moneyParse($request->valor_parcelas);
            $transacao->total = $this->moneyParse($request->total);

            if ($this->percenParse($request->desconto) == '') {
                # code...
                $transacao->desconto = 0;

            } else {
                # code...
                $transacao->desconto = $this->perseParse($request->desconto);
            }

            $transacao->save();
            
            if ($request->dividir == true) {
                # code...
                $entrada = new Entrada_caixa();
                $entrada->valor = str_replace([".",","],["","."], $request->dinheiro);
                $entrada->descricao = "Referente pgcom dinheiro e cartão NT: ".$transacao->id;
                $entrada::add($entrada->valor);
            }

            for($i = 0; $i < $total; $i++) {
                $items[$i]['transacao'] = $transacao->id;
                $items[$i]['codigo_estoque'] = $request->venda['codigo'][$i];
                $items[$i]['codigo_estoque_aux'] = $request->venda['codigo_aux'][$i];
                $items[$i]['quantidade'] = $request->venda['quantidade'][$i];
                $items[$i]['valor'] = $this->moneyParse($request->venda['total'][$i]);
            }

            foreach ($items as $key => $val) {
                # code...
                if ($val['codigo_estoque'] != null && $val['quantidade'] != 0 || null) {
                    # code...
                    $vendas = new Venda();
                    $vendas->transacao = $val['transacao'];
                    $vendas->codigo_estoque = $val['codigo_estoque'];
                    $vendas->codigo_estoque_aux = $val['codigo_estoque_aux'];
                    $vendas->quantidade = $val['quantidade'];
                    $vendas->save();
                    Estoque_aux::getOff($vendas->codigo_estoqur_aux, $vendas->quantidade);
                }
            }

            return response()->json([
                'success' => "true",
                'NT' => $transacao->id,
                'message' => 'Venda realizada com sucesso'
            ]);

        } catch (QueryException $e) {
            //throw $th;
            $error_code = $e->errorInfo;
            return response()->json([
                'success' => 'false',
                'message' => 'erro no banco de dados, codigo: '.$error_code[2]
            ]);
        }
    }
}
