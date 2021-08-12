<?php

declare(strict_types=1);

namespace App\Database;

class QueryBuilder
{
    protected \PDO $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectBy($table, $field, $value)
    {
        $statement = $this->pdo->prepare("select * from {$table} where {$field} = '{$value}'");

        $statement->execute();

        return $statement->fetch(\PDO::FETCH_OBJ);
    }

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table} order by id desc");

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function insert($table, $parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $this->pdo->lastInsertId();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updateBy($table, $field, $value, $parameters)
    {
        $params = array_map(function ($key) {
            return "{$key} = :{$key}";
        }, array_keys($parameters));
        $params = implode(', ', $params);
        $sql = sprintf(
            "update %s set %s where %s = '%s'",
            $table,
            $params,
            $field,
            $value
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}