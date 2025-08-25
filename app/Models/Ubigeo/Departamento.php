<?php

namespace App\Models\Ubigeo;

use CodeIgniter\Model;

class Departamento extends Model
{
    protected $table      = 'departamentos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    public function listar(): array
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }
}
