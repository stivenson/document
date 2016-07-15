<?php

namespace document\Http\Requests\API;

use document\Models\Typedocument;
use InfyOm\Generator\Request\APIRequest;

class CreateTypedocumentAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Typedocument::$rules;
    }
}
