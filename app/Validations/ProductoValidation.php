<?php

namespace App\Validations;

class ProductoValidation
{
    public array $producto = [
        'nombre'       => 'required|min_length[3]|max_length[150]',
        'imagen'       => 'permit_empty|is_image[imagen]|max_size[imagen,2048]|ext_in[imagen,jpg,jpeg,png]',
        'descripcion'  => 'required|min_length[50]|max_length[500]',
        'precio'       => 'required|decimal|greater_than[0]|max_length[10]',
        'descuento'    => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[100]',
        'categoria_id' => 'required|is_natural_no_zero',
    ];

    public array $producto_errors = [
        'nombre' => [
            'required'   => 'El nombre es obligatorio',
            'min_length' => 'El nombre debe tener al menos 3 caracteres',
            'max_length' => 'El nombre no puede superar los 150 caracteres',
        ],
        'imagen' => [
            'is_image'  => 'El archivo debe ser una imagen válida',
            'max_size'  => 'La imagen no puede superar los 2MB',
            'ext_in'    => 'Solo se permiten imágenes JPG y PNG',
        ],
        'descripcion' => [
            'required'   => 'La descripción es obligatoria',
            'min_length' => 'La descripción debe tener al menos 5 caracteres',
            'max_length' => 'El nombre no puede superar los 500 caracteres',
        ],
        'precio' => [
            'required'     => 'El precio es obligatorio',
            'decimal'      => 'El precio debe ser un número con decimales válidos',
            'greater_than' => 'El precio debe ser mayor que 0',
            'max_length'   => 'El precio no puede superar 7 dígitos y 2 decimales',
        ],
        'descuento' => [
            'integer'                  => 'El descuento debe ser un número entero',
            'greater_than_equal_to'    => 'El descuento no puede ser negativo',
            'less_than_equal_to'       => 'El descuento no puede ser mayor a 100',
        ],
        'categoria_id' => [
            'required'           => 'Debe seleccionar una categoría',
            'is_natural_no_zero' => 'La categoría seleccionada no es válida',
        ],
    ];
}
