<?php


namespace Todo\Infrastructure\Persistence\PDO;


interface DAO
{
    public function create(array $data);
    public function update(array $data);
    public function delete(string $id);
}