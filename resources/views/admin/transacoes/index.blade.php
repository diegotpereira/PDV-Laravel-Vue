@extends('adminlte::page')

@section('title', 'caixa')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/datatables.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}"/>
@stop 
@section('content_header')
<h1>Histórico</h1>
@stop 

@section('content')
@include('admin.modal')

<div class="row">
    <div class="col-md-3">
        <button id="comprovanteGen" class="btn">Gerar comprovanteGen
            <span class="glyphicon glyphicon-print"></span>
        </button>
        <div class="col-md-3">
            <form action="{{ route('historico.print')}}" method="POST" target="_blank">
                {{csrf_field()}}
                <input type="hidden" name="rage" id="print_form"/>
                <button type="submit" class="btn">
                    Imprimir tabela
                    <span class="glyphicon glyphicon-print"></span>
                </button>
            </form>
        </div>
        <div id="reportrange" class="col-md-offset-8" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span></span><b class="caret"></b>
        </div>
        <table id="transation-table" class="table hover order-column compact table-bordered" cellspacing="0" width="100%">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Data</th>
                    <th scope="col">Itens Qnt Valor</th>
                    <th scope="col">Desconto</th>
                    <th scope="col">Pagamento</th>
                    <th scope="col">Parcelas</th>
                    <th scope="col">Valor parcelas</th>
                    <th scope="col">Total R$</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@stop 
@section('js')
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('js/daterangepicker.js') }}"></script>
<script src="{{ asset('vendor/datatables.min.js') }}"></script>
<script type="text/javascript">
   $(function() {
       moment.locale('pt-br');
       
   })
