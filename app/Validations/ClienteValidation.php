<?php

namespace App\Validations;

class ClienteValidation
{
    public array $cliente = [
        'email' => 'required|valid_email|is_unique_soft[clientes.email]|max_length[70]',
        'telefono' => 'permit_empty|numeric|min_length[6]|max_length[12]',
    ];

    public array $cliente_errors = [
        'email' => [
            'required'    => 'El correo electrónico es obligatorio',
            'valid_email' => 'Debe ingresar un correo válido',
            'is_unique_soft' => 'Este correo ya está registrado',
            'max_length'  => 'El correo no puede superar los 70 caracteres',
        ],
        'telefono' => [
            'numeric'    => 'El teléfono debe contener solo números',
            'min_length' => 'El teléfono debe tener al menos 6 dígitos',
            'max_length' => 'El teléfono no puede superar los 12 dígitos',
        ],
    ];
}
