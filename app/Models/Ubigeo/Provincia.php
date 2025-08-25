<?php

namespace App\Models\Ubigeo;

use CodeIgniter\Model;

class Provincia extends Model
{
    protected $table      = 'provincias';
    protected $primaryKey = 'id';
    protected $allowedFields = ['departamento_id', 'name'];
}
