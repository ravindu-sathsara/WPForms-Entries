<?php

function data_management_plugin_dashboard_page() {
    
    global $wpdb; // WordPress database access abstraction class

    // Table name
    $table_name = $wpdb->prefix . 'wpforms_entries'; // Assuming the table name is wpforms_entries

    // Fetch data from the WPForms table
    $entries = $wpdb->get_results("SELECT * FROM $table_name");

    // Display the search input field
    echo '<div class="wrap">';
    echo '<h2>WPForms Entries</h2>';
    echo '<input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for ID">';
    echo '<input type="text" id="searchInput1" onkeyup="searchTable1()" placeholder="Search for Form ID">';
    echo '<input type="text" id="searchInput2" onkeyup="searchTable2()" placeholder="Search for Entry Details">';
    echo '<table class="wp-list-table widefat fixed striped" id="dataTable">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="width: 5%;">Entry ID</th>';
    echo '<th style="width: 5%;">Form ID</th>';
    echo '<th style="width: 5%;">Post ID</th>';
    echo '<th style="width: 5%;">User ID</th>';
    echo '<th style="width: 5%;">Viewed</th>';
    echo '<th style="width: 10%;">Date</th>';
    echo '<th>Entry Details</th>'; // Adjust column names as per your table structure
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($entries as $entry) {
        echo '<tr>';
        echo '<td>' . $entry->entry_id . '</td>'; // Assuming 'id', 'form_id', and 'entry_json' are column names
        echo '<td>' . $entry->form_id . '</td>';
        echo '<td>' . $entry->post_id . '</td>';
        echo '<td>' . $entry->user_id . '</td>';
        echo '<td>' . $entry->viewed . '</td>';
        echo '<td>' . $entry->date . '</td>';
        echo '<td>';

        // Decode JSON data and format for clarity
        $fields_data = json_decode($entry->fields, true);
        if ($fields_data) {
            $half_count = ceil(count($fields_data) / 2); // Split data into two equal parts
            $count = 0;
            foreach ($fields_data as $key => $value) {
                if ($count === $half_count) {
                    echo '</td><td>'; // Start new column after half of the data
                }
                // Check if the value is a URL
                if (filter_var($value['value'], FILTER_VALIDATE_URL)) {
                    // If it's a URL, create a hyperlink
                    echo '<a href="' . esc_url($value['value']) . '" target="_blank">' . $value['value'] . '</a><br>';
                } else {
                    echo '<strong> :</strong> ' . $value['value'] . '<br>';
                }
                $count++;
            }
        } else {
            echo 'Invalid JSON';
        }

        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    ?>
    <script>
        function searchTable() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Index 2 represents the third column containing entry details
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchTable1() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput1");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 2 represents the third column containing entry details
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function searchTable2() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput2");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2]; // Index 2 represents the third column containing entry details
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <?php
}
