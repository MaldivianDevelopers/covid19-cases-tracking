<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <style>
        [x-cloak] {
            display: none;
        }

        [type="checkbox"] {
            box-sizing: border-box;
            padding: 0;
        }

        .form-checkbox {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            display: inline-block;
            vertical-align: middle;
            background-origin: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            flex-shrink: 0;
            color: currentColor;
            background-color: #fff;
            border-color: #e2e8f0;
            border-width: 1px;
            border-radius: 0.25rem;
            height: 1.2em;
            width: 1.2em;
        }

        .form-checkbox:checked {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
            border-color: transparent;
            background-color: currentColor;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    @include('partials.analytics')
</head>
<body>
<div class="py-12 bg-white">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <p class="text-base leading-6 text-indigo-600 font-semibold tracking-wide uppercase">COVID19 CASE REPORTING</p>
            <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                TRACKING FOR MALDIVES
            </h3>
            <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
                This is an initiative taken by developers of Maldives. A collaborative effort to keep track of cases with support from the public communities.
            </p>
{{--            <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-800 lg:mx-auto">--}}
{{--                You can help us keep an updated and most accurate information.--}}
{{--            </p>--}}
        </div>

        <div class="mt-10">


            <div class="flex flex-col md:flex-row justify-center">

                <div class="max-w-sm rounded overflow-hidden md:shadow-lg border mx-1 my-2">
                    <div class="px-6 py-4">
                        <div class="font-bold text-sm text-gray-600 mb-2">TOTAL CASES</div>
                        <div>
                            <span class="font-bold text-4xl mb-2">{{ $summary->totalCases }}</span>
                            <span class="text-xs text-red-400">{{ $summary->totalCritical }} {{ $summary->totalCritical > 1 ? \Str::plural(trans('cruds.covidCase.fields.critical')) : trans('cruds.covidCase.fields.critical') }}</span>

                        </div>
                    </div>
                </div>

                <div class="max-w-sm rounded overflow-hidden md:shadow-lg border mx-1 my-2">
                    <div class="px-6 py-4">
                        <div class="font-bold text-sm text-gray-600 mb-2">ACTIVE CASES</div>
                        <div>
                            <span class="font-bold text-4xl mb-2">{{ $summary->totalActive }}</span>
                            <span class="text-xs text-gray-400"><span class="text-green-300">{{ $summary->totalActivePercentage }}</span> of total cases</span>

                        </div>
                    </div>
                </div>

                <div class="max-w-sm rounded overflow-hidden md:shadow-lg border mx-1 my-2">
                    <div class="px-6 py-4">
                        <div class="font-bold text-sm text-gray-600 mb-2">DECEASED</div>
                        <div>
                            <span class="font-bold text-4xl mb-2">{{ $summary->totalDeceased }}</span>
                            <span class="text-xs text-gray-400"><span class="text-red-300">{{ $summary->totalDeceasedPercentage }}</span> of total cases</span>

                        </div>
                    </div>
                </div>

                <div class="max-w-sm rounded overflow-hidden md:shadow-lg border mx-1 my-2">
                    <div class="px-6 py-4">
                        <div class="font-bold text-sm text-gray-600 mb-2">RECOVERED</div>
                        <div>
                            <span class="font-bold text-4xl mb-2">{{ $summary->totalRecovered }}</span>
                            <span class="text-xs text-gray-400"><span class="text-blue-300">{{ $summary->totalRecoveredPercentage }}</span> of total cases</span>

                        </div>
                    </div>
                </div>

            </div>

            <div>
                {!! $chartDailyCasesCount->renderHtml() !!}
            </div>


{{--            @include('reports/cases_table')--}}

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    {!! $chartDailyCasesCount->renderJs() !!}
</div>
</body>
</html>
