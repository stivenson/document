<?php

use Faker\Factory as Faker;
use App\Models\Document;
use App\Repositories\DocumentRepository;

trait MakeDocumentTrait
{
    /**
     * Create fake instance of Document and save it in database
     *
     * @param array $documentFields
     * @return Document
     */
    public function makeDocument($documentFields = [])
    {
        /** @var DocumentRepository $documentRepo */
        $documentRepo = App::make(DocumentRepository::class);
        $theme = $this->fakeDocumentData($documentFields);
        return $documentRepo->create($theme);
    }

    /**
     * Get fake instance of Document
     *
     * @param array $documentFields
     * @return Document
     */
    public function fakeDocument($documentFields = [])
    {
        return new Document($this->fakeDocumentData($documentFields));
    }

    /**
     * Get fake data of Document
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDocumentData($documentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'headline' => $fake->word,
            'reward' => $fake->word,
            'status' => $fake->word,
            'telephone' => $fake->word,
            'photo_id' => $fake->randomDigitNotNull,
            'users_id' => $fake->randomDigitNotNull,
            'type_document_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $documentFields);
    }
}
