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
            'case_identity'    => [
                'required',
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
        ];

    }
}
