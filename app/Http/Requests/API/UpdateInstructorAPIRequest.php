<?php

namespace App\Http\Requests\API;

use App\Models\Instructor;
use InfyOm\Generator\Request\APIRequest;

class UpdateInstructorAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = \Auth::user();
        if ($user->isApiAgent()) {
            return true;
        }
        return ($user->AccountID == $this->route('account'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Instructor::$rules;
    }
}
