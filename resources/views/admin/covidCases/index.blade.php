@extends('layouts.admin')
@section('content')
@can('covid_case_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.covid-cases.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.covidCase.title_singular') }}
            </a>

            <a class="btn btn-info" href="{{ route("admin.covid-cases.create", ['bulk' => true]) }}">
                {{ trans('global.bulk_add') }} {{ trans('cruds.covidCase.title') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.covidCase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CovidCase">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.case_identity') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.source') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.covidCase.fields.infection_source') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.covidCase.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.nationality') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.age') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.location_detected') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.cluster_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.date_detected') }}
                        </th>
{{--                        <th>--}}
{{--                            {{ trans('cruds.covidCase.fields.symptomatic_date') }}--}}
{{--                        </th>--}}
                        <th>
                            {{ trans('cruds.covidCase.fields.displayed_symptoms') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.date_recovered') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidCase.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($covidCases as $key => $covidCase)
                        <tr data-entry-id="{{ $covidCase->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $covidCase->id ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->case_identity ?? '' }}

                                @if($covidCase->critical)
                                    <span class="badge badge-pill badge-danger" title="{{ trans('cruds.covidCase.fields.critical') }}">!</span>
                                @endif
                            </td>
                            <td>
                                {{ $covidCase->source->case_identity ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                {{ App\CovidCase::INFECTION_SOURCE_SELECT[$covidCase->infection_source] ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                {{ $covidCase->description ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->nationality ?? '' }}
                            </td>
                            <td>
                                {{ App\CovidCase::GENDER_SELECT[$covidCase->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->age ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->location_detected ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->cluster_name ?? '' }}
                            </td>
                            <td>
                                {{ $covidCase->date_detected ?? '' }}
                            </td>
{{--                            <td>--}}
{{--                                {{ $covidCase->symptomatic_date ?? '' }}--}}
{{--                            </td>--}}
                            <td>
                                <span style="display:none">{{ $covidCase->displayed_symptoms ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $covidCase->displayed_symptoms ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $covidCase->date_recovered ?? '' }}
                            </td>
                            <td>
                                {{ App\CovidCase::STATUS_SELECT[$covidCase->status] ?? '' }}
                            </td>
                            <td>
                                @can('covid_case_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.covid-cases.show', $covidCase->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('covid_case_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.covid-cases.edit', $covidCase->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('covid_case_delete')
                                    <form action="{{ route('admin.covid-cases.destroy', $covidCase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('covid_case_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.covid-cases.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-CovidCase:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
