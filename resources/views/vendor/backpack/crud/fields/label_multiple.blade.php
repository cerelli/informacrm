{{-- relationships with pivot table (n-n) --}}
<!-- field_type_name -->

<div @include('crud::inc.field_wrapper_attributes') >
    <?php
        $results = $entry->{$field['entity']};
        if ($results && $results->count()) {
            foreach ($results as $key => $value) {
                echo "<span class='label label-default' style='color: ".$value['color']."; background-color: ".$value['background_color']."' ><i class= 'fa ".$value['icon']."'></i> ".$value[$field['attribute']]."</span> ";
                                // echo "<span class='label label-default' style='font-size: 80%; margin-right: 3px; margin-top: 3px; color: ".$value['color']."; background-color: ".$value['background_color']."' ><i class= 'fa ".$value['icon']."'></i> ".$value[$field['attribute']]."</span> ";
            }
        } else {
            echo '-';
        }
    ?>
</div>
