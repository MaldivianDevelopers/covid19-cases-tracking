<?php

namespace App\Http\Controllers\Public;

use App\CovidCase;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\QueryBuilder;

class CovidCasesPublicController extends Controller
{


    public function getListOfCases()
    {
        return QueryBuilder::for(CovidCase::class)
            ->allowedFields(['case_identity', 'nationality', 'date_detected', 'date_recovered', 'status', 'critical', 'cluster_name'])
            ->allowedSorts('case_identity', 'nationality', 'date_detected', 'status', 'critical', 'cluster_name')
            ->allowedFilters('case_identity', 'nationality', 'status', 'cluster_name')
            ->get();
    }
}
