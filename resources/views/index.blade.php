<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reporte -EXCEL-</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- Libreria css de DATATABLES --}}

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        {{-- Fin de la libreria--}}
    </head>
    <body>
            <div class="card  col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card-header text-left bg-primary text-white ">
                    Reporte de Contratistas
                </div>
                <div class="card-body">
                            <table class="table table-striped table-responsive table-bordered table-custom" id="reporte" class="display" style="width:100%">
                                    <thead class=" titulos">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>DPI</th>
                                            <th>NIT</th>
                                            <th>No. Contrato</th>
                                            <th>Inicio C.</th>
                                            <th>Fin F.</th>
                                            <th>Monto</th>
                                            <th>Viceministerio</th>
                                            <th>Unidad</th>
                                            <th>Descripción</th>
                                            <th>Dirección / Dependencia</th>
                                            <th>Tipo de Servicio</th>
                                        </tr>
                                    </thead>
                                    <tfoot class=" titulos">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellidos</th>
                                            <th>DPI</th>
                                            <th>NIT</th>
                                            <th>No. Contrato</th>
                                            <th>Inicio C.</th>
                                            <th>Fin F.</th>
                                            <th>Monto</th>
                                            <th>Viceministerio</th>
                                            <th>Unidad</th>
                                            <th>Descripción</th>
                                            <th>Dirección / Dependencia</th>
                                            <th>Tipo de Servicio</th>
                                        </tr>
                                    </tfoot>
                            </table>
                </div>
            </div>
    </body>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>


    <script>
    $(document).ready(function() {
            //MostrarTabla("#reporte");
            $('#reporte tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="'+title+'" />' );
            });
            Table2("#reporte");
            
    });

    
    function MostrarTabla(tabla) {
    
        $(tabla + ' thead tr').clone(true).appendTo( tabla + ' thead' );
        $(tabla + ' thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" class="input-search titulos" placeholder="'+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            });
        });

        var table = $(tabla).DataTable({
        "destroy": true,
        responsive: true,
        fixedHeader: false,
        "serverSide": true,
        "ajax": "{{ url('api/reporte') }}",
        "columns": [
            { data: 'Nombres' , width: 500},
            { data: 'Apellidos' ,width: 500},
            { data: 'dpi', width: 500 },
            { data: 'nit' , width: 500},
            { data: 'numero_contrato' ,width: 500 },
            { data: 'fecha_inicio' , width: 500},
            { data: 'fecha_fin' , width: 500},
            { data: 'monto', width: 500 },
            { data: 'viceministerio', width: 500 },
            { data: 'unidad_ejecutora' , width: 500},
            { data: 'descripcion' , width: 500},
            { data: 'direccion', width: 500 },
            { data: 'tipo_empleado' , width: 500},

        ],
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: function () {
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'This is the first time you have printed this document.';
                    }
                    else {
                        return 'You have printed this document '+printCounter+' times';
                    }
                },
                messageBottom: null
            }
        ],
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior",
            },
            "lengthMenu": 'Mostrar <select >' +
                '<option value="10">10</option>' +
                '<option value="30">30</option>' +
                '<option value="-1">Todos</option>' +
                '</select> registros',
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": ""
        }
    });
}


function Table2(tabla){
    var table =  $(tabla).DataTable( {
        
        "searching": true,
        "destroy": true,
        responsive: true,
        "serverSide": true,
        "ajax": "{{ url('api/reporte') }}",
        "columns": [
            { data: 'Nombres' , width: 500},
            { data: 'Apellidos' ,width: 500},
            { data: 'dpi', width: 500 },
            { data: 'nit' , width: 500},
            { data: 'numero_contrato' ,width: 500 },
            { data: 'fecha_inicio' , width: 500},
            { data: 'fecha_fin' , width: 500},
            { data: 'monto', width: 500 },
            { data: 'viceministerio', width: 500 },
            { data: 'unidad_ejecutora' , width: 500},
            { data: 'descripcion' , width: 500},
            { data: 'direccion', width: 500 },
            { data: 'tipo_empleado' , width: 500},

        ],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 5,10, 25, 50, -1 ],
            [ '5 Filas','10 Filas', '25 Filas', '50 Filas', 'Todo' ]
        ],
        buttons: [
            
            
            {
                extend:'excel',
                className: 'btn-success',
                init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
                }
            },
            {
                extend:'pageLength',
                className: 'btn-primary',
                init: function(api, node, config) {
                $(node).removeClass('btn-secondary')
                }
            }
        ],
        "language": {
            buttons: {
            pageLength: {
                _: "Mostrar %d Registros",
                '-1': "Todos"
                }
            },
            "lengthMenu": "Display _MENU_ records",
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": {
                "next": ">>",
                "previous": "<<",
            },
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "Mostrando registros del …un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)"
           
        }       
    });
        

    table.columns().every( function () {
         var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    
                    that
                        
                        .search( this.value )
                        .draw();
                }
            });
        } );
}


    </script>
</html>
