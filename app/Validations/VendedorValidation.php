<?php

namespace App\Validations;

class VendedorValidation
{
    public array $vendedor = [
        'email'         => 'required|valid_email|is_unique_soft[vendedores.email]|max_length[70]',
        'telefono'      => 'permit_empty|numeric|min_length[6]|max_length[12]',
        'ruc'           => 'required|is_unique_soft[vendedores.ruc]|numeric|exact_length[11]',
        'nombre_tienda' => 'required|max_length[255]',
        'descripcion'   => 'required'
    ];

    public array $vendedor_errors = [
        'email' => [
            'required'       => 'El correo electrónico es obligatorio',
            'valid_email'    => 'Debe ingresar un correo válido',
            'is_unique_soft' => 'Este correo ya está registrado',
            'max_length'     => 'El correo no puede superar los 70 caracteres',
        ],
        'telefono' => [
            'numeric'    => 'El teléfono debe contener solo números',
            'min_length' => 'El teléfono debe tener al menos 6 dígitos',
            'max_length' => 'El teléfono no puede superar los 12 dígitos',
        ],
        'ruc' => [
            'required'       => 'El RUC es obligatorio',
            'is_unique_soft' => 'Este RUC ya está registrado',
            'numeric'        => 'El RUC debe contener solo números',
            'exact_length'   => 'El RUC debe tener exactamente 11 dígitos',
        ],
        'nombre_tienda' => [
            'required'   => 'El nombre de la tienda es obligatorio',
            'max_length' => 'El nombre de la tienda no puede superar los 255 caracteres',
        ],
        'descripcion' => [
            'required' => 'La descripción de la tienda es obligatoria',
        ]
    ];
}
