{{-- @section('after_style') --}}
<style>
#multiple-datasets-actions-grouping .actionList {
  margin: 0 20px 5px 20px;
  padding: 3px 0;
  border-bottom: 1px solid #ccc;
}


.tt-dropdown-menu {
	min-width: 200px;
	margin-top: 20px;
	padding: 5px 0;
	background-color: #ffffff;
	border: 1px solid #cccccc;
	border: 1px solid rgba(0, 0, 0, 0.15);
	border-radius: 4px;
	-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
	      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
	background-clip: padding-box;
}
/*.tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */*/
/*.tt-hint {
    width: 396px;
    height: 30px;
    padding: 8px 12px;
    font-size: 24px;
    line-height: 30px;
    border: 2px solid #ccc;
    border-radius: 8px;
    outline: none;
}*/

/* UPDATE: newer versions use tt-input instead of tt-query */
.tt-input {
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.twitter-typeahead .tt-hint {
    color: #fe0000;
}

/* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
.tt-menu {
    width: 422px;
    margin-top: 12px;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    /* left: auto !important; */
    right: 0 !important;
}

/* UPDATE: newer versions use .tt-suggestion.tt-cursor */
/*.tt-suggestion.tt-is-under-cursor {
    color: #fe0000;
    background-color: #0097cf;
}*/

.tt-suggestion {
    padding: 3px 20px;
    font-size: 18px;
    line-height: 24px;
}
</style>

{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

<form class="typeahead" role="search" >
  <div class="form-horizontal navbar-form" id="multiple-datasets-actions-grouping" >
    <input type="search" name="q" class="form-control typeahead" placeholder="{{ trans('informacrm.search') }}" autocomplete="off" style="border-radius: 5px;">
  </div>
</form>

<script type="text/javascript">
    // jQuery(document).ready(function($) {
    //Set the Options for "Bloodhound" suggestion engine
    var actions = new Bloodhound({
        remote: {
            url: '{{ url(config('backpack.base.route_prefix', 'admin')) }}/findActionsInGrouping?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $("#multiple-datasets-actions-grouping .typeahead").typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        }
            // actions
            ,{
                name: 'actionList',
                display: 'team',
                source: actions.ttAdapter(),
                templates:
                {
                    header: [
                        '<div class="list-group search-results-dropdown"><h3 class="actionList">{{ trans('informacrm.actions') }}</h3>'
                    ],
                    suggestion: function (data)
                    {
                        // console.log(data);
                        // $user = App\User::find(1); // works!
                        // echo $user->full_name;
                        var fulldescription = $.trim($.trim(data.id)+' - '+$.trim(data.title));
                        return '<p><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/action/') }}/'+data.id+'" class="tt-suggestion tt-selectable tt-is-under-cursor">'+fulldescription+'</a></p>'
                    }
                }
            }
        );

        $(document).ready(function() { /// Wait till page is loaded
    $('#click1').click(function() {
        console.log('ok');
        $('#refresh1').load('#refresh1');
        // $('#refresh21').load('mytickets #refresh21');
        // $("#show1").show();
    });
});
</script>
