<?php
use App\Http\Controllers\ADD_Clientes_servicios_Controller;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CifController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\Costos_produccionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\horasController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MateriaPrimasController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\OperativoController;
use App\Http\Controllers\Ordenes_compraController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RemicionesController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SDPController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SueldoController;
use App\Http\Controllers\TalentoHConroller;
use App\Http\Controllers\TiemposProduccionController;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VendedorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('home/gestion-humana', [TalentoHConroller::class, 'index'])->name('gestion-humana');

// trabajadores
Route::resource('trabajadores', TrabajadoresController::class);
Route::get('/butons', [TrabajadoresController::class, 'butons'])->name('trabajador.butons');
Route::get('/activos', [TrabajadoresController::class, 'activos'])->name('trabajadores.activos');
Route::get('/inactivos', [TrabajadoresController::class, 'inactivos'])->name('trabajadores.inactivos');
Route::post('/trabajadores/{id}/disable', [TrabajadoresController::class, 'disable'])->name('trabajadores.disable');
Route::post('/trabajadores/{id}/enable', [TrabajadoresController::class, 'enable'])->name('trabajadores.enable');

Route::get('/print-options', [TrabajadoresController::class, 'showPrintOptions'])->name('show.print.options');
Route::post('/generate-print-list', [TrabajadoresController::class, 'generatePrintList'])->name('generate.print.list');

Route::get('/asignar-codigos-operarios', [OperativoController::class, 'asignarCodigoOperarios'])->name('asignar.codigos');
Route::get('/listar-operativos', [OperativoController::class, 'listarOperativos'])->name('listar.operarios');

// Tiempos de Producción
Route::resource('tiempos-produccion', TiemposProduccionController::class);
Route::put('/tiempos_produccion/recalcular/{id}', [TiemposProduccionController::class, 'recalcular'])->name('tiempos_produccion.recalcular');

// operarios
Route::get('grupos', [TiemposProduccionController::class, 'groupByOperario'])->name('tiempos.group');
Route::get('tiempos-produccion/operario/{codigoOperario}', [TiemposProduccionController::class, 'index'])
    ->name('tiempos-produccion.operario');

// print



// sueldo
Route::resource('sueldo', SueldoController::class);
Route::get('sueldos/create/{trabajador}', [SueldoController::class, 'create'])->name('sueldos.create');
Route::get('sueldos/{sueldo}/edit', [SueldoController::class, 'edit'])->name('sueldos.edit');

// nomina pack
Route::get('/nomina', [NominaController::class, 'index'])->name('nomina.index');
Route::post('/nomina/crear-paquete', [NominaController::class, 'crearPaquete'])->name('nomina.crearPaquete');
Route::get('/nomina/{paquete}', [NominaController::class, 'show'])->name('nomina.show');
Route::get('/nominas/paquete/{paquete}', [NominaController::class, 'obtenerNominasEspecificas']);
Route::post('/nominas/update-bulk', [NominaController::class, 'updateBulk'])->name('nominas.update-bulk');
Route::delete('/paquete_nominas/{id}', [NominaController::class, 'destroy'])->name('paquete_nominas.destroy');
Route::get('/nomina/{id}/desprendible', [NominaController::class, 'mostrarDesprendible'])->name('nomina.desprendible');
    // export
    Route::get('/nomina/export/{paquete}', [ExportController::class, 'export'])->name('nominas.export');

// horas extras
Route::resource('horas-extras', horasController::class);


// Administracion de clientes y servicios
Route::get('/ADD_Clientes_servicios', [ADD_Clientes_servicios_Controller::class, 'index'])->name('ADD_C_S');


// SDP
Route::resource('sdp', SDPController::class);
Route::get('/sdp-paquetes', [SDPController::class, 'indexPaquetes'])->name('sdp.paquetes');
Route::get('/sdp-lista/{nit}', [SDPController::class, 'lista'])->name('sdp.lista');
Route::get('/sdp-ver/{id}', [SDPController::class, 'ver'])->name('sdp.ver');

// Artículos
Route::get('articulos', [ArticuloController::class, 'index'])->name('articulos.index');
Route::post('/api/articulos', [ArticuloController::class, 'store'])->name('articulos.store');
Route::get('/api/buscar-articulos', [ArticuloController::class, 'buscarArticulos']);
Route::delete('/articulos/{id}', [ArticuloController::class, 'destroy'])->name('articulos.destroy');
Route::get('/articulos/{id}/edit', [ArticuloController::class, 'edit'])->name('articulos.edit');
Route::put('/articulos/{id}/update', [ArticuloController::class, 'update'])->name('articulos.update');

// vendedores
Route::resource('vendedor', VendedorController::class);

 // clientes
Route::resource('clientes', ClienteController::class);
Route::get('buttons', [ClienteController::class, 'buttons'])->name('clientes-comerciales');
Route::get('clientes-william', [ClienteController::class, 'william'])->name('clientes-william');
Route::get('clientes-fabian', [ClienteController::class, 'fabian'])->name('clientes-fabian');
Route::get('clientes-ochoa', [ClienteController::class, 'ochoa'])->name('clientes-ochoa');

// Ubicaciones
Route::get('/departamentos', [LocationController::class, 'getDepartamentos']);
Route::get('/municipios/{departamentoId}', [MunicipioController::class, 'getMunicipios']);
Route::post('/municipios/{departamentoId}/add', [MunicipioController::class, 'addMunicipio']);
Route::post('/municipios', [MunicipioController::class, 'store']);

// remiciones
Route::resource('remiciones', RemicionesController::class);

// servicios
route::get('/servicio', [ServicioController::class, 'mainS'])->name('servicio');
Route::resource('servicios', ServicioController::class);

// almacen
Route::get('/almacen', [AlmacenController::class, 'index'])->name('almacen');

// productos
Route::resource('materias_primas', MateriaPrimasController::class);

// proveedor
Route::resource('proveedor', ProveedorController::class);

// compras
Route::resource('compras', Ordenes_compraController::class);

// inventario
Route::resource('inventario', InventoryController::class);

// categorias
Route::resource('categorias', CategoryController::class);

// CIF

Route::get('cif', [CifController::class, 'index'])->name('cif.index');
Route::get('cif/{id}/edit', [CifController::class, 'edit'])->name('cif.edit');
Route::put('cif/{id}/update', [CifController::class, 'update'])->name('cif.update');

// costos de produccion

Route::get('/costos_produccion', [Costos_produccionController::class, 'index'])->name('costos_produccion.index');
Route::get('/costos_produccion/{id}', [Costos_produccionController::class, 'show'])->name('costos_produccion.show');
Route::post('/recalcular-mano-obra-directa', [Costos_produccionController::class, 'recalcularManoObraDirecta'])
    ->name('recalcular.mano.obra.directa');

// Roles
Route::resource('roles', RoleController::class);
Route::post('/roles/assign/{id}', [RoleController::class, 'assignRole'])->name('roles.assign');

// Permissions
Route::resource('permissions', PermissionController::class);
Route::post('/assign-permission', [PermissionController::class, 'assignPermission'])
    ->middleware('auth')
    ->name('assign.permission');
Route::get('/assign-permission', [PermissionController::class, 'asignar'])
    ->middleware('auth')
    ->name('permission.asignar');

    Route::get('/admin/roles-permissions', [RolePermissionController::class, 'index'])->name('admin.roles-permissions');
    Route::post('/admin/roles-permissions', [RolePermissionController::class, 'update'])->name('admin.roles.permissions.update');
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users');

