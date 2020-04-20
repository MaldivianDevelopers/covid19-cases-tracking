<?php

namespace App\Http\Controllers\Admin;

use App\CovidCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCovidCaseRequest;
use App\Http\Requests\StoreCovidCaseRequest;
use App\Http\Requests\UpdateCovidCaseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CovidCaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('covid_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidCases = CovidCase::all();

        return view('admin.covidCases.index', compact('covidCases'));
    }

    public function create()
    {
        abort_if(Gate::denies('covid_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sources = CovidCase::all()->pluck('case_identity', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.covidCases.create', compact('sources'));
    }

    public function store(StoreCovidCaseRequest $request)
    {
        $covidCase = CovidCase::create($request->all());

        return redirect()->route('admin.covid-cases.index');

    }

    public function edit(CovidCase $covidCase)
    {
        abort_if(Gate::denies('covid_case_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sources = CovidCase::all()->pluck('case_identity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $covidCase->load('source');

        return view('admin.covidCases.edit', compact('sources', 'covidCase'));
    }

    public function update(UpdateCovidCaseRequest $request, CovidCase $covidCase)
    {
        $covidCase->update($request->all());

        return redirect()->route('admin.covid-cases.index');

    }

    public function show(CovidCase $covidCase)
    {
        abort_if(Gate::denies('covid_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidCase->load('source', 'sourceCovidCases');

        return view('admin.covidCases.show', compact('covidCase'));
    }

    public function destroy(CovidCase $covidCase)
    {
        abort_if(Gate::denies('covid_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidCase->delete();

        return back();

    }

    public function massDestroy(MassDestroyCovidCaseRequest $request)
    {
        CovidCase::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
