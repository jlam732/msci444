<?php
    session_start();
    include_once "../php/creds.php";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //get the ticket info
        $sql = "SELECT t.id, t.type, t.subject, t.description, t.status, t.priority, u.first_name, u.last_name, t.creationDate FROM ticket t LEFT JOIN user u "
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
        $assignees = [];
        if($_SESSION["type"] != 1) {
            $sql = "SELECT u.id, u.first_name, u.last_name FROM user u "
             . "WHERE u.type != 1 ORDER BY u.type asc, u.first_name asc";
            $result = $conn->query($sql);
            $activities = $result->fetchAll(PDO::FETCH_ASSOC);    
        }
        $conn->close();
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

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

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
                <a class="navbar-brand" href="mytickets.php">MSYDE IT Consulting Group</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
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
                        <div class="form-group">
                            <label>Ticket Subject</label>
                            <input name="subject" class="form-control" placeholder="Enter text">
                        </div>
                        <div class="form-group">    
                            <label>Ticket Type</label>
                            <select name="type" class="form-control">
                                <option>Domain Access Issue</option>
                                <option>Hardware Required</option>
                                <option>Request for Software</option>
                                <option>Server Support</option>
                                <option>Software Issue</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="desc" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select name="priority" class="form-control">
                                <option>1 - Critical</option>
                                <option>2 - High</option>
                                <option>3 - Medium</option>
                                <option selected="selected">4 - Low</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit Button</button>
                        <button type="reset" class="btn btn-default">Reset Button</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

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
    <script src="../js/createticket.js"></script>

</body>

</html>
