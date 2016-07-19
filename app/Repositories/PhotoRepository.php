<?php

namespace document\Repositories;

use document\Models\Photo;
use InfyOm\Generator\Common\BaseRepository;

class PhotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'base64',
        'filetype'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Photo::class;
    }
}
