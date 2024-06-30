<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    protected $commonFields = [
        'name' => 'name',
        'mobile' => 'mobile',
        'type_id' => 'type',
        'location_type' => 'location_type',
        'price' => 'price',
        'price_remaining' => 'remaining_price',
        'photographer' => 'photographer',
        'status_id' => 'status',
        'has_video' => 'has_video',
        'date' => 'date',
        'start' => 'start_time',
        'end' => 'end_time',
        'code' => 'code',
        'sort' => 'sort',
        'password' => 'password',
        'password_confirmation' => 'password_confirmation',
        'email' => 'email',
        'is_active' => 'status',
    ];

    protected $maxChars = [
        'name' => 50,
        'mobile' => 10,
        'email' => 255,
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function messages()
    {
        $languages = \App\Models\Language::all();
        $messages = [];

        foreach ($languages as $language) {
            $languageName = strtolower($language->name);
            $fieldName = __("common.{$languageName}_name");

            $messages["name.{$language->id}.required"] = __("validation.field_required", ['attribute' => $fieldName]);
            $messages["name.{$language->id}.string"] = __("validation.string_field", ['attribute' => $fieldName]);
            $messages["name.{$language->id}.max"] = __("validation.field_max", ['attribute' => $fieldName, 'max' => $this->maxChars['name']]);
        }

        foreach ($this->commonFields as $field => $attribute) {
            $attributeName = __("common.{$attribute}");
            $messages["{$field}.required"] = __("validation.field_required", ['attribute' => $attributeName]);

            if (isset($this->maxChars[$field])) {
                $messages["{$field}.max"] = __("validation.field_max", ['attribute' => $attributeName, 'max' => $this->maxChars[$field]]);
            }
        }

        return $messages;
    }
}
