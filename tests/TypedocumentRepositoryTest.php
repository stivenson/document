<?php

use App\Models\Typedocument;
use App\Repositories\TypedocumentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TypedocumentRepositoryTest extends TestCase
{
    use MakeTypedocumentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypedocumentRepository
     */
    protected $typedocumentRepo;

    public function setUp()
    {
        parent::setUp();
        $this->typedocumentRepo = App::make(TypedocumentRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTypedocument()
    {
        $typedocument = $this->fakeTypedocumentData();
        $createdTypedocument = $this->typedocumentRepo->create($typedocument);
        $createdTypedocument = $createdTypedocument->toArray();
        $this->assertArrayHasKey('id', $createdTypedocument);
        $this->assertNotNull($createdTypedocument['id'], 'Created Typedocument must have id specified');
        $this->assertNotNull(Typedocument::find($createdTypedocument['id']), 'Typedocument with given id must be in DB');
        $this->assertModelData($typedocument, $createdTypedocument);
    }

    /**
     * @test read
     */
    public function testReadTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $dbTypedocument = $this->typedocumentRepo->find($typedocument->id);
        $dbTypedocument = $dbTypedocument->toArray();
        $this->assertModelData($typedocument->toArray(), $dbTypedocument);
    }

    /**
     * @test update
     */
    public function testUpdateTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $fakeTypedocument = $this->fakeTypedocumentData();
        $updatedTypedocument = $this->typedocumentRepo->update($fakeTypedocument, $typedocument->id);
        $this->assertModelData($fakeTypedocument, $updatedTypedocument->toArray());
        $dbTypedocument = $this->typedocumentRepo->find($typedocument->id);
        $this->assertModelData($fakeTypedocument, $dbTypedocument->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTypedocument()
    {
        $typedocument = $this->makeTypedocument();
        $resp = $this->typedocumentRepo->delete($typedocument->id);
        $this->assertTrue($resp);
        $this->assertNull(Typedocument::find($typedocument->id), 'Typedocument should not exist in DB');
    }
}
