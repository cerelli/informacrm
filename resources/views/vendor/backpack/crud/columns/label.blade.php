{{-- relationships with pivot table (n-n) --}}
<td>
    <?php
        $results = $entry->{$column['entity']};
        if ($results && $results->count()) {
            // $results_array = array();
            // $results_array = $results->pluck($column['attribute']);
            // dump($results['description']);
            // foreach ($results as $key => $value) {
                // $results_array[] = $column['attribute'];
                echo "<span style='font-size: 80%; margin-right: 3px; color: ".$results['color']."; background-color: ".$results['background_color']."' class='label label-default'><i class= 'fa ".$results['icon']."'></i> ".$results[$column['attribute']]."</span>";

            // }
        } else {
            echo '-';
        }
    ?>
</td>
