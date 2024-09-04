<?php

namespace App\Http\Controllers;

use App\Enums\Departamento;
use App\Models\Operativo;
use App\Models\operativos;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OperativoController extends Controller
{

    public function asignarCodigoOperarios()
    {
        // Obtener todos los trabajadores del departamento de producción
        Log::info('Iniciando asignación de códigos');
        $trabajadores = Trabajador::where('departamentos', Departamento::Produccion->value)->get();
        Log::info('Trabajadores encontrados: ' . $trabajadores->count());

        foreach ($trabajadores as $trabajador) {
            // Verificar si ya tiene un código de operario asignado
            Log::info('Procesando trabajador: ' . $trabajador->id);
            if (!Operativo::where('trabajador_id', $trabajador->id)->exists()) {
                Log::info('Trabajador no tiene código, asignando...');
                try {
                    DB::transaction(function () use ($trabajador) {
                        // Generar un código único
                        $codigo = $this->generateUniqueCode();
                        
                        // Depurar el nombre del trabajador y el código generado
                        Log::info('Asignando código a trabajador:', [
                            'trabajador_id' => $trabajador->id,
                            'operario' => $trabajador->nombre,
                            'codigo' => $codigo
                        ]);
                        $operativo = Operativo::create([
                            'codigo' => $codigo,
                            'trabajador_id' => $trabajador->id,
                            'operario' => $trabajador->nombre,
                        ]);
    
                        // Depurar el resultado de la creación
                        Log::info('Operativo creado:', ['operativo' => $operativo]);
                        });
                        Log::info('Código asignado correctamente');
                    } catch (\Exception $e) {
                        Log::error('Error al asignar código: ' . $e->getMessage());
                    }
                } else {
                    Log::info('Trabajador ya tiene código asignado');
            }
        }

        return redirect()->route('listar.operarios')->with('success', 'Códigos de operarios asignados con éxito.');
    }

    private function generateUniqueCode()
    {
        $latestOperativo = Operativo::latest('codigo')->first();
        
        if (!$latestOperativo) {
            $nextNumber = 1;
        } else {
            $lastCode = $latestOperativo->codigo;
            $lastNumber = intval(substr($lastCode, 2));
            $nextNumber = $lastNumber + 1;
        }

        return 'OP' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function listarOperativos()
    {
        // Obtener trabajadores del departamento de producción que tengan un código de operario asignado
        $operativos = Operativo::with('trabajador')->orderBy('codigo')->get();


        return view('trabajadores.operativos', compact('operativos'));
    }

    public function destroy(string $id)
    {
        $operarios = Operativo::findOrFail($id);
        $operarios->delete();

        return redirect()->route('listar.operarios')->with('success', 'operario eliminado');
    }
}