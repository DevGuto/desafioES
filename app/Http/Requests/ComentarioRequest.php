<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioRequest extends FormRequest
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
            'comentario' => 'required|max:500',
            'usuario_id' => 'required|numeric',
            'postagem_id' => 'required|numeric'
        ];
    }

    public function messages(){
        return [
            'required' => 'O :attribute é obrigatorio.'
        ];
    }
}
