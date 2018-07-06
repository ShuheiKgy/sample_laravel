<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMessage extends FormRequest
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
            'user_id' => 'required | exists:users,id',
            'title' => 'required | max:255',
            'content' => 'required | max:50000',
        ];
    }
    
    public function message()
    {
        return[
            'user_id.required' => '宛先を選択してください。',
        ];
    }
    
    public function attributes()
    {
        return[
            'user_id' => '宛先',
            'title' => 'タイトル',
            'content' => '本文',
        ];
    }
    
    public function getData()
    {
        return $this->only('user_id', 'title', 'content');
    }
}
