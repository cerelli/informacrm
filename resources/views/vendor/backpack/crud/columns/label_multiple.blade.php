{{-- relationships with pivot table (n-n) --}}
<td>
    <?php
        $results = $entry->{$column['entity']};
        if ($results && $results->count()) {
            // $results_array = array();
            // $results_array = $results->pluck($column['attribute']);

            foreach ($results as $key => $value) {
                // $results_array[] = $column['attribute'];
                echo "<span style='font-size: 80%; margin-right: 3px; color: ".$value['color']."; background-color: ".$value['background_color']."' class='label label-default'><i class= 'fa ".$value['icon']."'></i> ".$value[$column['attribute']]."</span>";

            }
        } else {
            echo '-';
        }
    ?>
</td>
