<?php
/**
 * Model
 * 
 */

namespace src\Models;

class Model
{
    protected function select(string $table, array $values, $conditions = null) : array
    {
        if (!in_array('id', $values)) {
            array_unshift($values, 'id');
        }

        $select = "SELECT ". implode(', ', $values) ." FROM $table";

        $select .= $this->handleConditions($conditions);

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

    protected function insert(string $table, array $values) : array
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

    protected function update(string $table, array $values, array $conditions) : array
    {
        $values['date_updated'] = date("Y-m-d H:i:s");

        $keys = array_keys($values);

        $columns = '';

        foreach ($keys as $key) 
        {
            $columns .= "$key = :$key, ";
        }

        $columns = rtrim($columns, ', ');

        $update = "UPDATE $table SET $columns WHERE " . key($conditions) ."=". current($conditions);

        try {

            $database = Database::getConnection();

            $statement = $database->prepare($update);

            $this->bindAll($statement, $values);

            $statement->execute();

            return $this->select($table, $keys, $conditions);

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    protected function destroy(string $table, array $conditions) : array
    {
        try {

            $delete = "DELETE FROM $table WHERE ". key($conditions) ."=". current($conditions);

            $database = Database::getConnection();

            $statement = $database->prepare($delete);

            $statement->execute();

            return [];

        } catch (\PDOException $pe) {

            throw new \Exception('Database error.', 500);
        }
    }

    private function handleConditions($conditions)
    {
        if (empty($conditions)) {
            return '';
        }

        if (is_string($conditions)) {
            return " $conditions";
        }

        $suffix = " WHERE ". key($conditions) ."=". current($conditions);

        if (count($conditions) === 1) {
            return $suffix;
        }
        
        next($conditions);

        while (false !== current($conditions)) {
            $suffix .= " AND ". key($conditions) ."=". current($conditions);
            next($conditions);
        }
            
        return $suffix;
    }

    private function bindAll($statement, array $values) : void
    {
        foreach ($values as $key => $value)
        {
            $statement->bindValue(":$key", $value);
        }
    }
}