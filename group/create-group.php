<?php

require_once("../include/connection.php");
require_once("../include/sql_wrapper.php");
require_once("../include/draw_not_facebook.php");
require_once("../include/top.php");


$loginID = $_GET['loginID'];

?>

    <div id="wrapper">

        <?php echo navigation($loginID); ?>
        <div id="page-wrapper">

            <div class="container-fluid" style="font-size: 13pt">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Create Group
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="\"<? echo "\"groups.php?loginID=" . $loginID . "\""; ?>\"><button>See All Groups</button></a>
                    </div>
                </div>
                </br>
                
                <form action="add-group" method="post"> 
                    <div class="form-group row"> <!-- Group Name -->
                        <label for="group-name" class="col-xs-4 col-form-label" style="font-size: 14pt; text-align: right;">Group Name</label>
                        <div class="col-xs-4">
                        <input type="text" name="Group Name" class="form-control" id="group-name" style="font-size: 14pt; height: 2.6vw">
                        </div>
                    </div>
                    <div class="form-group row"> <!-- Group Type -->
                        <label for="group-type" class="col-xs-4 col-form-label" style="font-size: 14pt; text-align: right;">Type</label>
                        <div class="col-xs-4">
                        <input type="text" name="type" class="form-control" id="group-type" style="font-size: 14pt; height: 2.6vw">
                        </div>
                    </div>
                    <div class="form-group row"> <!-- Create Button -->
                        <div class="col-lg-8" >
                            <button type="submit" class="btn btn-primary" style="float: right; font-size: 14pt">Create</button>
                        </div>
                    </div>

                    <? input_hidden("Owner", $loginID); ?>
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

<? include "../include/bottom.php"; ?>