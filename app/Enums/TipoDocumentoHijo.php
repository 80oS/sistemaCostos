<?php

namespace App\Enums;

enum TipoDocumentoHijo: string {
    case cedula = 'cedula';
    case tarjeta_identidad = 'tarjeta de identidad';
    case pasaporte = 'pasaporte';
    case registro_civil = 'registro civil';
}