<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;

class Usuario extends BaseModel
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'UUID',
        'nombres',
        'apellidos',
        'tipo_doi_id',
        'num_doi',
        'username',
        'userpass',
        'premium',
    ];

    public function crear(array $data): int
    {
        $data['UUID']     = Uuid::uuid4()->toString();
        $data['userpass'] = password_hash($data['userpass'], PASSWORD_BCRYPT);
        $data['premium']  = $data['premium'] ?? 0;

        return $this->insert($data, true);
    }

    public function actualizar(int $id, array $data): bool
    {
        if (!empty($data['userpass'])) {
            $data['userpass'] = password_hash($data['userpass'], PASSWORD_BCRYPT);
        } else {
            unset($data['userpass']);
        }

        return $this->update($id, $data);
    }

    public function eliminar(int $id): bool
    {
        return $this->delete($id);
    }
}
