<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagBindRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tag_id'=>'required|exists:tags,id',
            'source_id'=>'required|exists:sources,id'
        ];
    }
}
