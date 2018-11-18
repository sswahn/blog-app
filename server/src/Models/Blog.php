<?php
/**
 * Blog Model
 * 
 */

namespace src\Models;

class Blog extends Model
{
    private $user;

    public function __construct($user = [])
    {
        $this->user = $user;
    }

    public function get() : array
    {
        $table = 'blog';

        $values = [
            'id',
            'user_id',
            'subject',
            'message',
            'date_created',
            'date_updated'
        ];

        return parent::select($table, $values);
    }

    public function getOne(array $args) : array
    {
        $table = 'blog';

        $values = [
            'id',
            'user_id',
            'subject',
            'message',
            'date_created',
            'date_updated'
        ];

        $conditions = [
            'id' => $args['id']
        ];

        return parent::select($table, $values, $conditions);
    }

    public function post($request) : array
    {
        $params = $request->getParsedBody();

        if (!isset($params['subject']) || empty($params['subject'])) {
            throw new \Exception('A subject is required.', 400);
        }

        if (!isset($params['message']) || empty($params['message'])) {
            throw new \Exception('A messate is required.', 400);
        }

        $table = 'blog';

        $values = [
            //'user_id' => $this->user['id'],
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        return parent::insert($table, $values);
    }

    public function put($request, array $args) : array
    {
        $params = $request->getParsedBody();

        if (!isset($params['subject']) || empty($params['subject'])) {
            throw new \Exception('A subject is required.', 400);
        }

        if (!isset($params['message']) || empty($params['message'])) {
            throw new \Exception('A messate is required.', 400);
        }

        $table = 'blog';

        $values = [
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        $conditions = [
            'id' => $args['id']
        ];

        return parent::update($table, $values, $conditions);
    }

    public function delete(array $args) : array
    {
        $table = 'blog';

        $conditions = [
            'id' => $args['id']
        ];

        return parent::destroy($table, $conditions);
    }
}