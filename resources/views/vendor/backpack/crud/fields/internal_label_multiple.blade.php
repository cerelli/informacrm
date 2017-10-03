{{-- relationships with pivot table (n-n) --}}
<!-- field_type_name -->

{{-- <div @include('crud::inc.field_wrapper_attributes') > --}}
    <?php
        $results = $field;

        if ($results && $results->count()) {
            // dump($results);
            foreach ($results as $value) {
                // dump($value);
                echo "<span style='font-size: 80%; margin-right: 3px; color: ".$value['color']."; background-color: ".$value['background_color']."' class='label label-default'><i class= 'fa ".$value['icon']."'></i> ".$value['description']."</span>";
            }
        } else {
            echo '-';
        }

    ?>
{{-- </div> --}}
