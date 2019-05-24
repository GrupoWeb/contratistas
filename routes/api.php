<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('reporte', function () {

    // return datatables()
	// 	->eloquent(App\User::query())
	// 	->addColumn('btn', 'actions')
	// 	->rawColumns(['btn'])
    //     ->toJson();
    return datatables()->query(DB::select("exec ViewReport;"))->toJson();
    // $respuesta = DB::select("exec ViewReport;");
    // return $respuesta;
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// public function getTables($table_schema)
//     {
//         $conexionSQL = $this->conexionInformationSchema("information_schema");

//         $resultado = $conexionSQL->select("SELECT table_name FROM tables WHERE table_schema = '$table_schema'");

//         return response()->json($resultado, 200);
//     }