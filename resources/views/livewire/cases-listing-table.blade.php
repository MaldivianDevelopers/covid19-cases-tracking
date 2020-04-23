<div class="container mx-auto py-6 px-4">

    <h3 class="text-xl mb-3 mt-6">Cases Reported</h3>
    <div class="overflow-x-auto bg-white shadow overflow-y-auto relative">
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="text-left text-sm">
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Case ID#</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Source</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Location</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Nationality</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Status</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Date Detected</th>
                    <th class="py-2 px-3 sticky top-0 border-b border-gray-200 bg-gray-100">Date Recovered</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cases as $case)
                <tr class="py-2 text-sm text-gray-800 hover:bg-gray-100">
                    <td class="border-dashed border-t border-gray-200 px-3 py-2 flex justify-between items-center">{{ $case->case_identity }}
                        @if($case->critical)
                            <span class="inline-block rounded-full bg-red-500"  title='Critical' style="height:10px; width:10px"></span>
                        @endif
                    </td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->source ? $case->source->case_identity : null }}</td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->location_detected }}</td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->nationality ?? 'N/A' }}</td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->status }}</td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->date_detected }}</td>
                    <td class="border-dashed border-t border-gray-200 px-3 py-2">{{ $case->date_recovered }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
