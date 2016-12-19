<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_fields.php");
require_once("../include/top.php");

$content = "";
$loginID = $_GET['loginID'];
$groupID = $_GET['userID'];
$post_to_name = "";

if(isset($_POST) && count($_POST) > 0) {

	if(isset($_GET['postID']) && $_GET['postID'] != '') {
		//existing post
		
		try {
			//update
			$postID = $_GET['postID'];
			$content = $_POST['content'];
			$pageID = $_POST['pageID'];
			
			$connection = get_connection();
			$connection->beginTransaction();

			$text = "UPDATE post 
						SET Content = ?, `Date` = CURDATE()
						WHERE PostID = ?";

			$bind = [$content, $postID];

			update($text, $bind, $connection);
			$connection->commit();

			header("Location: group-page.php?GroupID=" . $groupID . "&loginID=" . $loginID);

		} catch(Exception $e) {
			$e->getMessage();
			$connection->rollBack();
		}
		
	} else {
		//new post
		try {
			$connection = get_connection();
			$connection->beginTransaction();

			$content = $_POST['content'];
			$pageID = $_POST['pageID'];

			$text = "INSERT (`Date`, Content, `Comment Count`, PostedBy, `Post Page`)
						VALUES(CURDATE(), ?, 0, ?, ?)";

			$bind = [$content, $loginID, $pageID];

			insert($text, $bind, $connection);

			header("Location: group-page.php?GroupID=" . $groupID . "&loginID=" . $loginID);

			$connection->commit();
		} catch (Exception $e) {
			$e->getMessage();
			$connection->rollBack();
		}
	}

} elseif(isset($_GET['postID']) && $_GET['postID'] != '') {
	try {
		$connection = get_connection();
		$connection->beginTransaction();

		$text = "SELECT Content, FirstName, LastName
					FROM post
					LEFT JOIN users on PostedBy = UserID
					WHERE postID = ?";

		$bind = [$_GET['postID']];

		$result = select($text, $bind, $connection)[0];

		$content = $result['Content'];
		$post_to_name = $result['FirstName'] . ' ' . $result['LastName'];


	} catch(Exception $e) {
		$e->getMessage();
	}
}

?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="../group/index.html">Not Facebook</a>
            </div>
            <ul class="nav navbar-right top-nav">
                <li style="margin-right: 20px">
                    <a href="../message/messages.html"><i class="fa fa-envelope"></i></a>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens  -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../group/index.html"><i class="fa fa-fw fa-dashboard"></i> Groups</a>
                    </li>
                    <li class="active">
                        <a href="../friend/friends.html"><i class="fa fa-fw fa-table"></i> Friends</a>
                    </li>
                    <li>
                        <a href="../employee/employees.html"><i class="fa fa-fw fa-file"></i> Employees</a>
                    </li>
                    <li>
                        <a href="../sales/sales-report.html"><i class="fa fa-fw fa-bar-chart-o"></i> Sales Report</a>
                    </li>
                    <li>
                        <a href="../revenue/revenues.html"><i class="fa fa-fw fa-line-chart"></i> Revenues</a>
                    </li>
                    <li>
                        <a href="../item/items.html"><i class="fa fa-fw fa-magic"></i> Items</a>
                    </li>
                    <li>
                        <a href="../transaction/transactions.html"><i class="fa fa-fw fa-pencil-square-o"></i> Transactions</a>
                    </li>
                    <li>
                        <a href="../customer/customers.html"><i class="fa fa-fw fa-user"></i> Customers</a>
                    </li>
                    <li>
                        <a href="../advertisement/advertisements.html"><i class="fa fa-fw fa-pie-chart"></i> Advertisements</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-10">
                        <h1 class="page-header">
                            <?php echo $post_to_name; ?>
                            <a href="friends.html" style="font-size: 14pt; float: right;"><button>See All Friends</button></a>
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                    <a href="personal-page.html"><button>Back To the Page</button></a>
                    </div>
                </div>
                
                </br>
                <form action="make-post.php" method="post"> 
                    <div class="form-group row"> <!-- Group Post Content -->
                        <label for="group-post-content" class="col-xs-3 col-form-label" style="font-size: 14pt; text-align: right;">Content</label>
                        <div class="col-xs-6">
                        <textarea type="textarea" name="content" class="form-control" id="group-post-content" rows="5"style="font-size: 14pt;"><?php echo $content; ?></textarea>
                        </div>
                    </div>
                    <? 
                    	echo input_hidden('userID', $userID);
                    	echo input_hidden('pageID', $pageID);

                     ?>
                    <div class="form-group row"> <!-- Post Button -->
                        <div class="col-lg-9" >
                            <button type="submit" class="btn btn-primary" style="float: right; font-size: 14pt">Post</button>
                        </div>
                    </div>
                </form>

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
