<?php session_start(); require 'partials/header.php'; ?>
    <!-- Add CSRF_TOKEN -->
    <form class="container" action="" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label for="name">User Name: </label>
            <input type="text" name="name" id="caption" class="form-control" placeholder="what a great day">
        </div>

        <div class="form-group">
            <label for="password">Password: </label>
            <input type="password" name="pass" id="password" class="form-control" placeholder="password">
        </div>

        <div class="form-group">
            <label for="passwordConfirm">Confirm Password: </label>
            <input type="password" name="confirm" id="passwordConfirm" class="form-control" placeholder="confirm password">
        </div>


        <div>
            <button type="submit" class="btn btn-primary">SignUp</button>
            <a href="/login" class="btn btn-default">LogIn</a>
        </div>
        
        <?php if(isset($_SESSION['msg'])): ?>
            <br/>
            <div class="alert alert-warning" role="alert">
                <?= $_SESSION['msg']; ?>
            </div>
        <?php  unset($_SESSION['msg']); endif ?>
    </form>

<?php   require 'partials/footer.php'; ?>