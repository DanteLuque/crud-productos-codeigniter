<?php

namespace App\Validations;

class DireccionValidation
{
    public array $direccion = [
        'distrito'    => 'required|exact_length[6]',
        'direccion' => 'required|min_length[5]',
        'referencia' => 'permit_empty|min_length[3]',
        'lat'       => 'permit_empty|decimal',
        'lng'       => 'permit_empty|decimal',
    ];

    public array $direccion_errors = [
        'distrito' => [
            'required' => 'Debe seleccionar un distrito',
            'exact_length' => 'El código de ubigeo debe tener exactamente 6 dígitos',
        ],
        'direccion' => [
            'required' => 'La dirección es obligatoria',
            'min_length' => 'La dirección debe tener mínimo 5 caracteres',
        ],
        'referencia' => [
            'min_length' => 'La referencia debe tener al menos 3 caracteres',
        ],
        'lat' => [
            'decimal' => 'La latitud debe ser un número válido',
        ],
        'lng' => [
            'decimal' => 'La longitud debe ser un número válido',
        ],
    ];
}
