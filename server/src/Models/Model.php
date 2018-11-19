<?php
/**
 * Model
 * 
 */

namespace src\Models;

class Model
{
    protected function call(string $method, string $table, array $values, $id = null) : array
    {
        switch ($method) {
            case 'GET':
                return $this->select($table, $values, $id);
            case 'POST':
                return $this->insert($table, $values);
            case 'PUT':
                return $this->update($table, $values, $id);
            case 'DELETE':
                return $this->delete($table, $id);
            default:
        }
    }

    private function select(string $table, array $values, $condition = null) : array
    {
        if (!in_array('id', $values)) {
            array_unshift($values, 'id');
        }

        $select = "SELECT ". implode(', ', $values) ." FROM $table";

        if (false !== strpos($condition, 'ORDER BY')) {
            $select .= " $condition";
        }

        if (ctype_digit($condition)) {
            $select .= " WHERE id=$condition";
        }  
        
        try {

            $database = Database::getConnection();

            $statement = $database->prepare($select);

            $statement->execute();

            $data = $statement->fetchAll(\PDO::FETCH_ASSOC);

            return [
                'data' => filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS)
            ];

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    private function insert(string $table, array $values) : array
    {   
        $date = date("Y-m-d H:i:s");

        $values['date_created'] = $date;

        $values['date_updated'] = $date;

        $keys = array_keys($values);

        $insert = "INSERT INTO $table (". implode(', ', $keys) .") VALUES (:" . implode(', :', $keys) . ")";

        try {

            $database = Database::getConnection();

            $statement = $database->prepare($insert);

            $this->bindAll($statement, $values);

            $statement->execute();

            return $this->select($table, $keys, "ORDER BY id DESC LIMIT 1;");

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    private function update(string $table, array $values, int $id) : array
    {
        $values['date_updated'] = date("Y-m-d H:i:s");

        $keys = array_keys($values);

        $columns = '';

        foreach ($keys as $key) 
        {
            $columns .= "$key = :$key, ";
        }

        $columns = rtrim($columns, ', ');

        $update = "UPDATE $table SET $columns WHERE id=$id";

        try {

            $database = Database::getConnection();

            $statement = $database->prepare($update);

            $this->bindAll($statement, $values);

            $statement->execute();

            return $this->select($table, $keys, $id);

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    private function delete(string $table, int $id) : array
    {
        $delete = "DELETE FROM $table WHERE id=$id";

        try {

            $database = Database::getConnection();

            $statement = $database->prepare($delete);

            $statement->execute();

            return [
                'status' => 204,
                'data' => []
            ];

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    private function bindAll($statement, array $values) : void
    {
        foreach ($values as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }
    }
}