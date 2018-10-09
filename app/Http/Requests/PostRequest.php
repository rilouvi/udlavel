<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Ganti jadi true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'slug'=>'required|unique:posts',
            'excerpt'=>'required',
            'body'=>'required',
            'published_at'=>'date_format:Y-m-d H:i:s',
            'category_id'=>'required'
        ];
    }
}
