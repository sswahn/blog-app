<?php
/**
 * Blog Model
 * 
 */

namespace src\Models;

class Blog extends Model
{
    public function get($cookie)
    {
        $sql = '';

        $values = [];

        return [
            'testing' => 'works.',
            'test-key' => 'test-value'
        ];

        //return parent::call($sql, $values);
    }
}