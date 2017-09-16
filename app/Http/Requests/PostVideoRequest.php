<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostVideoRequest extends Request
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

    public function messages()
    {
        return [
            'post_title.required' => 'A title is required',
            'description.required'  => 'A description is required',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_title'=>'required',
            'description'=>'min:5',
            'tags_1'=>'required',
            'post_types'=>'required|in:published,drafted,unpublished',
            //'post_thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif|max:300',
            'video_title'=>'required|min:5|max:255',
            //'video_url'=>'required|unique:videos,url',
            'video_types'=>'in:published,unpublished'
        ];
    }
}
