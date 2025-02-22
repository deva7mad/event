<div class="content">
    @can('lead_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.leads.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.lead.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.lead.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Lead">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.company_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.contact_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.contact_number') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.contact_mail') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.lead.fields.event') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $key => $lead)
                                    <tr data-entry-id="{{ $lead->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $lead->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->category->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->contact_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->contact_number ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->contact_mail ?? '' }}
                                        </td>
                                        <td>
                                            {{ $lead->event ?? '' }}
                                        </td>
                                        <td>
                                            @can('lead_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.leads.show', $lead->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('lead_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.leads.edit', $lead->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('lead_delete')
                                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lead_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leads.massDestroy') }}",
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
  $('.datatable-Lead:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection