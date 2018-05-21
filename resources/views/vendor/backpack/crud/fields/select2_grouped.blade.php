// -- /resoruces/views/vendor/backpack/crud/fields/select2_grouped.blade.php
// -- Beginning and end of standard select2 option clipped...
<select
        name="{{ $field['name'] }}"
        @include('crud::inc.field_attributes', ['default_class' =>  'form-control select2'])
        >

            @if ($entity_model::isColumnNullable($field['name']))
                <option value="">-</option>
            @endif

            @if (isset($field['model']) && isset($field['group_entity']))
                @foreach ($field['model']::with($field['group_entity'])->get() as $connected_entity_entry)
                    <optgroup label="{{ $connected_entity_entry->{$field['group_label_attribute']} }}">
                        @foreach ($connected_entity_entry->{$field['group_entity']} as $subconnected_entity_entry)
                            <option value="{{ $subconnected_entity_entry->getKey() }}"
                                @if ( ( old($field['name']) && old($field['name']) == $subconnected_entity_entry->getKey() ) || (isset($field['value']) && $subconnected_entity_entry->getKey()==$field['value']))
                                     selected
                                @endif
                            >{{ $subconnected_entity_entry->{$field['attribute']} }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            @endif
    </select>



    // *****************************SETUP******************************
    {{-- $this->crud->addField([
                     'name'  => 'subcategory_id',
                     'label' => "Subcategory",
             'type'  => 'select2_grouped',
                     'entity' => 'subcategory', // Child model entity related to active model (belongsTo) (as per normal use)
                     'attribute' => 'title', // Attribute on child model to use as option label
             'model' => 'App\Models\Category',  // Parent model
                     'group_label_attribute' => 'title',     // Attribute from parent model to use as optgroup label
                     'group_entity' => 'subcategories' // Child entity from perspective of parent model used as the list <options> (hasMany)
                 ]); --}}
