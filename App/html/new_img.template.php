<?php require 'partials/header.php'; ?>

    <form class="container" action="" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label for="caption">Caption</label>
            <input type="text" name="caption" id="caption" class="form-control" placeholder="what a great day">
        </div>

          <div class="form-group">
            <label for="image">Your Image</label>
            <input type="file" class="form-control-file" id="image" name="img">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

<?php   require 'partials/footer.php'; ?>