<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\CovidCase;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCovidCaseRequest;
use App\Http\Requests\UpdateCovidCaseRequest;
use App\Http\Resources\Admin\CovidCaseResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CovidCaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('covid_case_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CovidCaseResource(CovidCase::with(['source'])->get());

    }

    public function store(StoreCovidCaseRequest $request)
    {
        $covidCase = CovidCase::create($request->all());

        return (new CovidCaseResource($covidCase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(CovidCase $covidCase)
    {
        abort_if(Gate::denies('covid_case_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CovidCaseResource($covidCase->load(['source']));

    }

    public function update(UpdateCovidCaseRequest $request, CovidCase $covidCase)
    {
        $covidCase->update($request->all());

        return (new CovidCaseResource($covidCase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(CovidCase $covidCase)
    {
        abort_if(Gate::denies('covid_case_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidCase->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
