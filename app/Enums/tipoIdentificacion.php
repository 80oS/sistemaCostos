<?php

namespace App\Enums;

enum tipoIdentificacion: string {
    case cedula = 'cedula';
    case tarjeta_identidad = 'tarjeta de identidad';
    case pasaporte = 'pasaporte';
}