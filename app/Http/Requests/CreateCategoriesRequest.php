<?php

namespace App\Http\Requests;

use App\Rules\CategoryRule;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoriesRequest extends FormRequest
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
        return [
            //
            'name'=>['required','min:3','max:40','string','unique:categories,name,id',new CategoryRule(['php','laravel','mysql','oop'])],
            'parent_id'=>'int|exists:categories,id|nullable',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:1048567|dimensions:min_width:100,min_height:100',
            'status'=>'in:active,inactive'
        ];
    }
}
