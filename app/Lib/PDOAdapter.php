<?php

namespace App\Lib;

use App\Lib\Interfaces\StorageAdapterInterface;

final class PDOAdapter implements StorageAdapterInterface
{
    /** @var \PDO */
    private $connection;

    /**
     * PDOAdapter constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $table
     * @param $id
     * @return array|null
     */
    public function get(string $table, $id): ?array
    {
        $query = 'SELECT * FROM ' . $table . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->execute([$id]);

        $result = null;

        if ($stmt->rowCount()) {
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return $result;
    }

    /**
     * @param string $table
     * @param string $fieldName
     * @param $fieldValue
     * @return array|null
     */
    public function getByFieldValue(string $table, string $fieldName, $fieldValue): ?array
    {
        $query = 'SELECT * FROM ' . $table . ' WHERE ' . $fieldName . ' = ?';

        $stmt = $this->connection->prepare($query);

        $stmt->execute([$fieldValue]);

        $result = null;

        if ($stmt->rowCount()) {
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return $result;
    }

    /**
     * @param string $table
     * @return array
     */
    public function getAll(string $table): array
    {
        return $this->connection->query('SELECT * FROM ' . $table)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table
     * @param array $data
     * @return int
     */
    public function insert(string $table, array $data): int
    {
        $query = 'INSERT INTO ' . $table . '('. implode(',', array_keys($data)) .')
                  VALUES (' . implode(',', array_fill(0, count($data), '?')) . ')';

        $stmt = $this->connection->prepare($query);
        $stmt->execute(array_values($data));

        return $this->connection->lastInsertId();
    }

    /**
     * @param string $table
     * @param $id
     * @param array $data
     */
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

    /**
     * @param string $table
     * @param $id
     */
    public function delete(string $table, $id): void
    {
        $query = 'DELETE FROM ' . $table . ' WHERE id = ?';

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
    }
}