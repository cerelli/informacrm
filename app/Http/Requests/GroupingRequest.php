<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class GroupingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $grouping_type_id = \Route::current()->parameter('grouping_type_id');
        // dump($account_id);
        if ( $grouping_type_id > 0 ) {
            return [
                'title' => 'required|min:3|max:255',
                'grouping_status_id' => 'required',
            ];
        }else{
            return [
                'title' => 'required|min:3|max:255',
                'grouping_status_id' => 'required',
                'grouping_type_id' => 'required',
            ];
        }
    }


    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
