<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

  updateProject (e($_POST['id']), $dbh, e($_POST['title']), e($_POST['url']), e($_POST['content']), e($_POST['link']));
  redirect('index.php');

}

$editProject = editProject($_GET['id'], $dbh);

require 'partials/header.php';
require 'partials/navigation.php';
?>


<!-- Start of Content -->
<div class="container">

  <div class="row">
    <div class="col-md-12">
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="edit.php">
            <input id="id" type="hidden" name="id" value="<?= $editProject['id'] ?>">



            <!-- Form Title -->
            <div class="form-group">
              <label class="col-md-4">
                Edit project
              </label>
            </div>

            <!-- Title Input -->
            <div class="form-group">
              <label for="projectName" class="col-md-4 control-label">Title</label>

              <div class="col-md-6">
                <input id="title" type="text" class="form-control" name="title" value="<?= $editProject['title'] ?>" required="" autofocus="">
              </div>
            </div>

            <!-- Image Url Input -->
            <div class="form-group">
              <label for="projectImgUrl" class="col-md-4 control-label">Image Url</label>

              <div class="col-md-6">
                <input id="image_url" type="text" class="form-control" name="url" value="<?= $editProject['url'] ?>" required="" autofocus="" onchange="readURL(this)">
              </div>
            </div>

            <!-- Content Input -->
            <div class="form-group">
              <label for="projectContent" class="col-md-4 control-label">Content</label>

              <div class="col-md-6">
                <input id="content" type="text" class="form-control" name="content" value="<?= $editProject['content'] ?>" required="" autofocus="">
              </div>
            </div>

            <!-- Link Input -->
            <div class="form-group">
              <label for="projectLink" class="col-md-4 control-label">Link</label>

              <div class="col-md-6">
                <input id="link" type="text" class="form-control" name="link" value="<?= $editProject['link'] ?>" required="" autofocus="">
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Update
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <!-- Image Display Thumbnail -->
      <div class="form-group">
        <img style="display: block;" width="100%" height="100%" id="projectThumbnail" src="https://d13yacurqjgara.cloudfront.net/users/608072/screenshots/3360041/landingpage3.png" class="img-responsive">
      </div>
    </div>
  </div>
</div>
<!-- End of Content -->

<?php
require 'partials/footer.php';
?>