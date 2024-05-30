@extends('layouts.admin')
@section('content')
@can('supir_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.supirs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.supir.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.supir.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Supir">
                <thead>
                    <tr>
                        <th width="10">
                        <th>
                            {{ trans('cruds.supir.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir.fields.no') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supirs as $key => $supir)
                        <tr data-entry-id="{{ $supir->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $supir->id ?? '' }}
                            </td>
                            <td>
                                {{ $supir->name ?? '' }}
                            </td>
                            <td>
                                {{ $supir->alamat ?? '' }}
                            </td>
                            <td>
                                {{ $supir->no ?? '' }}
                            </td>
                            <td>
                                @can('supir_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.supirs.show', $supir->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('supir_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.supirs.edit', $supir->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('supir_delete')
                                    <form action="{{ route('admin.supirs.destroy', $supir->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('supir_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.supirs.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Supir:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection