<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mars game</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL_ASSETS ?>/assets/css/style.css"
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .notification {
        background-color: #555;
        color: white;
        text-decoration: none;
        padding: 15px 26px;
        position: relative;
        display: inline-block;
        border-radius: 2px;
    }

    .notification:hover {
        background: red;
    }
    .notification.badge{
        position: absolute;
        top: -10px;
        right: -10px;
        padding: 5px 10px;
        border-radius: 50%;
        background-color: red;
        color: white;

</style>



<body>
<div class="container">
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Mars Game</a>
                </div>
                <ul class="nav navbar-nav">
                    <?php if (!$this->isLogedIn()): ?>
                        <li><a href="<?php echo BASE_URL ?>/user/registration">Register</a></li>
                        <li><a href="<?php echo BASE_URL ?>/user/login">Login</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo BASE_URL ?>/map">Map</a></li>
                        <li><a href="<?php echo BASE_URL ?>/city/index">City</a></li>
                        <li><a href="<?php echo BASE_URL ?>/user/edit">My account</a></li>
                        <li><a href="<?php echo BASE_URL ?>/user/logout">Logout</a></li>
                        <li><a href="<?php echo BASE_URL ?>/controllerduk/index">DUK</a></li>
                        <li><a href="<?php echo BASE_URL ?>/user/stats">Players list</a></li>
                        <li><a class="notification" href="<?php echo BASE_URL ?>/messages/inbox">
                                <span>Messages</span>
                                <span class="badge">
                                    <?php
                                    $messageCount = new \Model\Messages();
                                    $user = new \Session\User();

                                    $counts = $messageCount->newNotification($user->getAuthUserId());
                                    if (!empty($counts)){
                                        echo $counts[0]['COUNT(1)'];
                                    }else echo '0';
                                    ?>
                                </span>
                            </a>

                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </nav>
    </header>
    <?php if (isset($data['error']) && $data['error']): ?>
    <div class="alert alert-danger">
        <?php echo $data['error']; ?>
    </div>
    <?php endif; ?>
    <?php if (isset($data['success']) && $data['success']): ?>
        <div class="alert alert-success">
            <?php echo $data['success']; ?>
        </div>
    <?php endif; ?>
</div>
<?php if($data['resources']): ?>
    <div class="resource-wrapper">
        <?php foreach ($data['resources'] as $name => $value ): ?>
            <div class="resourse-<?php echo $name ?>">
                <?php echo $name .': '. $value; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;?>
