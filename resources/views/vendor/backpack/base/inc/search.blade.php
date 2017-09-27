{{-- @section('after_style') --}}
<style>
#multiple-datasets .league-name {
  margin: 0 20px 5px 20px;
  padding: 3px 0;
  border-bottom: 1px solid #ccc;
}
.dropdown-menu {
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
</style>

{{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>


    {{-- <input class="typeahead form-control" style="margin:10px auto;width:300px;" type="text"> --}}

    <div id="multiple-datasets">
      <input class="typeahead span3" type="text" placeholder="Cerca..." style="width: 280px;padding-top:0px;padding-bottom:0px;margin-top:12px;">
    </div>

    <script type="text/javascript">
        var path = "{{ url(config('backpack.base.route_prefix', 'admin').'/autocomplete') }}";
        $('#multiple-datasets .typeahead').typeahead({
            name: 'Nominativi',
            display: 'value',
          hint: false,
          highlight: true,
          source: function (query, process) {
              $.ajax({
                  url: path,
                  type: 'GET',
                  dataType: 'json',
                  data: 'query=' + query,
                  async: true,
              })
              .done(function(data) {
                  process(data);
                  console.log("success");
              })
              .fail(function() {
                  console.log("error");
              })
              .always(function() {
                  console.log("complete");
              });
              },
              templates: {
                header: '<h4 class="dropdown">Nominativi</h4>'
        } ,
              callback: {
                onClick: function (node, a, item, event) {

                  event.preventDefault();
                  console.log('qui');
                  var r = confirm("You will be redirected to:\n" + item.href + "\n\nContinue?");
                  if (r == true) {
                      window.open(item.href);
                  }

                  $('#result-container').text('');

              }}
        }).on('typeahead:selected',function(evt,data){
    console.log('data==>' + data); //selected datum object
});

    </script>
{{-- @endsection --}}
