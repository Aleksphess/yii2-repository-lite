<?php

namespace Aleksphess\Repository\Query;

use MongoDB\BSON\ObjectId;
use yii\mongodb\Connection;
use yii\mongodb\Query;

class MongoQuery extends BaseQuery
{
    public function __construct(Connection $connection, string $collectionName)
    {
        parent::__construct($connection, $collectionName);
    }

    protected function createQuery(): Query
    {
        return new Query();
    }

    public function one(array $conditions, array $relations = []): ?array
    {
        $result = $this->createQuery()->from($this->collectionName)->where($conditions)->one($this->connection);
        return $result ? $result : null;
    }

    public function insert(array $data): array
    {
        $data['_id'] = new ObjectId();
        /** @var \yii\mongodb\Connection $connection */
        $connection = $this->connection;
        return ['_id' => $connection->getCollection($this->collectionName)->insert($data)];
    }


    public function all(array $conditions, array $order = [], int $limit = 0, int $offset = 0, array $relations = []): array
    {
        $query = $this->createQuery();
        $query
            ->from($this->collectionName)
            ->where($conditions);
        if ($limit > 0) {
            $query->limit($limit);
        }
        if ($offset > 0) {
            $query->offset($offset);
        }
        if (!empty($order)) {
            $query->orderBy($order);
        }
        return $query->all($this->connection);
    }

    public function update(array $data): void
    {
        // TODO: Implement update() method.
    }

    public function delete(array $data): void
    {
        // TODO: Implement delete() method.
    }

    public function updateAll(array $data, array $conditions): int
    {
        // TODO: Implement updateAll() method.
    }

    public function deleteAll(array $conditions): int
    {
        /** @var \yii\mongodb\Connection $connection */
        $connection = $this->connection;
        return $connection->getCollection($this->collectionName)->remove($conditions);
    }

    public function aggregate(string $expression, array $conditions): string
    {
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->select($expression)->where($conditions)->scalar($this->connection);
    }
    public function aggregateCount(string $field = '', array $conditions = []): string
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->where($conditions)->count('*', $this->connection);
    }
    public function aggregateSum(string $field, array $conditions = []): string
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->where($conditions)->sum($field, $this->connection);
    }
    public function aggregateAverage(string $field, array $conditions = []): string
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->where($conditions)->average($field, $this->connection);
    }
    public function aggregateMin(string $field, array $conditions = []): string
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->where($conditions)->min($field, $this->connection);
    }
    public function aggregateMax(string $field, array $conditions = []): string
    {
        /** @var Query $query */
        $query = $this->createQuery();
        return (string)$query->from($this->collectionName)->where($conditions)->max($field, $this->connection);
    }

    public function aggregateQuery(array $conditions, array $options): array
    {
        return (array)$this->createQuery()->getCollection($this->connection)->aggregate($conditions, $options);
    }

}