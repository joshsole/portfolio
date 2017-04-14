<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && loggedIn()) {

//define variables and set to empty values
  $content = $project_id = '';
    //add data to form


  $project_id = e($_POST['project_id']);
    // $url = e($_POST['url']);
    // $content = e($_POST['content']);
    // $link = e($_POST['link']);


  if ($_POST['_method'] == 'ADD') {


    $content = e($_POST['content']);

    addComment($dbh, $project_id, $content);
    addmessage('success', "You have successfully added a comment");
    redirect("view.php?id=" . $project_id);


  }

  if ($_POST["_method"] == "delete") {
    $id= $_POST['id'];
    deleteComment($dbh, $id);
    addmessage('success', "You have successfully deleted a comment");
    redirect("view.php?id=" . $project_id);
  }
}



// $didInsertWork = addProject($dbh, $content, $_SESSION['id']);



$viewProject = viewProject($_GET['id'], $dbh);
$comments = getComments($_GET['id'], $dbh);

$page['title'] = 'View';

require 'partials/header.php';
require 'partials/navigation.php';
?>


<div class="container">
  <div class="row">
    <div class="col-md-12"><?= showMessages() ?>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">
          <img src="<?= $viewProject['url'] ?>" class="img-responsive" alt="">
        </div>
        <div class="panel-body">
          <h4><?= $viewProject['title'] ?></h4>
          <p><?= $viewProject['content'] ?></p>

          <div class="pull-right">
            <a href="<?= $viewProject['link']?>" target="_blank"><?= $viewProject['link']?> </a>
          </div>
        </div>
      </div>
    </div>
    <!-- Start of Card -->
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5>More projects</h5>
        </div>
        <div class="panel-body">

        </div>
      </div>
    </div>
    <!-- End of Card -->

  </div>
  <div class="row">

    <div class="col-md-8">
      <!-- Fluid width widget -->
      <div id="comments" class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            Recent Comments
          </h3>
        </div>

        <div class="panel-body">
          <?php if(loggedIn()): ?>
            <ul class="media-list">
              <li class="media">
                <div class="media-left">
                  <img class="comments-profile-photo" src="<?= get_gravatar($_SESSION['email']) ?>">
                </div>


                <div class="media-body">
                  <div class="form-group" style="padding:12px;">
                    <form method="POST" action="view.php">

                      <input name="_method" type="hidden" value="ADD">
                      <input name="project_id" value="<?= $viewProject['id'] ?>" type="hidden" >

                      <textarea name="content" class="form-control animated" placeholder="Leave a comment"></textarea>

                      <button class="btn btn-info pull-right" style="margin-top:10px" type="submit">
                        Post
                      </button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
            <hr>
          <?php endif; ?>


          <?php 
          if(!empty($comments)):
            foreach ($comments as $comment):
              ?>

            <ul class="media-list">
              <li class="media">
                <div class="media-left">
                  <img src="<?= get_gravatar($comment['email']) ?>" class="comments-profile-photo">
                </div>
                <div class="media-body">
                  <h4 class="media-heading"> <?= $comment['username'] ?>                   <br>
                    <div class="pull-right">
                      <small><?= formatTime(strtotime($comment['created_at'])) ?>
                      </small>

                      &nbsp;


                      <!-- <input name="_method" type="hidden" value="DELETE">
                      <input name="id" type="hidden" value="">
                      <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-default btn-xs btn-danger">
                        <i class="icon ion-ios-close-outline"></i>
                      </button> -->
                      <!-- Delete Button and Form -->
                      <?php if(userOwns($comment['user_id'])): ?>
                        <form method="POST" action="view.php" style="display: inline-block;">

                          <input name="_method" type="hidden" value="delete">

                          <input name="id" type="hidden" value="<?= $comment['id']?>">
                          <input name="project_id" value="<?= $viewProject['id'] ?>" type="hidden" >
                          <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-default btn-xs btn-danger">
                            <i class="icon ion-ios-close-outline"></i>
                          </button>

                        </form>
                      <?php endif; ?>

                    </div>
                  </h4>
                  <p>
                    <?= $comment['content'] ?>
                  </p>
                </div>
              </li>
            </ul>
            <?php 
            endforeach;
            else:  ?>

            <ul class="media-list">
              <li class="media">
                <div class="media-body">
                  <p>
                    No Comments
                  </p>
                </div>
              </li>
            </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>
<?php
require 'partials/footer.php';
?>
