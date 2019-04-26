<?php

if(!isset($_SESSION))
{
    session_start();
}

$status = session_status();
use \App\Helpers\UserService;

if(!isset($_SESSION['token'])) {
    $headerLinks = "<div class='nav-header'>
                        <div class='header-button auth-text'> auth text</div>
                    </div>";
} else {
    // $currentUser = $_SESSION['user'];                    // remove when jwt is fixed
    if(! $_SESSION['token'] == '') {
        $tokenData = (new UserService)->getTokenData($_SESSION['token']);
        $currentUser = $tokenData[1]['uid'];
        $headerLinks = "<div class='nav-header'>
                            <li><a href='home'><div class='header-button'>Home</div></a></li>
                            <li><a href='userView?id=$currentUser'><div class='header-button'>My Profile</div></a></li>
                            <li><a href='users'><div class='header-button'>Users</div></a></li>
                            <li><a href='logout'><div class='header-button logout'>Logout</div></a></li>
                        </div>";
    } else {
        header('Location: logout');
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pure PHP Pet-Project</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <header>
        <nav>
            <div>
                <ul>
                    <?php echo $headerLinks; ?>
                </ul>
            </div>
        </nav>
    </header>
