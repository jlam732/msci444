<?php
    //get the current ticket being edited, all the activities for that ticket
    //also, if it's a technician or manager, get the list of technicians to populate a dropdown
    session_start();
    include_once "../php/creds.php";
    $ticket = [];
    $activities = [];
    $assignees = [];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //get the ticket info
        $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, t.technician, u.first_name, u.last_name, t.creationDate FROM ticket t LEFT JOIN user u "
             . "ON t.technician = u.id "
             . "WHERE t.id ='" . $_GET["id"] . "'";
        $result = $conn->query($sql);
        $ticket = $result->fetchAll(PDO::FETCH_ASSOC);
        //get all activity for related ticket
        $sql = "SELECT a.id, a.name, a.description, a.creationDate FROM activity a "
             . "WHERE a.ticket_id ='" . $_GET["id"] . "' ORDER BY a.creationDate asc";
        $result = $conn->query($sql);
        $activities = $result->fetchAll(PDO::FETCH_ASSOC);
        //if it's the technician, then we need to be able to assign the ticket to other technicians or manager
        //so we need that info
        if($_SESSION["type"] != 1) {
            $sql = "SELECT u.id, u.first_name, u.last_name FROM user u "
             . "WHERE u.type != 1 ORDER BY u.type asc, u.first_name asc";
            $result = $conn->query($sql);
            $assignees = $result->fetchAll(PDO::FETCH_ASSOC);    
        }
        //$conn->close();
    } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IT Ticketing System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom for the Comments Section -->
    <link href="../dist/css/comments.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="mytickets.php">Company Name</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li>
                    <div id='andro-clock'><div id='date'></div></div>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <!-- <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li> -->
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i>User Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php if($_SESSION["type"] == 1) { ?>
                        <li>
                            <a href="mytickets.php"><i class="fa fa-archive fa-fw"></i> My Tickets</a>
                        </li>
                        <li>
                            <a href="createticket.php"><i class="fa fa-ticket fa-fw"></i> Create Ticket</a>
                        </li>
                        <li>
                            <a href="faq_client.php"><i class="fa fa-question-circle fa-fw"></i> FAQ</a>
                        </li>
                        <?php } else if($_SESSION["type"] == 2) { ?>
                        <li>
                            <a href="mytickets_technician.php"><i class="fa fa-archive fa-fw"></i> My Tickets</a>
                        </li>
                        <li>
                            <a href="faq_technician.php"><i class="fa fa-question-circle fa-fw"></i> FAQ</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Ticket</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-danger" style="display:none;"></div>
                    <form role="form" id="createTicket">
                        <div class="form-group" style="display:none;">
                            <input name="id" class="form-control" value="<?php echo $ticket[0]["id"]; ?>">
                        </div>
                        <div class="form-group">
                            <label>Ticket Subject</label>
                            <input name="subject" class="form-control" value="<?php echo $ticket[0]["subject"]; ?>">
                        </div>
                        <div class="form-group">    
                            <label>Ticket Type</label>
                            <select name="type" class="form-control">
                				<?php if($_SESSION["type"] != 1) { ?>
                				<option <?php echo substr($ticket[0]["type"],0,1) == "D" ? "selected='selected'" : "" ?>>Domain Access Issue</option>
                                <option <?php echo substr($ticket[0]["type"],0,1) == "H" ? "selected='selected'" : "" ?>>Hardware Required</option>
                                <option <?php echo substr($ticket[0]["type"],0,1) == "R" ? "selected='selected'" : ""; ?>>Request for Software</option>
                                <option <?php echo substr($ticket[0]["type"],0,2) == "Se" ? "selected='selected'" : ""; ?>>Server Support</option>
                                <option <?php echo substr($ticket[0]["type"],0,2) == "So" ? "selected='selected'" : ""; ?>>Software Issue</option>

                				<?php } else { ?>
                				<option><?php echo $ticket[0]["type"]; ?></option>
                				<?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" class="form-control" rows="3"><?php echo $ticket[0]["description"]; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <?php if($_SESSION["type"] != 1) { ?>
                                <option <?php echo substr($ticket[0]["priority"],0,1) == "1" ? "selected='selected'" : "" ?>>1 - Critical</option>
                                <option <?php echo substr($ticket[0]["priority"],0,1) == "2" ? "selected='selected'" : "" ?>>2 - High</option>
                                <option <?php echo substr($ticket[0]["priority"],0,1) == "3" ? "selected='selected'" : ""; ?>>3 - Medium</option>
                                <option <?php echo substr($ticket[0]["priority"],0,1) == "4" ? "selected='selected'" : ""; ?>>4 - Low</option>
                                <?php } else { ?>
                                <option><?php echo $ticket[0]["priority"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <?php if($_SESSION["type"] != 1) { ?>
                                <option <?php echo substr($ticket[0]["status"],0,2) == "Op" ? "selected='selected'" : "" ?>>Open</option>
                                <option <?php echo substr($ticket[0]["status"],0,1) == "S" ? "selected='selected'" : "" ?>>Started</option>
                                <option <?php echo substr($ticket[0]["status"],0,2) == "On" ? "selected='selected'" : ""; ?>>On Hold</option>
                                <option <?php echo substr($ticket[0]["status"],0,1) == "C" ? "selected='selected'" : ""; ?>>Closed</option>
                                <?php } else { ?>
                                    <option><?php echo $ticket[0]["status"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Assigned Technician</label>
                            <select name="technician" class="form-control">
                                <?php if($_SESSION["type"] != 1) {
                                    foreach ($assignees as $index => $assignee) { ?>
					                   <option value="<?php echo $assignee['id'] ?>" <?php echo $ticket[0]["technician"] == $assignee["id"] ? "selected='selected'" : "" ?>> <?php echo $assignee["first_name"] . " " . $assignee["last_name"]; ?></option>
                                <?php } } else { ?>
                                    <option value="<?php echo $ticket[0]['technician']?>"><?php echo $ticket[0]["first_name"] . " " . $ticket[0]["last_name"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Comments</h3>
                        </div><!-- /col-sm-12 -->
                    </div><!-- /row -->
                    <?php foreach ($activities as $index => $activity) { ?>
                        <div class="row comment">
                            <div class="col-sm-1">
                                <div class="thumbnail">
                                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                </div><!-- /thumbnail -->
                            </div><!-- /col-sm-1 -->
                            <div class="col-sm-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong class="activity-name"><?php echo $activity["name"]; ?></strong> <span class="text-muted activity-time">commented <?php echo $activity["creationDate"]; ?></span>
                                    </div>
                                    <div class="panel-body activity-desc">
                                        <?php echo $activity["description"]; ?>
                                    </div><!-- /panel-body -->
                                </div><!-- /panel panel-default -->
                            </div><!-- /col-sm-5 -->
                        </div><!-- /row -->
                    <?php } ?>
                    <div class="col-sm-12">
                        <h4>Add a comment:</h4>
                    </div>
                    <div class="row test_comment">
                        <div class="col-sm-1">
                            <div class="thumbnail">
                                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                            </div><!-- /thumbnail -->
                        </div><!-- /col-sm-1 -->
                        <div class="col-sm-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong class="activity-name"><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></strong><span class="text-muted activity-time"></span>
                                </div>
                                <div class="panel-body activity-desc">
                                    <form role="form" id="addComment">
                                        <div class="form-group" style="display:none;">
                                            <input name="name" class="form-control" value="<?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>">
                                            <input name="ticket_id" class="form-control" value="<?php echo $ticket[0]['id']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-default">Add Comment</button>
                                    </form>
                                </div><!-- /panel-body -->
                            </div><!-- /panel panel-default -->
                        </div><!-- /col-sm-5 -->
                    </div><!-- /row -->
                </div><!-- /container -->
            </div>
        </div>
        <!-- /#page-wrapper -->
        <div class="footer">
            <footer>
                <hr>
                    <p style="text-align:right;">IT Telephone: *562  |   IT Email: <a href="mailto:it@company.com">helpdesk@company.com</a>&nbsp;&nbsp;&nbsp;&nbsp;</p>                  
            </footer>
        </div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src="../js/editticket.js"></script>
    <script src="../js/includetime.js"></script>
</body>
</html>
