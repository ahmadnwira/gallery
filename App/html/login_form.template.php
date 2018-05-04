<?php session_start(); ?>
<?php require 'partials/header.php'; ?>
<!-- Add CSRF_TOKEN -->
    <div class="container">
        <form action="" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label for="name">User Name: </label>
                <input type="text" name="name" id="caption" class="form-control" placeholder="what a great day">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="pass" id="password" class="form-control" placeholder="password">
            </div>


            <div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="/signup" class="btn btn-default">SignUp</a>
            </div>
        </form>

        <?php if(isset($_SESSION['msg'])): ?>
            <br/>
            <div class="alert alert-warning" role="alert">
                <?= $_SESSION['msg']; ?>
            </div>
        <?php  unset($_SESSION['msg']); endif ?>
    </div>
<?php require 'partials/footer.php'; ?>