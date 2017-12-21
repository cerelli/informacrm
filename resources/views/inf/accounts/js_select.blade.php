
<script type="text/javascript">
// jQuery(document).ready(function($) {
//Set the Options for "Bloodhound" suggestion engine
var events = new Bloodhound({

	remote: {
		url: '{{ url(config('backpack.base.route_prefix', 'admin')) }}/findSelEventOpportunity?q=%QUERY%',
		// url: '/{{ Config::get('settings.route_search') }}
		wildcard: '%QUERY%'
	},

	datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
	queryTokenizer: Bloodhound.tokenizers.whitespace
});

$("#select-event-multiple-datasets .typeahead").typeahead(
	{
		hint: true,
		highlight: true,
		minLength: 1
	}
		// events
		,{
			name: 'eventList',
			display: 'team',
			source: events.ttAdapter(),
			templates:
			{
				header: [
					'<div class="list-group search-results-dropdown"><h3 class="eventList">{{ trans('informacrm.inf_events') }}</h3>'
				],
				suggestion: function (data)
				{
					console.log(data);
					// $user = App\User::find(1); // works!
					// echo $user->full_name;
					var fullname = $.trim(data.title);
					return '<p><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/account/') }}/'+data.id+'" class="tt-suggestion tt-selectable tt-is-under-cursor">'+fullname+'</a></p>'
				}
			}
		}
	);
</script>
