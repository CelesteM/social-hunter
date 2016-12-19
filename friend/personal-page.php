<?php

require_once("../include/top.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");

$loginID = $_GET['loginID'];

if(isset($_GET['UserID']) && $_GET['UserID'] != '') {
	try {

		$connection = get_connection();
		$connection->beginTransaction();

		//Get name from database
		$text = "SELECT LastName, FirstName, PageID
				 FROM users
				 LEFT JOIN `personal page` on Owner = UserID
				 WHERE UserID = ?";

		$bind = [$_GET['UserID']];

		$result = select($text, $bind, $connection)[0];

		$name = $result['FirstName'] . ' ' . $result['LastName'];
		
		//Get Posts from database
		$text = "SELECT Content, PostID FROM post WHERE `Post Page` = ?";
		$bind = [$result['PageID']];

		$posts = select($text, $bind, $connection);

	} catch(Exception $e) {
		$e->getMessage();
	}
}
?>


    <div id="wrapper">

        <?php echo navigation($loginID); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-10">
                        <h1 class="page-header">
                            <?php echo $name; ?>
                        </h1>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <a href="friends.html" ><button>See All Friends</button></a>
                    </div>
                     <div class="col-lg-2">
                        <a href="../message/send-message.html"><button style="float: right";>Send Message</button></a>
                    </div>
                    <div class="col-lg-2"> 
                        <a href="make-post.html"><button style="float: right;">Make a Post</button></a>
                    </div>
                </div>
                </br>
                
                <?php 

                	foreach($posts as $post) {
                		$text = "SELECT Content FROM comment WHERE Post = ?";
						$bind = [$post['PostID']];

						$comments = select($text, $bind, $connection);

						echo post($post['Content']);

						foreach($comments as $comment) {
							echo comment($comment['Content']);
						}
                	}

                ?> 

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

<?php
require_once("../include/bottom.php");
?>