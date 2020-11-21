<?php

namespace App\Http\Requests;

use App\Rules\PhrasesBlock;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'=>'required|min:7|max:40',
            'description'=>['required','min:10','max:200',new PhrasesBlock],
            'photo'=>'sometimes|image|dimensions:min_width=100,min_height=200|max:3000'
        ];
    }

    public function attributes()
    {
        return [
            'name'=>__('admin.NOMBRE'),
            'description'=>__('admin.DESCRIPCION'),
            'photo'=>__('admin.PHOTO')
        ];
    }

    public function messages()
    {
        return [
            'photo.image'=>__('admin.msg_image_validate')
        ];
    }
}
