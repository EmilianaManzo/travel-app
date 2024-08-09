<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|min:3|max:50',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'photo'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:20480'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome del viaggio è un campo obbligatorio',
            'name.min' => 'Il campo deve contenere almeno :min caratteri',
            'name.max' => 'Il campo deve contenere massimo :max caratteri',
            'start_date.required' => 'Il campo è obbligatorio',
            'end.required' => 'Il campo è obbligatorio',
            'photo.image' => ' Il file deve essere un\' immagine',
            'photo.mimes' => 'Il file deve essere di tipo jpeg, png, jpg, gif o svg',
            'photo.max' => 'L\'immagine non può superare :max'
        ];
    }
}
