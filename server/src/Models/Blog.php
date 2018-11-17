<?php
/**
 * Blog Model
 * 
 */

namespace src\Models;

class Blog extends Model
{
    private $user;

    public function __construct($user = null)
    {
        $this->user = $user;
    }

    public function get() : array
    {
        $sql = "";

        $values = [];

        return [
            [
                'subject' => 'subject 1.',
                'message' => 'message 1'
            ],
            [
                'subject' => 'subject 2.',
                'message' => 'message 2'
            ]
        ];

        //return parent::call($sql, $values);
    }

    public function getOne(array $args) : array
    {
        $sql = "";

        $values = [];

        return [
            [
                'subject' => 'subject 1',
                'message' => 'message 1'
            ]
        ];
        //return parent::call($sql, $values);
    }

    public function post($request) : array
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

    public function put($request, array $args) : array
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

    public function delete(array $args) : array
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