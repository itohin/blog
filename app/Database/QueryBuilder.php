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
        $statement = $this->pdo->prepare("select * from {$table}");

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
}