<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|min:4',
            'description' => 'required',
            'duration' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title không được bỏ trống',
            'title.min' => 'Title phải trên 4 kí tự',
            'description.required' => 'Description không được bỏ trống',
            'duration.required' => 'Duration không được bỏ trống',
            
        ];
    }
}
