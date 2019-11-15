<?php

namespace App\Http\Requests\API;

use App\Models\AccountAvatar;
use InfyOm\Generator\Request\APIRequest;

class DeleteAccountAvatarAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isApiAgent()) {
            return true;
        }
        return $this->user()->AccountID == $this->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
