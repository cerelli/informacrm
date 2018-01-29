@extends('backpack::layout')
@section('content')
    <div class="tabbable">
  <ul class="nav nav-tabs" id="interest_tabs">
      <!--top level tabs-->

    <li class="active"><a href="#all" data-toggle="tab">All</a><span class="badge bg-teal">67</span></li>
    <li><a href="#brands" data-toggle="tab">Brands</a></li>
  </ul>


  <!--top level tab content-->
  <div class="tab-content">
      <!--all tab menu-->
      <div id="all" class="tab-pane active">
          <ul class="nav nav-tabs" id="all_tabs">

              <li class="active"><a href="#all_popular" data-toggle="tab">Popular</a></li>
          </ul>
          <!--all tab content-->
          <div class="tab-content">
              <div id="all_popular" class="tab-pane active">
                  <i>all_popular interests go here</i>
              </div>
              <div id="all_unique" class="tab-pane">
                  <i>all_unique interests go here</i>
              </div>
          </div>
      </div><!--all tab pane-->

      <!--brands tab menu-->
      <div id="brands" class="tab-pane">
          <ul class="nav nav-tabs" id="brands_tabs">

              <li class="active"><a href="#brands_popular" data-toggle="tab">Popular</a></li>
              <li><a href="#brands_unique" data-toggle="tab">Unique</a></li>
          </ul>

          <!--brands tab content-->
          <div class="tab-content">
              <div id="brands_popular" class="tab-pane active">
                  <i>brands_popular interests go here</i>
              </div>
              <div id="brands_unique" class="tab-pane">
                  <i>brands_unique interests go here</i>
              </div>
          </div>

      </div><!--brands tab pane-->

  </div> <!--top level tab content-->
</div>
    <ul class="nav nav-tabs tabs-up" id="friends">
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/actions') }}" data-target="#contacts" class="media_node active span" id="contacts_tab" data-toggle="tabajax" rel="tooltip"> Contacts </a></li>
          <li><a href="/gh/gist/response.html/3843301/" data-target="#friends_list" class="media_node span" id="friends_list_tab" data-toggle="tabajax" rel="tooltip"> Friends list</a></li>
          <li><a href="/gh/gist/response.html/3843306/" data-target="#awaiting_request" class="media_node span" id="awaiting_request_tab" data-toggle="tabajax" rel="tooltip">Awaiting request</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="contacts">
            <a class="btn btn-app" id="btn_action1">
                            <span class="badge bg-teal">67</span>
                            <i class="fa fa-inbox"></i> Orders
                          </a>
        </div>
        <div class="tab-pane" id="friends_list">

        </div>
        <div class="tab-pane  urlbox span8" id="awaiting_request">

        </div>
    </div>
@endsection

@section('after_scripts')
	<script>
    $("ul.nav-tabs a").click(function (e) {
  e.preventDefault();
    $(this).tab('show');
});

    // document.getElementById("contacts_tab").click();
    $('[data-toggle="tabajax"]').click(function(e) {
        var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

        $.get(loadurl, function(data) {
            $(targ).html(data);
        });

        $this.tab('show');
        return false;
    });

$("#btn_action1").click(function(e){
              e.preventDefault();
              // sendAjaxRequest($(this),'/pages/test/');
              console.log('pippo');
          });
    $("button").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/pages/test/",
        data: {
            id: $(this).val(), // < note use of 'this' here
            access_token: $("#access_token").val()
        },
        success: function(result) {
            alert('ok');
        },
        error: function(result) {
            alert('error');
        }
    });
});
    </script>

@endsection
