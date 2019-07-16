<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Academy;

class UpdateAcademyRequest extends FormRequest
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
        $academy = Academy::find($this->input('id'));
        return $academy && $this->user()->can('update', $academy);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Academy::$rules;
    }
}
