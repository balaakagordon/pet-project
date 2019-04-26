<?php

// if(!isset($_SESSION))
// {
//     session_start();
// }

use \App\Controllers\CountryController;


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if(! isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $country = $_GET['country'];

    }
    $data = (new CountryController)->getStates($code);
    $message = $data['message'];
    $states = $data['data'][0][$page];
    $num_of_pages = $data['data'][1];
}

require "header.php";
?>

<body>
    <div class='body-container'>
        <?php
            echo "<h1>States in $country</h1>";
        ?>
        <p class="message"><span><i><?php echo $message ?></i></span></p>
        <table id='data-table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Area (km<sup>2</sup>)</th>
                    <th>Largest City</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($states)) {
                        foreach($states as $state) {
                            echo "<tr>
                                    <td>$state->name ($state->abbr)</td>
                                    <td>$state->capital</td>
                                    <td>$state->area</td>
                                    <td>$state->largest_city</td>
                                </tr>";
                        }
                    }
                ?>
        </table>
        <div class='page-nav'>
            <?php
                if ($num_of_pages > 1) {
                    for ($page=1;$page<=$num_of_pages;$page++) {
                        echo "<div class='page-nav-buttons'>
                                <a href='countryView?country=India&code=IND&page=" . $page . "'>" . $page . "</a>
                            </div>";
                    }
                }
            ?>
        </div>
    </div>
</body>
