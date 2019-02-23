<?php

namespace App\Lib\Interfaces;

interface StorageAdapterInterface
{
    public function get(string $table, $id): ?array;

    public function getByFieldValue(string $table, string $fieldName, $fieldValue): ?array;

    public function insert(string $table, array $data): int;

    public function update(string $table, $id, array $data): void;

    public function delete(string $table, $id): void;

    public function getAll(string $table): array;
}