@extends('backpack::layout')
@section('content')
    <form action="{{ route('accountcomplete.store') }}" method="post">
        @csrf
        <div class="row clearfix">
            <div class="col-md-4 offset-4 text-center">
                Name 1 *:
                <br />
                <input type="text" name='account[name1]' class="form-control" placeholder="Name 1" required />
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                    <tr>
                        <th class="text-center"> # </th>
                        <th class="text-center"> AddressLine </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr id='addr0'>
                        <td>1</td>
                        <td><input type="text" name='address[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                    </tr>
                    <tr id='addr1'></tr>
                    </tbody>
                </table>
                <input type="button" id="add_row" class="btn btn-primary float-left" value="Add Row" />
                <input type="button" id='delete_row' class="float-right btn btn-info" value="Delete Row" />
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Save Account Complete" />
    </form>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
            });
        });
    </script>
@endsection
