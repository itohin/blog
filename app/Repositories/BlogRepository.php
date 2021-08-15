<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Database\QueryBuilder;

class BlogRepository
{
    private QueryBuilder $queryBuilder;

    private string $table = 'blog';

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function all()
    {
        return $this->queryBuilder->selectAll($this->table);
    }

    public function find($date)
    {
        return $this->queryBuilder->selectBy($this->table, 'date', $date);
    }

    public function create($inputs)
    {
        $inputs = [
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'date' => date('Y-m-d H:i:s')
        ];
        $this->queryBuilder->insert($this->table, $inputs);
    }

    public function update($date, $inputs)
    {
        $inputs = [
            'title' => $inputs['title'],
            'content' => $inputs['content']
        ];
        $this->queryBuilder->updateBy($this->table, 'date', $date, $inputs);
    }
}