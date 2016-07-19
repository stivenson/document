<?php

use Faker\Factory as Faker;
use App\Models\Photo;
use App\Repositories\PhotoRepository;

trait MakePhotoTrait
{
    /**
     * Create fake instance of Photo and save it in database
     *
     * @param array $photoFields
     * @return Photo
     */
    public function makePhoto($photoFields = [])
    {
        /** @var PhotoRepository $photoRepo */
        $photoRepo = App::make(PhotoRepository::class);
        $theme = $this->fakePhotoData($photoFields);
        return $photoRepo->create($theme);
    }

    /**
     * Get fake instance of Photo
     *
     * @param array $photoFields
     * @return Photo
     */
    public function fakePhoto($photoFields = [])
    {
        return new Photo($this->fakePhotoData($photoFields));
    }

    /**
     * Get fake data of Photo
     *
     * @param array $postFields
     * @return array
     */
    public function fakePhotoData($photoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'base64' => $fake->word,
            'filetype' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $photoFields);
    }
}
