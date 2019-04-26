<?php

// if(!isset($_SESSION))
// {
//     session_start();
// }

use App\Controllers\UserController;

require "../app/Controllers/UserController.php";

include "header.php";

$userData = (new UserController)->getAllUsers();
$users = $userData['data'];
$message = $userData['message'];

?>
    <body>
        <div class='body-container'>
            <h1>Users</h1>
            <p class="message"><span><i><?php echo $message ?></i></span></p>
            <table id='data-table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(!empty($users)) {
                            foreach($users as $user) {
                                $activated = $user->is_active ? 'Activated' : 'Deactivated';
                                echo "<tr>
                                        <td>
                                            <a href='userView?id=$user->id'>
                                                $user->first_name $user->last_name
                                            </a>
                                        </td>
                                        <td>
                                            <a href='userView?id=$user->id'>
                                                $user->email
                                            </a>
                                        </td>
                                        <td>
                                            <a href='userView?id=$user->id'>
                                                $activated
                                            </a>
                                        </td>
                                    </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>