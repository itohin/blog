<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\QueryBuilder;

class UsersRepository
{
    private QueryBuilder $queryBuilder;

    private string $table = 'users';

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function findBy($field, $value)
    {
        return $this->queryBuilder->selectBy($this->table, $field, $value);
    }

    public function create($inputs)
    {
        return $this->queryBuilder->insert($this->table, $inputs);
    }

    public function update($field, $value, $inputs)
    {
        $this->queryBuilder->updateBy($this->table, $field, $value, $inputs);
    }
}