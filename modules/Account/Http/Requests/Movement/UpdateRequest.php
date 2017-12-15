<?php
namespace Modules\Account\Http\Requests\Movement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'date',
            'amount' => 'numeric',
            'description' => 'min:3|max:191',
            'account_id' => 'integer',
            'creditor_id' => 'integer|exists:users,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
