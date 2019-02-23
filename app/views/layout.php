<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?= $pageTitle ?? '' ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Posts List</a>
                </li>
                <?php if ($isAuthorized): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/post">Create Post</a>
                    </li>
                <?php endif ?>
            </ul>
            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                <?php if ($isAuthorized): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Register</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<section class="mt-5" style="background-color: white">
    <div class="container">
        <?= $content ?>
    </div>
</section>

</body>
</html>
