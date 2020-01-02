<?php


namespace Todo\Infrastructure\Persistence\PDO;

use PDO;

class TodoDAO implements DAO
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function create(array $data)
    {
        $sql = "INSERT INTO todos (id, name, status, owner_id, owner_username, owner_email) 
                VALUES (:id, :name,  :status, :owner_id, :owner_username, :owner_email)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':owner_id' => $data['owner_id'],
            ':owner_username' => $data['owner_username'],
            ':owner_email' => $data['owner_email'],
            ':status' => $data['status'],
        ]);
    }

    public function update(array $data)
    {
        $sql = "UPDATE todos SET name=:name, 
                status=:status, 
                owner_id=:owner_id, 
                owner_username=:owner_username, 
                owner_email=:owner_email WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':owner_id' => $data['owner_id'],
            ':owner_username' => $data['owner_username'],
            ':owner_email' => $data['owner_email'],
            ':status' => $data['status'],
        ]);

    }

    public function delete(string $id)
    {
        // TODO: Implement delete() method.
    }

    public function findById(string $id)
    {
        $sql = "SELECT * FROM todos WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
           ':id' => $id
        ]);
        return $stmt->fetch();
    }
}