<?php

namespace App\Http\Requests;

use App\CovidCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCovidCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('covid_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:covid_cases,id',
        ];

    }
}
