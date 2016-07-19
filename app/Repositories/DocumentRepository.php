<?php

namespace document\Repositories;

use document\Models\Document;
use InfyOm\Generator\Common\BaseRepository;

class DocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'headline',
        'reward',
        'status',
        'telephone',
        'photo_id',
        'users_id',
        'type_document_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Document::class;
    }
}
