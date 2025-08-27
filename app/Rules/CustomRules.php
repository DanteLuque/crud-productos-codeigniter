<?php

namespace App\Rules;

use Config\Database;

class CustomRules
{

    /**
     * Valida que un valor sea único en una tabla,
     * considerando únicamente registros activos (deleted_at = NULL).
     *
     * @param string $str   Valor a validar.
     * @param string $field Nombre de la tabla y columna en formato "tabla.columna".
     * @param array  $data  Datos adicionales pasados al validador.
     *
     * @return bool TRUE si el valor es único, FALSE en caso contrario.
     * 
     * Details: Esta es una variable de la validación predeterminada de CodeIgniter "is_unique"
     */
    public function is_unique_soft(string $str, string $field, array $data): bool
    {
        [$table, $column] = explode('.', $field);

        $db = Database::connect();
        $builder = $db->table($table);
        $builder->where($column, $str);
        $builder->where('deleted_at', null);

        return $builder->countAllResults() === 0;
    }
}
