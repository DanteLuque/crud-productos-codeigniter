<?php

namespace App\Models\Ubigeo;

use CodeIgniter\Model;

class Provincia extends Model
{
    protected $table      = 'provincias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['departamento_id', 'name'];

    public function listarPorDepartamento(int $departamentoId): array
    {
        return $this->where('departamento_id', $departamentoId)
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
