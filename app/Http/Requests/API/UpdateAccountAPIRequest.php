<?php

namespace App\Http\Requests\API;

use App\Models\Account;
use InfyOm\Generator\Request\APIRequest;

class UpdateAccountAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        if ($user && $user->isApiAgent()) {
            return true;
        }
        return $user && ($user->AccountID == $this->route('account'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Account::$rules;
    }
}
