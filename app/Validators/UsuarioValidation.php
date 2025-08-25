<?php

namespace App\Validations;

class UsuarioValidation
{
    public array $usuario = [
        'nombres'    => 'required|min_length[2]|max_length[255]',
        'apellidos'  => 'required|min_length[2]|max_length[255]',
        'tipo_doi_id'=> 'required|is_natural_no_zero',
        'num_doi'    => 'required|min_length[5]|max_length[45]',
        'username'   => 'required|min_length[4]|max_length[70]|is_unique[usuarios.username,id,{id}]',
        'userpass'   => 'required|min_length[6]',
    ];

    public array $usuario_errors = [
        'nombres' => [
            'required' => 'El nombre es obligatorio',
        ],
        'apellidos' => [
            'required' => 'El apellido es obligatorio',
        ],
        'tipo_doi_id' => [
            'required' => 'Debe seleccionar un tipo de documento',
        ],
        'num_doi' => [
            'required' => 'Debe ingresar el número de documento',
        ],
        'username' => [
            'required' => 'El usuario es obligatorio',
            'is_unique' => 'Este nombre de usuario ya está registrado',
        ],
        'userpass' => [
            'required' => 'Debe ingresar una contraseña',
        ],
    ];
}