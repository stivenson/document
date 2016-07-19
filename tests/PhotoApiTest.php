<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhotoApiTest extends TestCase
{
    use MakePhotoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePhoto()
    {
        $photo = $this->fakePhotoData();
        $this->json('POST', '/api/v1/photos', $photo);

        $this->assertApiResponse($photo);
    }

    /**
     * @test
     */
    public function testReadPhoto()
    {
        $photo = $this->makePhoto();
        $this->json('GET', '/api/v1/photos/'.$photo->id);

        $this->assertApiResponse($photo->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePhoto()
    {
        $photo = $this->makePhoto();
        $editedPhoto = $this->fakePhotoData();

        $this->json('PUT', '/api/v1/photos/'.$photo->id, $editedPhoto);

        $this->assertApiResponse($editedPhoto);
    }

    /**
     * @test
     */
    public function testDeletePhoto()
    {
        $photo = $this->makePhoto();
        $this->json('DELETE', '/api/v1/photos/'.$photo->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/photos/'.$photo->id);

        $this->assertResponseStatus(404);
    }
}
