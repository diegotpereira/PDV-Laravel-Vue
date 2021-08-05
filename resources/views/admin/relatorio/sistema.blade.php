@extends('adminlte::page')

@section('title', 'Backup dos Registros')
@section('css')
    <style>
        .progressBar {
            background-color: #dadada;
            height: 10px;
        }
        .progress-bar {
            background-color: green;
        }
        .color-green {
            color: green;
        }
        .container {
            display: flex;
            justify-content: center;
        }
        .box-parent {
            margin: 2rem;
        }
        .btn {
            margin-bottom: 2rem;
            border-radius: 20px;
        }
        .box p {
            margin: 2rem;
        }
    </style>
@stop 
@section('content_header')
     <h1>Backup dos Registros</h1>
@stop 

@section('content')
     <div class="row container">
         <div class="col-md-4 box-parent">
             <div class="box box-danger text-center">
                 <h3 class="header">Restaurar Database</h3>
                 <p>Restaura de um arquivo. SQL os registro. Isso irá apagar os registros de seu banco de dados atual!</p>
                 <button class="btn btn-danger" onclick="importData()">IMPORTAR</button>
                 <form id="form_import" action="{{ route('relatorio.backup')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input id="file-sql" type="file" name="file-sql" style="display: none;" />
                 </form>
                 {{ isset($import) ? $import : '' }}
                 <div class="col-md-12 text-center">

                 </div>
             </div>
         </div>
         <div class="col-md-4 box-parent">
             <div class="box box-success text-center">
                 <h3 class="header">Exportar Database</h3>
                 <p>Salva todos os registro do seu banco de dados em um arquivo. SQL</p>
                 <a download="{{$mysql->filename}}" href="data:application/octet-stream;base64,{{$mysql->file}}">
                     <button class="btn btn-primary" type="button">
                         Exportar
                     </button>
                 </a>
             </div>
         </div>
     </div>
@stop 
@section('js')     
<script src="{{ asset('vendor/firebase.5.4.2/firebase-app.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-storage.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-auth.js') }}"></script>
<script src="{{ asset('vendor/firebase.5.4.2/firebase-database.js') }}"></script>
<script>
    document.getElementById('file-sql').onchange = function(e) {
        document.getElementById('form_import').submit();
    };

    function importData() {
        document.getElementById('file-sql').click();
    }

    function sendBackup() {
        if(!logged) {
            console.log("not logged");
            return;
        }

        setButton(false);
        const storageRef  = firebase.storage().ref('backupLoja');
        var message = '{{$mysql->file}}';
        var backup = storageRef.child('{{$mysql->filename}}').putString(message, 'base64');

        setStatusText("Iniciando envio");
        backup.on('state_changed', function(snapshot) {
            var progress = (snapshot.bytesTransferred / snapshot.totalBytes)*100;
            setProgress (progress);
            console.log('Upload is ' + progress + '% done');    
        }, function(error) {
            setStatusText("Erro: " + error);
        }, function() {
            setStatusText("Envio completo! <i class='fa color-green fa-check-circle'></i>");
        });
    }
</script>
@stop 