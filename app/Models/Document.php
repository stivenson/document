<?php

namespace document\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Document",
 *      required={headline, reward, status, telephone, users_id, type_document_id},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="headline",
 *          description="headline",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="reward",
 *          description="reward",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="status",
 *          description="status",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="telephone",
 *          description="telephone",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="photo_id",
 *          description="photo_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="users_id",
 *          description="users_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="type_document_id",
 *          description="type_document_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Document extends Model
{
    use SoftDeletes;

    public $table = 'documents';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'headline',
        'reward',
        'status',
        'telephone',
        'photo_id',
        'users_id',
        'type_document_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'headline' => 'string',
        'reward' => 'boolean',
        'status' => 'string',
        'telephone' => 'string',
        'photo_id' => 'integer',
        'users_id' => 'integer',
        'type_document_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'headline' => 'required',
        'reward' => 'required',
        'status' => 'required',
        'telephone' => 'required',
        'users_id' => 'required',
        'type_document_id' => 'required'
    ];
}
