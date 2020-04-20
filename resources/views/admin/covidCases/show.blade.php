@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.covidCase.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covid-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.id') }}
                        </th>
                        <td>
                            {{ $covidCase->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.case_identity') }}
                        </th>
                        <td>
                            {{ $covidCase->case_identity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.source') }}
                        </th>
                        <td>
                            {{ $covidCase->source->case_identity ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.infection_source') }}
                        </th>
                        <td>
                            {{ App\CovidCase::INFECTION_SOURCE_SELECT[$covidCase->infection_source] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.description') }}
                        </th>
                        <td>
                            {{ $covidCase->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.nationality') }}
                        </th>
                        <td>
                            {{ $covidCase->nationality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.gender') }}
                        </th>
                        <td>
                            {{ App\CovidCase::GENDER_SELECT[$covidCase->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.age') }}
                        </th>
                        <td>
                            {{ $covidCase->age }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.location_detected') }}
                        </th>
                        <td>
                            {{ $covidCase->location_detected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.date_detected') }}
                        </th>
                        <td>
                            {{ $covidCase->date_detected }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.symptomatic_date') }}
                        </th>
                        <td>
                            {{ $covidCase->symptomatic_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.displayed_symptoms') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $covidCase->displayed_symptoms ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.date_recovered') }}
                        </th>
                        <td>
                            {{ $covidCase->date_recovered }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.status') }}
                        </th>
                        <td>
                            {{ App\CovidCase::STATUS_SELECT[$covidCase->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidCase.fields.deceased_date') }}
                        </th>
                        <td>
                            {{ $covidCase->deceased_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covid-cases.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#source_covid_cases" role="tab" data-toggle="tab">
                {{ trans('cruds.covidCase.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="source_covid_cases">
            @includeIf('admin.covidCases.relationships.sourceCovidCases', ['covidCases' => $covidCase->sourceCovidCases])
        </div>
    </div>
</div>

@endsection