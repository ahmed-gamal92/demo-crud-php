<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Tests\TestCase;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class BooksCreationApiTest
 * @package Tests\Unit
 */
class BooksCreationApiTest extends TestCase
{
    use MakesHttpRequests;

    public function testValidCreation()
    {
        $data['name'] = 'name qq' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);

        $this->assertEquals(IlluminateResponse::HTTP_CREATED, $response->getStatusCode());

        $created = json_decode($response->getContent())->data;
        $this->assertEquals($data['name'], $created->name);
        $this->assertEquals($data['price'], $created->price);
        $this->assertEquals($data['category'], $created->category);
        $this->assertEquals($data['author'], $created->author);
    }

    public function testCreationInValidPrice()
    {
        $data['name'] = 'name ' . base64_encode(random_bytes(10));;
        $data['price'] = 'ss';
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);

        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreationNullAttributes()
    {
        $data['name'] = null;
        $data['price'] = 11;
        $data['category'] = null;
        $data['author'] = null;

        $response = $this->call('POST', 'v1/books', $data);

        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testCreationWithNonUniqueName()
    {
        $data['name'] = 'name 123 ' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_CREATED, $response->getStatusCode());

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
