<?php
/**
 * Blog Model
 * 
 */

namespace src\Models;

class Blog extends Model
{
    public function get($cookie) : array
    {
        $sql = "";

        $values = [];

        return [
            'testing' => 'works.',
            'test-key' => 'test-value'
        ];

        //return parent::call($sql, $values);
    }

    public function getOne($request, $args, $cookie) : array
    {
        $sql = "";

        $values = [];

        return [
            'getOne' => 'blog api getOne request.',
            'time()' => time()
        ];
        //return parent::call($sql, $values);
    }

    public function post($request, $cookie) : array
    {
        $sql = "";

        $params = $request->getParsedBody();

        $time = time();

        if (!isset($params['subject']) || empty($params['subject'])) {
            throw new \Exception('A subject is required.', 400);
        }

        if (!isset($params['message']) || empty($params['message'])) {
            throw new \Exception('A messate is required.', 400);
        }

        $values = [
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        return $params;

        //return parent::call($sql, $values);
    }

    public function put($request, $args, $cookie) : array
    {
        $sql = "";

        $params = $request->getParsedBody();

        $time = time();

        if (!isset($params['subject']) || empty($params['subject'])) {
            throw new \Exception('A subject is required.', 400);
        }

        if (!isset($params['message']) || empty($params['message'])) {
            throw new \Exception('A messate is required.', 400);
        }

        $values = [
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        return $params;

        //return parent::call($sql, $values);
    }

    public function delete($args, $cookie) : array
    {
        $sql = "";

        $values = [];

        return [
            'status' => 'ok',
            'code' => 200
        ];

        //return parent::call($sql, $values);
    }

}