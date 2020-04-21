<?php

namespace App\Http\Controllers;

use App\CovidCase;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {

        $totalDailyCases = [
            'chart_title'           => 'Cases Daily',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\CovidCase',
            'group_by_field'        => 'date_detected',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '365',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col',
            'entries_number'        => '5',
        ];

        $chartDailyCasesCount = new LaravelChart($totalDailyCases);


        $summary = new Fluent();
        $summary->totalCases = CovidCase::count();
        $summary->totalCritical = CovidCase::where('critical', 1)->count();
        $summary->totalActive = CovidCase::where('status', 'active')->count();
        $summary->totalActivePercentage = floatval(round(($summary->totalActive/$summary->totalCases)*100, 2)) . '%';
        $summary->totalDeceased = CovidCase::where('status', 'deceased')->count();
        $summary->totalDeceasedPercentage = floatval(round(($summary->totalDeceased/$summary->totalCases)*100, 2)) . '%';
        $summary->totalRecovered = CovidCase::where('status', 'recovered')->count();
        $summary->totalRecoveredPercentage = floatval(round(($summary->totalRecovered/$summary->totalCases)*100, 2)) . '%';

        return view('dashboard', compact('summary', 'chartDailyCasesCount'));
    }
}
