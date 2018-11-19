<?php
/**
 * Blog Model Unit Test
 * 
 */

namespace Tests\Functional;

use Slim\Http\Request;
use Slim\Http\Environment;

class BlogTest extends BaseTestCase
{
    private $model;

    public function setUp()
    {
        $this->model = new \src\Models\Blog();
    }

    public function testGet()
    {
        $data = $this->model->get();

        foreach ($data as $value)
        {
            $this->assertArrayHasKey('subject', $value);

            $this->assertArrayHasKey('message', $value);

            $this->assertTrue(isset($value['subject']) && !empty($value['subject']));

            $this->assertTrue(isset($value['message']) && !empty($value['message']));
        }
    }

    public function testGetOne()
    {
        $data = $this->model->getOne(['id' => 1]);

        $this->assertCount(1, $data);

        $this->assertArrayHasKey('subject', $data[0]);

        $this->assertArrayHasKey('message', $data[0]);

        $this->assertTrue(isset($data[0]['subject']) && !empty($data[0]['subject']));

        $this->assertTrue(isset($data[0]['message']) && !empty($data[0]['message']));
    }

    public function testPost()
    {
        $this->expectException(\Exception::class);

        $environment = Environment::mock([
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI' => '/api/v1/blog'
        ]);

        $request = Request::createFromEnvironment($environment);      

        $invalidData = ['subject' => null, 'message' => ''];

        $request = $request->withParsedBody($invalidData);

        $this->model->post($request);
    }

    public function testPut()
    {
        $this->expectException(\Exception::class);

        $environment = Environment::mock([
            'REQUEST_METHOD' => 'PUT',
            'REQUEST_URI' => '/api/v1/blog/1'
        ]);

        $request = Request::createFromEnvironment($environment);      

        $invalidData = ['subject' => null, 'message' => ''];

        $request = $request->withParsedBody($invalidData);

        $this->model->put($request, ['id' => 1]);
    }

    public function testDelete()
    {
        $this->assertTrue(true);
    }
}