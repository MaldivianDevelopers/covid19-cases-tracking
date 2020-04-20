<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Cases Daily',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\CovidCase',
            'group_by_field'        => 'date_detected',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '90',
            'group_by_field_format' => 'd-m-Y',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'        => 'Cases by Nationality',
            'chart_type'         => 'pie',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\CovidCase',
            'group_by_field'     => 'nationality',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '90',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'        => 'Cases by Location',
            'chart_type'         => 'bar',
            'report_type'        => 'group_by_string',
            'model'              => 'App\\CovidCase',
            'group_by_field'     => 'location_detected',
            'aggregate_function' => 'count',
            'filter_field'       => 'created_at',
            'filter_days'        => '90',
            'column_class'       => 'col-md-6',
            'entries_number'     => '5',
        ];

        $chart3 = new LaravelChart($settings3);

        return view('home', compact('chart1', 'chart2', 'chart3'));
    }
}
