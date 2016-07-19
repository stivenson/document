<?php

use App\Models\Photo;
use App\Repositories\PhotoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhotoRepositoryTest extends TestCase
{
    use MakePhotoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PhotoRepository
     */
    protected $photoRepo;

    public function setUp()
    {
        parent::setUp();
        $this->photoRepo = App::make(PhotoRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePhoto()
    {
        $photo = $this->fakePhotoData();
        $createdPhoto = $this->photoRepo->create($photo);
        $createdPhoto = $createdPhoto->toArray();
        $this->assertArrayHasKey('id', $createdPhoto);
        $this->assertNotNull($createdPhoto['id'], 'Created Photo must have id specified');
        $this->assertNotNull(Photo::find($createdPhoto['id']), 'Photo with given id must be in DB');
        $this->assertModelData($photo, $createdPhoto);
    }

    /**
     * @test read
     */
    public function testReadPhoto()
    {
        $photo = $this->makePhoto();
        $dbPhoto = $this->photoRepo->find($photo->id);
        $dbPhoto = $dbPhoto->toArray();
        $this->assertModelData($photo->toArray(), $dbPhoto);
    }

    /**
     * @test update
     */
    public function testUpdatePhoto()
    {
        $photo = $this->makePhoto();
        $fakePhoto = $this->fakePhotoData();
        $updatedPhoto = $this->photoRepo->update($fakePhoto, $photo->id);
        $this->assertModelData($fakePhoto, $updatedPhoto->toArray());
        $dbPhoto = $this->photoRepo->find($photo->id);
        $this->assertModelData($fakePhoto, $dbPhoto->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePhoto()
    {
        $photo = $this->makePhoto();
        $resp = $this->photoRepo->delete($photo->id);
        $this->assertTrue($resp);
        $this->assertNull(Photo::find($photo->id), 'Photo should not exist in DB');
    }
}
