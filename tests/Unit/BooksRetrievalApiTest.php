<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Models\Book;
use Tests\TestCase;
use Illuminate\Http\Response as IlluminateResponse;

/**
 * Class BooksRetrievalApiTest
 * @package Tests\Unit
 */
class BooksRetrievalApiTest extends TestCase
{
    use MakesHttpRequests;

    public function testRetrievalNonExitingId()
    {
        $response = $this->call('GET', 'v1/books/'. 'nonesixing');

        $this->assertEquals(IlluminateResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    public function testValidRetrieval()
    {
        $data['name'] = 'name 123 ' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_CREATED, $response->getStatusCode());
        $created = json_decode($response->getContent())->data;

        $response = $this->call('GET', 'v1/books/' . $created->id, $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $retrieved = json_decode($response->getContent())->data;
        $this->assertEquals($data['name'], $retrieved->name);
        $this->assertEquals($data['price'], $retrieved->price);
        $this->assertEquals($data['category'], $retrieved->category);
        $this->assertEquals($data['author'], $retrieved->author);
    }

    public function testIndexRetrieval()
    {
        Book::getQuery()->delete();

        $data['name'] = 'name 123 ' . base64_encode(random_bytes(10));;
        $data['price'] = 12;
        $data['category'] = 'cat';
        $data['author'] = 'author';

        $response = $this->call('POST', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_CREATED, $response->getStatusCode());

        $response = $this->call('GET', 'v1/books', $data);
        $this->assertEquals(IlluminateResponse::HTTP_OK, $response->getStatusCode());
        $retrieved = json_decode($response->getContent())->data;

        $this->assertEquals(1, count($retrieved));

        $this->assertEquals($data['name'], $retrieved[0]->name);
        $this->assertEquals($data['price'], $retrieved[0]->price);
        $this->assertEquals($data['category'], $retrieved[0]->category);
        $this->assertEquals($data['author'], $retrieved[0]->author);
    }
}
