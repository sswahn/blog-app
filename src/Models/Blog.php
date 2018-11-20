<?php
/**
 * Blog Model
 * 
 */

namespace src\Models;

class Blog extends Model
{
    public function get($request) : array
    {
        $method = $request->getMethod();

        $table = 'blog';

        $values = [
            'id',
            'user_id',
            'subject',
            'message',
            'date_created',
            'date_updated'
        ];

        return parent::call($method, $table, $values);
    }

    public function getOne($request, array $args) : array
    {
        $method = $request->getMethod();

        $table = 'blog';

        $values = [
            'id',
            'user_id',
            'subject',
            'message',
            'date_created',
            'date_updated'
        ];

        $id = $args['id'];

        return parent::call($method, $table, $values, $id);
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

        $method = $request->getMethod();

        $table = 'blog';

        $values = [
            //'user_id' => $this->user['id'],
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        return parent::call($method, $table, $values);
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

        $method = $request->getMethod();

        $table = 'blog';

        $values = [
            'subject' => $params['subject'],
            'message' => $params['message']
        ];

        $id = $args['id'];

        return parent::call($method, $table, $values, $id);
    }

    public function delete($request, array $args) : array
    {
        $method = $request->getMethod();

        $table = 'blog';

        $values = [];

        $id = $args['id'];

        return parent::call($method, $table, $values, $id);
    }
}