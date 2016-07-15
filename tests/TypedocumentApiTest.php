<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TypedocumentApiTest extends TestCase
{
    use MakeTypedocumentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTypedocument()
    {
        $typedocument = $this->fakeTypedocumentData();
        $this->json('POST', '/api/v1/typedocuments', $typedocument);

        $this->assertApiResponse($typedocument);
    }

    /**
     * @test
     */
    public function testReadTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $this->json('GET', '/api/v1/typedocuments/'.$typedocument->id);

        $this->assertApiResponse($typedocument->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $editedTypedocument = $this->fakeTypedocumentData();

        $this->json('PUT', '/api/v1/typedocuments/'.$typedocument->id, $editedTypedocument);

        $this->assertApiResponse($editedTypedocument);
    }

    /**
     * @test
     */
    public function testDeleteTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $this->json('DELETE', '/api/v1/typedocuments/'.$typedocument->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/typedocuments/'.$typedocument->id);

        $this->assertResponseStatus(404);
    }
}
