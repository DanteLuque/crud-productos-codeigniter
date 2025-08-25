<?php
namespace App\Models;

class Producto extends BaseModel
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre',
        'imagen',
        'descripcion',
        'precio',
        'descuento',
        'categoria_id'
    ];
}
