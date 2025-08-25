<?php

namespace App\Models\Mantenimiento;

use App\Models\BaseModel;

class TipoDoi extends BaseModel
{
    protected $table = 'tipo_doi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre',
        'num_digitos'
    ];
}
