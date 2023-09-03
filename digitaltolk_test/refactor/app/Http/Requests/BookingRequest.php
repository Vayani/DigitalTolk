<?php
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'from_language_id' => 'required_if:immediate,no',
            'due_date' => 'required_if:immediate,no',
            'due_time' => 'required_if:immediate,no',
            'customer_phone_type' => 'required_without:customer_physical_type',
            'customer_physical_type' => 'required_without:customer_phone_type',
            'duration' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'from_language_id.required_if' => 'Du måste fylla in alla fält.',
            'due_date.required_if' => 'Du måste fylla in alla fält.',
            'due_time.required_if' => 'Du måste fylla in alla fält.',
            'customer_phone_type.required_without' => 'Du måste göra ett val här.',
            'customer_physical_type.required_without' => 'Du måste göra ett val här.',
            'duration.required' => 'Du måste fylla in alla fält.',
        ];
    }

    // The rules method defines the validation rules for each field, including the conditional and required rules as per your original code.
    // The messages method provides custom error messages for each validation rule. These messages will be used when validation fails.
    // With this setup, the controller code remains clean, and Laravel will automatically handle the validation and display the custom error messages when validation fails.
}