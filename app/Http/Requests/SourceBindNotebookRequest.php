<?php

namespace App\Http\Requests;


class SourceBindNotebookRequest extends BaseRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_id'=>'required|exists:sources,id',
            'notebook_id'=>'required|exists:note_books,id'
        ];
    }
}
