<?php

namespace App\Models;

abstract class DAO
{
    /**
     * Constroi a query baseada nas condições where (array) passadas por parâmetro
     * @param $where parâmetros where
     * @param $query Objeto query builder
     */
    static function buildQuery($where, $query)
    {
        foreach ($where as $condition) {
            $method = $condition[0]; // 'where' ou 'orWhere'
            $column = $condition[1]; // Nome da coluna
            $operator = $condition[2] ?? null; // Operador lógico (pode ser omitido)
            $value = $condition[3] ?? null; // Valor da condição (pode ser null)
        
            // Se não houver operador, significa que o terceiro valor é o valor desejado
            if ($operator === null) {
                $query->{$method}($column, $value);
            } else {
                $query->{$method}($column, $operator, $value);
            }
        }
        return $query;
    }
}
