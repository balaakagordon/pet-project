<?php

// if(!isset($_SESSION))
// {
//     session_start();
// }

use \App\Controllers\UserController;

require "../app/Controllers/UserController.php";
require "header.php";

$id = $name = $email = $role = $responseMessage = '';
$is_active = false;

function getValues($user) {
    if (isset($user)) {
        $id = $user->id;
        $name = $user->first_name . ' ' . $user->last_name;
        $email = $user->email;
        $role = $user->role;
        $is_active = $user->is_active;
    }
    return [$id, $name, $email, $role, $is_active];
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $userData = (new UserController)->getUser($_GET['id']);
        $user = $userData['data'];
        [$id, $name, $email, $role, $is_active] = getValues($user);
        $responseMessage = $userData['message'];
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if ($_POST['user'] !== $_SESSION["user"]) {
    //     $responseMessage = 'You are not authorized to perform this action';
    // } else {
        if(!isset($_POST['user_active'])) {
            $response = (new UserController)->toggleActiveStatus(
                $_POST['user'],
                $action="deactivate",
                $_SESSION["token"]
            );
        } else {
            $response = (new UserController)->toggleActiveStatus(
                $_POST['user'],
                $action="activate",
                $_SESSION["token"]
            );
        }
        $user = $response['data'];
        $responseMessage = $response['message'];
        [$id, $name, $email, $role, $is_active] = getValues($user);
    // }
}

// $checkInput = $is_active ? '<input name="user_active" type="checkbox" checked>'
//         : '<input name="user_active" type="checkbox" unchecked>';

        if ($is_active) {
            $checkInput = '<input name="user_active" type="checkbox" checked>';
            $textPrompt = 'Deactivate Account';
        } else {
            $checkInput = '<input name="user_active" type="checkbox" unchecked>';
            $textPrompt = 'Activate Account';
        }
?>

    <body>
        <div class='body-container'>
            <h1>User View</h1>
            <p><span class="error"><?php echo $responseMessage ?></span></p>
            <table id='data-table'>
                <tr>
                    <th>ID: </th>
                    <td><?php echo $id ?></td>
                </tr>
                <tr>
                    <th>Name: </th>
                    <td><?php echo $name ?></td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <th>Role: </th>
                    <td><?php echo $role ?></td>
                </tr>
            </table>
            <form method="POST" action="/userView.php">
                <div class="status-slider">
                    <div class="slider-items"><?php echo $textPrompt ?></div>
                    <div class="slider-items">
                        <label class="switch">
                            <?php echo $checkInput ?>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div class="user-submit">
                    <input name="user" type="hidden" value="<?php echo $id ?>">
                    <button type="submit">Save Active Status</button>
                </div>
            </form>
        </div>
    </body>
</html>