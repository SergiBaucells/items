<?php

namespace Baucells\Items\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreItem
 *
 * @package App\Http\Requests
 */
class StoreItem extends FormRequest
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
            'name' => 'required'
        ];
    }
}
