<?php

namespace App\Models\Ubigeo;

use CodeIgniter\Model;

class Distrito extends Model
{
    protected $table      = 'distritos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['provincia_id', 'name'];

    public function listarPorProvincia(int $provinciaId): array
    {
        return $this->where('provincia_id', $provinciaId)
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
