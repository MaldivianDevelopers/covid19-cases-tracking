<?php

namespace App\Http\Controllers\Admin;

use App\CovidCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCovidCaseRequest;
use App\Http\Requests\StoreCovidCaseRequest;
use App\Http\Requests\UpdateCovidCaseRequest;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpFoundation\Response;

class CovidCaseController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('covid_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidCases = CovidCase::all();

        return view('admin.covidCases.index', compact('covidCases'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('covid_case_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sources = CovidCase::all()->pluck('case_identity', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bulk_entry = $request->query('bulk', false) == true;

        return view('admin.covidCases.create', compact('sources', 'bulk_entry'));
    }

    public function store(StoreCovidCaseRequest $request)
    {
        if($request->input('is_bulk')) {

            $fromNum = $request->input('case_number_from');
            $toNum = $request->input('case_number_to');

            $data = $request->except(['case_number_from', 'case_number_to']);
            $cases = [];
            $caseIds = [];
            foreach(range($fromNum, $toNum) as $number) {

                $caseId = config('covid.case_prefix') . str_pad($number, 3, '0', STR_PAD_LEFT);
                $caseIds[] = $caseId;
                $cases[] = new CovidCase(array_merge($data, [
                    'case_identity' => strtoupper($caseId)
                ]));
            }

            if(CovidCase::whereIn('case_identity', $caseIds)->get()->count() > 0) {
                return redirect()->route('admin.covid-cases.create', ['bulk' => 1])->with([
                    'errors' => new MessageBag([
                        'case_from_number' => 'Range already exists. Unable to create.'
                    ])
                ]);
            } else {
                foreach($cases as $case) {
                    $case->save();
                }
            }

        } else {
            $covidCase = CovidCase::create($request->all());
        }

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
