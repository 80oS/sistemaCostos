<?php

namespace App\Observers;

use App\Models\Cif;
use App\Models\CostosProduccion;

class CifObserver
{
    /**
     * Handle the Cif "created" event.
     */
    public function created(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "updated" event.
     */
    public function updated(Cif $cif)
    {
        // Llamar a la función de recalculo para todos los costos de producción
        $costosProduccion = CostosProduccion::all();

        foreach ($costosProduccion as $costoProduccion) {
            $costoProduccion->calcularManoObraDirecta();
        }
    }

    /**
     * Handle the Cif "deleted" event.
     */
    public function deleted(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "restored" event.
     */
    public function restored(Cif $cif): void
    {
        //
    }

    /**
     * Handle the Cif "force deleted" event.
     */
    public function forceDeleted(Cif $cif): void
    {
        //
    }
}
