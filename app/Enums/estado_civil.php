<?php

namespace App\Enums;

enum estado_civil:string {
    case soltero = 'soltero';
    case soltera = 'soltera';
    case casado = 'casado';
    case casada = 'casada';
    case union_libre = 'union_libre';
    case divorciado = 'divorciado';
    case divorciada = 'divorciada';
}