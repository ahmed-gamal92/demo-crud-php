<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Tests\TestCase;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class BooksDeletionApiTest
 * @package Tests\Unit
 */
class BooksDeletionApiTest extends TestCase
{
    use MakesHttpRequests;

    public function testDeletionNonExitingId()
    {
        $response = $this->call('DELETE', 'v1/books/'. 'nonesixing');

        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testValidDeletion()
    {
        $data['name'] = 'name 123 ' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $created = json_decode($response->getContent())->data;

        $response = $this->call('DELETE', 'v1/books/' . $created->id, $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
    }

    public function testValidDeletionTwice()
    {
        $data['name'] = 'name 123 ' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $created = json_decode($response->getContent())->data;

        $response = $this->call('DELETE', 'v1/books/' . $created->id, $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $response = $this->call('DELETE', 'v1/books/' . $created->id, $data);
        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
