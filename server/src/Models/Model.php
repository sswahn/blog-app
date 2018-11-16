<?php
/**
 * Model
 * 
 */

namespace src\Models;

class Model
{
    protected function call(string $sql, array $values) : array
    {
        try {

            $database = Database::getConnection();

            $statement = $database->prepare($sql);

            $this->bindAll($statement, $values);

            $statement->execute();

            $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
        } catch (\PDOException $pe) {
            
            throw new \Exception('Database error.', 500);
        }
    }

    private function bindAll($statement, array $values) : void
    {
        foreach ($values as $key => $value)
        {
            $statement->bindParam(":$key", $values);
        }
    }
}