<?php
namespace Eraasoft\Core\Contracts\Databases;

interface DatabaseContract {
    public function table (string $table):object;
    public function insert(array $data):int;
    public function update(array $data):object;
    public function delete():object;
    public function select(string $columns):object;
    public function where(string $column,string $operator , string $value):object;
    public function andWhere(string $column,string $operator , string $value):object;
    public function orWhere(string $column,string $operator , string $value):object;
    public function innerJoin(string $tableToJoin, string $relationRight, string $operator, string $relationLeft): object;
    public function leftJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object;
    public function rightJoin(string $tableToJoin, string $relationRight, string $operator, string $relationLeft): object;
    public function exec():int;
    public function first():array;
    public function all():array;
}