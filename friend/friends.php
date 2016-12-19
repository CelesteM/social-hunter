<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook_items.php");
require_once("../include/top.php");

$loginID = $_GET['loginID'];


try {

	$connection = get_connection();
	$connection->beginTransaction();

	$text = "SELECT FirstName, LastName, UserID
				FROM users";

	$bind = [];

	$results = select($text, $bind, $connection);

} catch(Exception $e) {
	$e->getMessage();
}


?>

    <div id="wrapper">

        <?php echo navigation($loginID); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Name
                            
                        </h1>
                    </div>
                </div>
                </br>

                <?php

                	foreach($results as $result) {
                		$name = $result['FirstName'] . ' ' . $result['LastName'];
                		echo friend($name, $result['UserID'], $loginID);
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

<? include "../include/bottom.php"; ?>