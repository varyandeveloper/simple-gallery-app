<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=\VS\Gallery\App::url('/')?>">Gallery app</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="<?=\VS\Gallery\App::url('gallery')?>">Galleries</a></li>
            <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'editor'): ?>
                <li><a href="<?=\VS\Gallery\App::url('gallery/create')?>">Add gallery</a></li>
            <?php endif; ?>
            <?php if(isset($_SESSION['is_logged_in'])): ?>
                <li><a href="<?=\VS\Gallery\App::url('auth/logout')?>">Logout</a></li>
            <?php else: ?>
                <li><a href="<?=\VS\Gallery\App::url('auth/login')?>">Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="container">
    <?php if(!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?=isset($_SESSION['status']) ? $_SESSION['status'] : 'success'?>">
        <?php echo $_SESSION['message']; unset($_SESSION['message'])?>
    </div>
    <?php endif; ?>