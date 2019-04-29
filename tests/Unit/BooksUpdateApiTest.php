<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Tests\TestCase;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class BooksUpdateApiTest
 * @package Tests\Unit
 */
class BooksUpdateApiTest extends TestCase
{
    use MakesHttpRequests;

    public function testValidUpdate()
    {
        $data['name'] = 'name ' . base64_encode(random_bytes(10));
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);

        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());

        $created = json_decode($response->getContent())->data;

        $data['name'] = 'up ' . base64_encode(random_bytes(10));;
        $data['price'] = 34;
        $data['category'] = 'cat up';
        $data['author'] = 'author up';

        $response = $this->call('PUT', 'v1/books/' . $created->id, $data);

        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $updated = json_decode($response->getContent())->data;

        $this->assertEquals($data['name'], $updated->name);
        $this->assertEquals($data['price'], $updated->price);
        $this->assertEquals( $data['category'], $updated->category);
        $this->assertEquals($data['author'], $updated->author);
    }

    public function testUpdateInValidPrice()
    {
        $data['name'] = 'name ' . base64_encode(random_bytes(10));
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);

        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());

        $created = json_decode($response->getContent())->data;

        $data['name'] = 'up ' . base64_encode(random_bytes(10));
        $data['price'] = 'aa';
        $data['category'] = 'cat up';
        $data['author'] = 'author up';

        $response = $this->call('PUT', 'v1/books/' . $created->id, $data);
        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
