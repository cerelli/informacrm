{{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script> --}}



<div class="container">
  <table id="tabactions" class="table table-hover table-condensed" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Notes</th>
            <th>Account_id</th>
        </tr>
    </thead>
  </table>
</div>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabactions').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('datatable.getposts') }}",
        "columns": [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'notes', name: 'notes'},
            {data: 'account_id', name: 'account_id'}
        ]
    });
});
</script>

{{-- </html>// "ajax": "{{ route('datatable.getposts') }}", --}}
