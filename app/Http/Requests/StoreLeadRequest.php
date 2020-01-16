<?php

namespace App\Http\Requests;

use App\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreLeadRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'category_id'     => [
                'required',
                'integer',
            ],
            'company_name'    => [
                'min:3',
                'max:100',
                'required',
            ],
            'contact_name'    => [
                'min:3',
                'max:50',
                'required',
            ],
            'contact_number'  => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'contact_mail'    => [
                'required',
            ],
            'event'           => [
                'required',
            ],
            'account_manager' => [
                'min:5',
                'max:100',
                'required',
            ],
        ];
    }
}
