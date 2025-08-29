<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class Cliente extends BaseModel
{
    protected $table      = 'clientes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'UUID',
        'usuario_id',
        'email',
        'telefono',
        'tipo_doi_id',
        'num_doi',
        'saldo',
    ];

    public function crear(array $data): int
    {
        $data['UUID'] = Uuid::uuid4()->toString();
        return $this->insert($data, true);
    }

    public function obtenerPorUsuarioId($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)->first();
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
        return $this->select('c.*, 
                          u.nombres, 
                          u.apellidos, 
                          u.username,
                          u.premium,
                          u.rol,
                          t.nombre AS tipo_doi')
            ->from('clientes c')
            ->join('usuarios u', 'u.id = c.usuario_id')
            ->join('tipo_doi t', 'c.tipo_doi_id = t.id')
            ->findAll();
    }
}
