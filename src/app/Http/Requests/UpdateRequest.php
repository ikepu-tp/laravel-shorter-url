<?php

namespace ikepu_tp\ShorterUrl\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "linkId" => ["alpha_num", "required", "unique:links,linkId,{$this->route("link", "")->linkId},linkId", "max:10"],
            "name" => ["string", "required", "max:30"],
            "link" => ["url", "required"],
        ];
    }
}
