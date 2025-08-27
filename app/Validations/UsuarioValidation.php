<?php

namespace App\Validations;

class UsuarioValidation
{
    public array $usuario = [
        'nombres'    => 'required|min_length[2]',
        'apellidos'  => 'required|min_length[2]',
        'tipo_doi_id' => 'required|is_natural_no_zero',
        'num_doi'    => 'required|is_unique_soft[usuarios.num_doi]',
        'username'   => 'required|is_unique_soft[usuarios.username]|min_length[4]|max_length[70]',
        'userpass'   => 'required|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d]).{8,}$/]',
    ];

    public array $usuario_errors = [
        'nombres' => [
            'required' => 'El nombre es obligatorio',
            'min_length' => 'El nombre debe tener mínimo 2 caracteres',
        ],
        'apellidos' => [
            'required' => 'El apellido es obligatorio',
            'min_length' => 'El apellido debe tener mínimo 2 caracteres',
        ],
        'tipo_doi_id' => [
            'required' => 'Debe seleccionar un tipo de documento',
        ],
        'num_doi' => [
            'required' => 'Debe ingresar el número de documento',
            'is_unique_soft' => 'Esta identificación ya está registrada',
        ],
        'username' => [
            'required' => 'El usuario es obligatorio',
            'is_unique_soft' => 'Este nombre de usuario ya está registrado',
            'min_length' => 'El usuario debe tener mínimo 4 caracteres',
            'max_length' => 'El usuario no puede superar 70 caracteres',
        ],
        'userpass' => [
            'required' => 'Debe ingresar una contraseña',
            'regex_match' => 'La contraseña debe tener al menos una mayúscula, un número y un carácter especial',
        ],
    ];
}
