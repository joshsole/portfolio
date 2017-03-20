<?php

require 'partials/header.php';
require 'partials/navigation.php';
require 'includes/config.php';

?>
<div id="app">

    <!-- Start of Navigation -->

    <!-- End of Navigation -->

    <!-- Start of Content -->
    <div class="container">
        <div class="row">
            <!-- Your loop will start here and loop through the card markup -->

            <!-- Start of Card -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading card-header">
                        <img class="img-responsive" src="http://placehold.it/250x250/eee">
                    </div>

                    <div class="panel-body">
                        <h4>Card title</h4>
                        <p>
                            This is where your card content will be display, Could be a little information on your project
                        </p>
                        <a href="#" class="btn btn-default btn-xs">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <!-- End of Card -->


        </div>
    </div>
</div>
<!-- Scripts -->
<!-- Bootstrap JavaScript -->

<?php
require 'partials/footer.php';
?>

