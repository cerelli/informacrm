

<script>
jQuery(document).ready(function($) {
    var url = "{!! url('datatables/data/') !!}{{'/'.$active_account_id}}{{'/'.$action_type}}";
    // console.log(url);
    $('#informaTable').DataTable({
        processing: true,
        serverSide: true,
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        // show the content of the first column
                        // as the modal header
                        var data = row.data();
                        return data[0];
                    }
                } ),
                renderer: function ( api, rowIdx, columns ) {
                  var data = $.map( columns, function ( col, i ) {
                      return '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td><strong>'+col.title.trim()+':'+'<strong></td> '+
                                '<td>'+col.data+'</td>'+
                              '</tr>';
                  } ).join('');

                  return data ?
                      $('<table class="table table-striped table-condensed m-b-0">').append( data ) :
                      false;
                },
            }
        },
        language: {
              "emptyTable":     "{{ trans('backpack::crud.emptyTable') }}",
              "info":           "{{ trans('backpack::crud.info') }}",
              "infoEmpty":      "{{ trans('backpack::crud.infoEmpty') }}",
              "infoFiltered":   "{{ trans('backpack::crud.infoFiltered') }}",
              "infoPostFix":    "{{ trans('backpack::crud.infoPostFix') }}",
              "thousands":      "{{ trans('backpack::crud.thousands') }}",
              "lengthMenu":     "{{ trans('backpack::crud.lengthMenu') }}",
              "loadingRecords": "{{ trans('backpack::crud.loadingRecords') }}",
              "processing":     "<img src='{{ asset('vendor/backpack/crud/img/ajax-loader.gif') }}' alt='{{ trans('backpack::crud.processing') }}'>",
              "search":         "{{ trans('backpack::crud.search') }}",
              "zeroRecords":    "{{ trans('backpack::crud.zeroRecords') }}",
              "paginate": {
                  "first":      "{{ trans('backpack::crud.paginate.first') }}",
                  "last":       "{{ trans('backpack::crud.paginate.last') }}",
                  "next":       "<span class='hidden-xs hidden-sm'>{{ trans('backpack::crud.paginate.next') }}</span><span class='hidden-md hidden-lg'>></span>",
                  "previous":   "<span class='hidden-xs hidden-sm'>{{ trans('backpack::crud.paginate.previous') }}</span><span class='hidden-md hidden-lg'><</span>"
              },
              "aria": {
                  "sortAscending":  "{{ trans('backpack::crud.aria.sortAscending') }}",
                  "sortDescending": "{{ trans('backpack::crud.aria.sortDescending') }}"
              },
              "buttons": {
                  "copy":   "{{ trans('backpack::crud.export.copy') }}",
                  "excel":  "{{ trans('backpack::crud.export.excel') }}",
                  "csv":    "{{ trans('backpack::crud.export.csv') }}",
                  "pdf":    "{{ trans('backpack::crud.export.pdf') }}",
                  "print":  "{{ trans('backpack::crud.export.print') }}",
                  "colvis": "{{ trans('backpack::crud.export.column_visibility') }}"
              },
          },
        ajax: {
            "url": url,
            "type": "patch"
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'action_status.description', name: 'action_status.description', orderable: true, searchable: true},
        ],
        dom:
          "<'row'<'col-sm-6 hidden-xs'l><'col-sm-6 hidden-print'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-5'i><'col-sm-2'B><'col-sm-5 hidden-print'p>>",
    });
});
</script>
