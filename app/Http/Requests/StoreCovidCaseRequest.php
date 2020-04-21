<?php

namespace App\Http\Requests;

use App\CovidCase;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCovidCaseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('covid_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'cluster_name' => [
                'nullable',
                'string'
            ],
            'case_number_from' => [
                'required_with:is_bulk',
                'numeric'
            ],
            'case_number_to' => [
                'required_with:is_bulk',
                'numeric'
            ],
            'case_identity'    => [
                'required_without:is_bulk',
                'unique:covid_cases'],
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
