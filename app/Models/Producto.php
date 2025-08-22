<?php

namespace App\Models;
use CodeIgniter\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'imagen', 'descripcion', 'precio', 'descuento'];
}