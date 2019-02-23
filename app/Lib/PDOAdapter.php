<?php

namespace App\Lib;

use App\Lib\Interfaces\StorageAdapterInterface;

class PDOAdapter implements StorageAdapterInterface
{
    /** @var \PDO */
    private $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function get(string $table, $id): ?array
    {
        $query = 'SELECT * FROM ' . $table . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->execute([$id]);

        if ($stmt->rowCount()) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getByFieldValue(string $table, string $fieldName, $fieldValue): ?array
    {
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $fieldName . ' = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->execute([$fieldValue]);

        if ($stmt->rowCount()) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function insert(string $table, array $data): int
    {
        $query = 'INSERT INTO ' . $table . '('. implode(',', array_keys($data)) .')
                  VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';

        $stmt = $this->connection->prepare($query);
        $stmt->execute(array_values($data));

        return $this->connection->lastInsertId();
    }

    public function update(string $table, $id, array $data): void
    {
        $parameters = [];
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = $key . ' = ?';
            $parameters[] = $value;
        }

        $parameters[] = $id;

        $query = 'UPDATE ' . $table .  ' SET ' . implode(',', $set) . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);
        $stmt->execute($parameters);
    }

    public function delete(string $table, $id): void
    {
        $query = 'DELETE FROM ' . $table . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
    }

    public function getAll(string $table): array
    {
        return $this->connection->query('SELECT * FROM ' . $table)->fetchAll(\PDO::FETCH_ASSOC);
    }
}