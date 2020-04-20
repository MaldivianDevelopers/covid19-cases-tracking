@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.covidCase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.covid-cases.update", [$covidCase->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="case_identity">{{ trans('cruds.covidCase.fields.case_identity') }}</label>
                <input class="form-control {{ $errors->has('case_identity') ? 'is-invalid' : '' }}" type="text" name="case_identity" id="case_identity" value="{{ old('case_identity', $covidCase->case_identity) }}" required>
                @if($errors->has('case_identity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('case_identity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.case_identity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="source_id">{{ trans('cruds.covidCase.fields.source') }}</label>
                <select class="form-control select2 {{ $errors->has('source') ? 'is-invalid' : '' }}" name="source_id" id="source_id">
                    @foreach($sources as $id => $source)
                        <option value="{{ $id }}" {{ ($covidCase->source ? $covidCase->source->id : old('source_id')) == $id ? 'selected' : '' }}>{{ $source }}</option>
                    @endforeach
                </select>
                @if($errors->has('source'))
                    <div class="invalid-feedback">
                        {{ $errors->first('source') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.source_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.covidCase.fields.infection_source') }}</label>
                <select class="form-control {{ $errors->has('infection_source') ? 'is-invalid' : '' }}" name="infection_source" id="infection_source">
                    <option value disabled {{ old('infection_source', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\CovidCase::INFECTION_SOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('infection_source', $covidCase->infection_source) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('infection_source'))
                    <div class="invalid-feedback">
                        {{ $errors->first('infection_source') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.infection_source_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.covidCase.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $covidCase->description) }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nationality">{{ trans('cruds.covidCase.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $covidCase->nationality) }}">
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.covidCase.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender">
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\CovidCase::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', $covidCase->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="age">{{ trans('cruds.covidCase.fields.age') }}</label>
                <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', $covidCase->age) }}" step="1">
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.age_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location_detected">{{ trans('cruds.covidCase.fields.location_detected') }}</label>
                <input class="form-control {{ $errors->has('location_detected') ? 'is-invalid' : '' }}" type="text" name="location_detected" id="location_detected" value="{{ old('location_detected', $covidCase->location_detected) }}">
                @if($errors->has('location_detected'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location_detected') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.location_detected_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_detected">{{ trans('cruds.covidCase.fields.date_detected') }}</label>
                <input class="form-control date {{ $errors->has('date_detected') ? 'is-invalid' : '' }}" type="text" name="date_detected" id="date_detected" value="{{ old('date_detected', $covidCase->date_detected) }}">
                @if($errors->has('date_detected'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_detected') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.date_detected_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="symptomatic_date">{{ trans('cruds.covidCase.fields.symptomatic_date') }}</label>
                <input class="form-control date {{ $errors->has('symptomatic_date') ? 'is-invalid' : '' }}" type="text" name="symptomatic_date" id="symptomatic_date" value="{{ old('symptomatic_date', $covidCase->symptomatic_date) }}">
                @if($errors->has('symptomatic_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('symptomatic_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.symptomatic_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('displayed_symptoms') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="displayed_symptoms" value="0">
                    <input class="form-check-input" type="checkbox" name="displayed_symptoms" id="displayed_symptoms" value="1" {{ $covidCase->displayed_symptoms || old('displayed_symptoms', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="displayed_symptoms">{{ trans('cruds.covidCase.fields.displayed_symptoms') }}</label>
                </div>
                @if($errors->has('displayed_symptoms'))
                    <div class="invalid-feedback">
                        {{ $errors->first('displayed_symptoms') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.displayed_symptoms_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_recovered">{{ trans('cruds.covidCase.fields.date_recovered') }}</label>
                <input class="form-control date {{ $errors->has('date_recovered') ? 'is-invalid' : '' }}" type="text" name="date_recovered" id="date_recovered" value="{{ old('date_recovered', $covidCase->date_recovered) }}">
                @if($errors->has('date_recovered'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_recovered') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.date_recovered_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.covidCase.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\CovidCase::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $covidCase->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deceased_date">{{ trans('cruds.covidCase.fields.deceased_date') }}</label>
                <input class="form-control {{ $errors->has('deceased_date') ? 'is-invalid' : '' }}" type="text" name="deceased_date" id="deceased_date" value="{{ old('deceased_date', $covidCase->deceased_date) }}">
                @if($errors->has('deceased_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('deceased_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidCase.fields.deceased_date_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection