<?php

namespace App\Http\Controllers;

use App\Enums\Departamento;
use App\Models\Hijo;
use Illuminate\Http\Request;
use App\Models\Trabajador;
use App\Models\Nomina;
use App\Models\Operativos;
use App\Models\Sueldo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TrabajadoresController extends Controller
{

    public function index()
    {
        $trabajadores = Trabajador::with(['hijos', 'sueldos' => function($query) {$query->latest();}])->orderBy('apellido')->get();
        $maxHijos = $trabajadores->max(function ($trabajador) {
            return $trabajador->hijos->count();
        });
        $campos = ['nombre', 'apellido', 'cargo', 'telefono_fijo', 'correo','direccion',
        'ciudad',
        'celular',
        'ARL',
        'Eps']; 
        return view('trabajadores.index', compact('trabajadores', 'maxHijos', 'campos'));
    }

    public function asignarCodigoAProduccion(Request $request)
    {
        $trabajador = Trabajador::findOrFail($request->trabajador_id);
        
        $operativoController = new OperativoController();
        try {
            $mensaje = $operativoController->asignarCodigoOperario($trabajador);
            return response()->json(['mensaje' => $mensaje], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function activos() 
    {
        $trabajadores = Trabajador::where('estado', 'activo')->with(['hijos', 'sueldos' => function($query) {$query->latest();}])->orderBy('apellido')->get();
        $maxHijos = $trabajadores->max(function ($trabajador) {
            return $trabajador->hijos->count();
        });
        
        return view('trabajadores.activos', compact('trabajadores', 'maxHijos'));
    }

    public function inactivos()
    {
        $trabajadores = Trabajador::where('estado', 'inactivo')->with(['hijos', 'sueldos' => function($query) {$query->latest();}])->orderBy('apellido')->get();
        $maxHijos = $trabajadores->max(function ($trabajador) {
            return $trabajador->hijos->count();
        });
        
        return view('trabajadores.inactivos', compact('trabajadores', 'maxHijos'));
    }

    public function butons()
    {
        return view('trabajadores.butons');
    }


    public function showPrintOptions()
    {
        $trabajadores = Trabajador::all();
        $campos = ['nombre', 'apellido', 'cargo', 'telefono_fijo', 'correo','direccion',
        'ciudad',
        'celular',
        'ARL',
        'Eps']; 
        return view('trabajadores.print_options', compact('trabajadores', 'campos'));
    }

    public function generatePrintList(Request $request)
    {
        $campos = $request->input('campos', []);

        if ($request->input('seleccion_trabajadores') === 'todos') {
            $trabajadores = Trabajador::all();
        } else {
            $trabajadoresSeleccionados = $request->input('trabajadores_seleccionados', []);
            $trabajadores = Trabajador::whereIn('id', $trabajadoresSeleccionados)->get();
        }

        return view('trabajadores.print', compact('trabajadores', 'campos'));
    }

    public function create()
    {
        return view('trabajadores.create');
    }

    public function store(Request $request)
{
    // Validación de datos
    $request->validate([
        'hijos' => 'nullable|array',
        'hijos.*.nombre' => 'required|string|max:255',
        'hijos.*.fecha_nacimiento' => 'required|date',
        'hijos.*.edad' => 'required|integer',
        'hijos.*.numero_documento' => 'required|string|max:255',
        'hijos.*.tipo_documento' => 'required|in:cedula,tarjeta de identidad,pasaporte,registro civil'
    ]);

    DB::beginTransaction(); // Iniciar transacción

    try {
        $trabajador = new Trabajador();
        $this->fillTrabajador($trabajador, $request);
        $trabajador->estado = 'activo';
        $trabajador->save();

        // Asegúrate de que los datos de hijos están presentes
        $hijos = $request->input('hijos', []);
        Log::info('Datos de hijos recibidos: ', $hijos);

        if (!empty($hijos)) {
            // Guardar los hijos
            $trabajador->hijos()->createMany($hijos);
        }

        // Actualizar la cantidad de hijos
        $trabajador->hijos_count = count($hijos);
        $trabajador->save();

        DB::commit(); // Confirmar transacción

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador creado correctamente');
    } catch (\Exception $e) {
        DB::rollBack(); // Revertir transacción en caso de error
        Log::error('Error al crear trabajador o hijos: ' . $e->getMessage());

        return redirect()->back()->withErrors('Ocurrió un error al crear el trabajador.')->withInput();
    }
}

    public function edit($id)
    {
        $trabajador = Trabajador::with('hijos')->findOrFail($id);
        return view('trabajadores.edit', compact('trabajador'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'estado' => 'required|in:activo,inactivo', // Validar el estado
        'hijos' => 'nullable|array',
        'hijos.*.id' => 'nullable|exists:hijos,id',
        'hijos.*.nombre' => 'required|string|max:255',
        'hijos.*.fecha_nacimiento' => 'required|date',
        'hijos.*.edad' => 'required|integer',
        'hijos.*.numero_documento' => 'required|string|max:255',
        'hijos.*.tipo_documento' => 'required|in:cedula,tarjeta de identidad,pasaporte,registro civil'
    ]);

    $trabajador = Trabajador::findOrFail($id);

    DB::beginTransaction(); // Iniciar transacción

    try {
        // Actualizar datos del trabajador
        $this->fillTrabajador($trabajador, $request);
        $trabajador->estado = $request->input('estado'); // Asignar estado
        $trabajador->save();

        $hijosData = $request->input('hijos', []);
        $hijosIds = [];

        foreach ($hijosData as $hijoData) {
            if (isset($hijoData['id'])) {
                // Actualizar hijo existente
                $hijo = Hijo::find($hijoData['id']);
                if ($hijo && $hijo->trabajador_id == $trabajador->id) {
                    $hijo->update([
                        'nombre' => $hijoData['nombre'],
                        'fecha_nacimiento' => $hijoData['fecha_nacimiento'],
                        'edad' => $hijoData['edad'],
                        'numero_documento' => $hijoData['numero_documento'],
                        'tipo_documento' => $hijoData['tipo_documento'],
                    ]);
                    $hijosIds[] = $hijo->id;
                }
            } else {
                // Crear nuevo hijo
                $hijo = $trabajador->hijos()->create([
                    'nombre' => $hijoData['nombre'],
                    'fecha_nacimiento' => $hijoData['fecha_nacimiento'],
                    'edad' => $hijoData['edad'],
                    'numero_documento' => $hijoData['numero_documento'],
                    'tipo_documento' => $hijoData['tipo_documento'],
                ]);
                $hijosIds[] = $hijo->id;
            }
        }

        // Eliminar hijos que ya no están en la lista
        $trabajador->hijos()->whereNotIn('id', $hijosIds)->delete();

        DB::commit(); // Confirmar transacción

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador actualizado correctamente');
    } catch (\Exception $e) {
        DB::rollBack(); // Revertir transacción en caso de error
        Log::error('Error al actualizar trabajador o hijos: ' . $e->getMessage());

        return redirect()->back()->withErrors('Ocurrió un error al actualizar el trabajador.')->withInput();
    }
}

    // public function destroy($id)
    // {
    //     $trabajador = Trabajador::findOrFail($id);
    //     $trabajador->delete();

    //     return redirect()->route('trabajadores.index')->with('success', 'Trabajador eliminado correctamente');
    // }

    public function disable($id)
    {
        $trabajador = Trabajador::findOrFail($id);
        $trabajador->estado = 'inactivo';
        $trabajador->save();

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador deshabilitado exitosamente.');
    }

    public function enable($id)
    {
        $trabajador = Trabajador::findOrFail($id);
        $trabajador->estado = 'activo';
        $trabajador->save();

        return redirect()->route('trabajadores.index')->with('success', 'Trabajador habilitado exitosamente.');
    }

    private function fillTrabajador(Trabajador $trabajador, Request $request)
    {
        $trabajador->numero_identificacion = $request->input('numero_identificacion');
        $trabajador->nombre = $request->input('nombre');
        $trabajador->apellido = $request->input('apellido');
        $trabajador->edad = $request->input('edad');
        $trabajador->telefono_fijo = $request->input('telefono_fijo');
        $trabajador->correo = $request->input('correo');
        $trabajador->estado_civil = $request->input('estado_civil');
        $trabajador->sexo = $request->input('sexo');
        $trabajador->cargo = $request->input('cargo');
        $trabajador->fecha_nacimiento = $request->input('fecha_nacimiento');
        $trabajador->direccion = $request->input('direccion');
        $trabajador->fecha_ingreso = $request->input('fecha_ingreso');
        $trabajador->tipo_pago = $request->input('tipo_pago');
        $trabajador->departamentos = $request->input('departamentos');
        $trabajador->ARL = $request->input('ARL');
        $trabajador->Eps = $request->input('Eps');
        $trabajador->ciudad_expedicion = $request->input('ciudad_expedicion');
        $trabajador->fondo_pencion = $request->input('fondo_pencion');
        $trabajador->fecha_expedicion = $request->input('fecha_expedicion');
        $trabajador->lugar_nacimiento = $request->input('lugar_nacimiento');
        $trabajador->ciudad = $request->input('ciudad');
        $trabajador->celular = $request->input('celular');
        $trabajador->alergias = $request->input('alergias');
        $trabajador->tipo_sangre = $request->input('tipo_sangre');
        $trabajador->nombre_persona_contacto = $request->input('nombre_persona_contacto');
        $trabajador->parentesco_con_persona_contacto = $request->input('parentesco_con_persona_contacto');
        $trabajador->telefono_celular_persona_contacto = $request->input('telefono_celular_persona_contacto');
        $trabajador->cuenta_bancaria = $request->input('cuenta_bancaria');
        $trabajador->fondo_cesantias = $request->input('fondo_cesantias');
        $trabajador->caja = $request->input('caja');
        $trabajador->hijos_count = $request->input('hijos_count');
        $trabajador->nombre_conyuge = $request->input('nombre_conyuge');
        $trabajador->fecha_nacimiento_conyuge = $request->input('fecha_nacimiento_conyuge');
        $trabajador->lugar_expedicion_conyuge = $request->input('lugar_expedicion_conyuge');
        $trabajador->numero_documento_conyuge = $request->input('numero_documento_conyuge');
        $trabajador->fecha_expedicion_conyuge = $request->input('fecha_expedicion_conyuge');
        $trabajador->contrato = $request->input('contrato');
    }
}