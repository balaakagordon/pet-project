<?php

// if(!isset($_SESSION))
// {
//     session_start();
// }

include "header.php";

use \App\Controllers\CountryController;

$err = '';
$data = (new CountryController)->getCountries();

if(! isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$message = $data['message'];
$num_of_pages = $data['data'][1];
$countries = $data['data'][0][$page];

?>
    <body>
        <div class='body-container'>
            <h1>Countries</h1>
            <p class="message"><span><i><?php echo $message ?></i></span></p>
            <table id='data-table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Alpha2-code</th>
                        <th>Alpha3-code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($countries)) {
                            foreach($countries as $country) {
                                echo "<tr>
                                        <td>
                                            <a href='countryView?country=$country->name&code=$country->alpha3_code'>
                                                $country->name
                                            </a>
                                        <td>
                                            <a href='countryView?country=$country->name&code=$country->alpha3_code'>
                                                $country->alpha2_code
                                            </a>
                                        </td>
                                        <td>
                                            <a href='countryView?country=$country->name&code=$country->alpha3_code'>
                                                $country->alpha3_code
                                            </a>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<h2>No countries found</h2>";
                        }
                    ?>
            </table>
            <div class='page-nav'>
                <?php
                    if ($num_of_pages > 1) {
                        for ($page=1;$page<=$num_of_pages;$page++) {
                            echo "<div class='page-nav-buttons'>
                                    <a href='home?page=" . $page . "'>page " . $page . "</a>
                                </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </body>
