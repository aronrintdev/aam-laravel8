<?php

namespace App\Http\Requests\API;

use App\Models\Academy;
use InfyOm\Generator\Request\APIRequest;

class UpdateAcademyAPIRequest extends APIRequest
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
        $academy = Academy::find($this->route('academy'));
        if($academy) $academy->AcademyID = trim($academy->AcademyID);
        return $academy && $this->user()->can('update', $academy);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //don't enforce any required params for updating
        return [];
        //return Academy::$rules;
    }
}
