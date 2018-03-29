<!-- select -->

<div @include('crud::inc.field_wrapper_attributes') >

    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')

    <?php $entity_model = $crud->model; ?>
    <select
        name="{{ $field['name'] }}"
        id="select_result"

        @include('crud::inc.field_attributes')
        >

        @if ($entity_model::isColumnNullable($field['name']))
            <option value="">-</option>
        @endif

        @if (isset($field['model']))
            @foreach ($field['model']::all() as $connected_entity_entry)
                @if(old($field['name']) == $connected_entity_entry->getKey() || (is_null(old($field['name'])) && isset($field['value']) && $field['value'] == $connected_entity_entry->getKey()))
                    <option value="{{ $connected_entity_entry->getKey() }}" selected>{{ $connected_entity_entry->{$field['attribute']} }}</option>
                @else
                    <option value="{{ $connected_entity_entry->getKey() }}">{{ $connected_entity_entry->{$field['attribute']} }}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

</div>



@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- select_template crud field JS -->
        <script>
            // function redirect_to_new_page_with_template_parameter() {
            //     var new_template = $("#select_template").val();
            //     var current_url = "{{ Request::url() }}";
            //
            //     window.location.href = strip_last_template_parameter(current_url)+'/'+new_template;
            // }
            //
            // function strip_last_template_parameter(url) {
            //     // if it's a create or edit link with a template parameter
            //     if (url.indexOf("/create/") > -1 || url.indexOf("/edit/") > -1)
            //     {
            //         // remove the last parameter of the url
            //         var url_array = url.split('/');
            //         url_array = url_array.slice(0, -1);
            //         var clean_url = url_array.join('/');
            //
            //         return clean_url;
            //     }
            //
            //     return url;
            // }

            // jQuery(document).ready(function($) {
            //     $("#select_result").change(function(e) {
            //         var select_template_confirmation = confirm("@lang('backpack::pagemanager.change_template_confirmation')");
            //         var valore = $("select#select_result").val();
            //         if (select_template_confirmation == true) {
            //             // redirect_to_new_page_with_template_parameter();
            //             $("#id_result_description").hide();
            //             console.log(valore);
            //         } else {
            //             // txt = "You pressed Cancel!";
            //             $("#id_result_description").show();
            //             console.log(valore);
            //         }
            //     });
            //
            // });
        </script>
    @endpush

@endif
