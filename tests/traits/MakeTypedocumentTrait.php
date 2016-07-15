<?php

use Faker\Factory as Faker;
use App\Models\Typedocument;
use App\Repositories\TypedocumentRepository;

trait MakeTypedocumentTrait
{
    /**
     * Create fake instance of Typedocument and save it in database
     *
     * @param array $typedocumentFields
     * @return Typedocument
     */
    public function makeTypedocument($typedocumentFields = [])
    {
        /** @var TypedocumentRepository $typedocumentRepo */
        $typedocumentRepo = App::make(TypedocumentRepository::class);
        $theme = $this->fakeTypedocumentData($typedocumentFields);
        return $typedocumentRepo->create($theme);
    }

    /**
     * Get fake instance of Typedocument
     *
     * @param array $typedocumentFields
     * @return Typedocument
     */
    public function fakeTypedocument($typedocumentFields = [])
    {
        return new Typedocument($this->fakeTypedocumentData($typedocumentFields));
    }

    /**
     * Get fake data of Typedocument
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTypedocumentData($typedocumentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'abbreviation' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $typedocumentFields);
    }
}
