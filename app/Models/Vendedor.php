<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class Vendedor extends BaseModel
{
    protected $table      = 'vendedores';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'UUID',
        'usuario_id',
        'email',
        'ruc',
        'telefono',
        'nombre_tienda',
        'descripcion',
    ];

    public function crear(array $data): int
    {
        $data['UUID'] = Uuid::uuid4()->toString();
        return $this->insert($data, true);
    }

    public function actualizar(int $id, array $data): bool
    {
        return $this->update($id, $data);
    }

    public function eliminar(int $id): bool
    {
        return $this->delete($id);
    }

    public function listarFullInfo(): array
    {
        return $this->select('v.*, 
                          u.nombres, 
                          u.apellidos, 
                          u.username,
                          u.premium,
                          u.rol')
            ->from('vendedores v')
            ->join('usuarios u', 'u.id = v.usuario_id')
            ->findAll();
    }
}
