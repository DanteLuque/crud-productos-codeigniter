<?php

namespace App\Models\Mantenimiento;

use App\Models\BaseModel;

class CatProducto extends BaseModel
{
    protected $table            = 'cat_productos';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nombre',
        'descripcion'
    ];

    public function listar(): array
    {
        return $this->orderBy('nombre', 'ASC')->findAll();
    }
}
