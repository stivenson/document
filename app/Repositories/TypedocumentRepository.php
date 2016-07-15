<?php

namespace document\Repositories;

use document\Models\Typedocument;
use InfyOm\Generator\Common\BaseRepository;

class TypedocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'abbreviation'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Typedocument::class;
    }
}
