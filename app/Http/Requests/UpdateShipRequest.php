<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShipRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required'],
            'name' => ['required'],
            'owner_name' => ['required'],
            'owner_address' => ['required'],
            'size' => ['required', 'numeric'],
            'captain_name' => ['required'],
            'crew_size' => ['required', 'numeric'],
            'license_number' => ['required'],
            'picture' => ['sometimes', 'image', 'max:2048'],
            'permit_document' => ['sometimes', 'file', 'max:2048'],
        ];
    }
}
