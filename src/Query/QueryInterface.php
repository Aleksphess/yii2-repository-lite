<?php

namespace Aleksphess\Repository\Query;

interface QueryInterface
{
    public function one(array $conditions, array $relations = []): ?array;

    public function insert(array $data): ?array;

    public function update(array $data): void;

    public function delete(array $data): void;

    public function updateAll(array $data, array $conditions): int;

    public function deleteAll(array $conditions): int;

    public function all(
        array $conditions,
        array $order = [],
        int $limit = 0,
        int $offset = 0,
        array $relations = []
    ): array;

    public function aggregate(string $expression, array $conditions): string;

    public function aggregateCount(string $field = '', array $conditions = []): int;

    public function aggregateSum(string $field, array $conditions = []): float;

    public function aggregateAverage(string $field, array $conditions = []): float;

    public function aggregateMin(string $field, array $conditions = []): float;

    public function aggregateMax(string $field, array $conditions = []): float;
}
