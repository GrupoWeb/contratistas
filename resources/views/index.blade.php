<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reporte -EXCEL-</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- Libreria css de DATATABLES --}}

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        {{-- Fin de la libreria--}}
    </head>
    <body>
       <div class="container table-responsive-sm">
            <div class="Cfiltro">
            <form class="form-inline" action="/action_page.php">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd">
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Remember me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
            <table class="table table-striped table-bordered table-sm" id="reporte">
                    <caption>List of users</caption>
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>DPI</th>
                            <th>NIT</th>
                            <th>No. Contrato</th>
                            <th>Inicio Contrato</th>
                            <th>Fin Contrato</th>
                            <th>Monto Contrato</th>
                            <th>Viceministerio</th>
                            <th>Unidad Ejecutora</th>
                            <th>Descripción</th>
                            <th>Dirección / Dependencia</th>
                            <th>Tipo de Servicio</th>
                        </tr>
                    </thead>
            </table>
       </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#reporte').DataTable({
                "serverSide": true,
                "ajax": "{{ url('api/reporte') }}",
                "columns": [
                        {data: 'nit'},
                        {data: 'dpi'},
                        {data: 'Nombres'},
                        {data: 'Apellidos'},
                        {data: 'numero_contrato'},
                        {data: 'fecha_inicio'},
                        {data: 'fecha_fin'},
                        {data: 'monto'},
                        {data: 'viceministerio'},
                        {data: 'unidad_ejecutora'},
                        {data: 'descripcion'},
                        {data: 'direccion'},
                        {data: 'tipo_empleado'},

                    ],
                    "language": {
                        "info": "_TOTAL_ registros",
                        "search": "Buscar",
                        "paginate": {
                            "next": "Siguiente",
                            "previous": "Anterior",
                        },
                        "lengthMenu": 'Mostrar <select >'+
                                    '<option value="10">10</option>'+
                                    '<option value="30">30</option>'+
                                    '<option value="-1">Todos</option>'+
                                    '</select> registros',
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "emptyTable": "No hay datos",
                        "zeroRecords": "No hay coincidencias", 
                        "infoEmpty": "",
                        "infoFiltered": ""
                    }
                });
        });
    </script>
</html>
