<?php

namespace App\Http\Requests;

use App\CovidCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateCovidCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('covid_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'cluster_name' => [
              'nullable',
              'string'
            ],
            'case_identity'    => [
                'required',
                'unique:covid_cases,case_identity,' . request()->route('covid_case')->id],
            'age'              => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
            'date_detected'    => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'symptomatic_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'date_recovered'   => [
                'date_format:' . config('panel.date_format'),
                'nullable'],
            'status'           => [
                'required'],
            'critical' => [
                'sometimes', 'boolean'
            ]
        ];

    }
}
