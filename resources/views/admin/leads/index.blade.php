@extends('layouts.admin')
@section('content')
<div class="content">
    @can('lead_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.leads.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.lead.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'Lead', 'route' => 'admin.leads.parseCsvImport'])
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
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Lead">
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
                                    {{ trans('cruds.lead.fields.account_manager') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lead_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leads.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.leads.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'category_name', name: 'category.name' },
{ data: 'company_name', name: 'company_name' },
{ data: 'contact_name', name: 'contact_name' },
{ data: 'contact_number', name: 'contact_number' },
{ data: 'contact_mail', name: 'contact_mail' },
{ data: 'event', name: 'event' },
{ data: 'account_manager', name: 'account_manager' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  $('.datatable-Lead').DataTable(dtOverrideGlobals);
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
});

</script>
@endsection