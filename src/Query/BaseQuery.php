<?php

namespace Aleksphess\Repository\Query;

abstract class BaseQuery implements QueryInterface
{
    protected $connection;

    protected $collectionName;

    public function __construct($connection, string $collectionName)
    {
        $this->connection = $connection;
        $this->collectionName = $collectionName;
    }

    public abstract function one(array $conditions, array $relations = []): ?array;

    public abstract function all(
        array $conditions,
        array $order = [],
        int $limit = 0,
        int $offset = 0,
        array $relations = []
    ): array;

    public abstract function insert(array $data): ?array;

    public abstract function update(array $data): void;

    public abstract function delete(array $data): void;

    public abstract function updateAll(array $data, array $conditions): int;

    public abstract function deleteAll(array $conditions): int;

    public abstract function aggregate(string $expression, array $conditions): string;

    public abstract function aggregateCount(string $field = '', array $conditions = []): int;

    public abstract function aggregateSum(string $field, array $conditions = []): float;

    public abstract function aggregateAverage(string $field, array $conditions = []): float;

    public abstract function aggregateMin(string $field, array $conditions = []): float;

    public abstract function aggregateMax(string $field, array $conditions = []): float;
}