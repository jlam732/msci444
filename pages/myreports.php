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

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../dist/css/jquery.fancybox.css" media="screen">
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
                <a class="navbar-brand" href="mytickets_manager.php">Company Name</a>
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
                    <li>
                        <a href="mytickets_manager.php"><i class="fa fa-ticket fa-fw"></i> My Tickets</a>
                    </li>
                    <li>
                        <a href="myreports.php"><i class="fa fa-bar-chart fa-fw"></i> My Reports</a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">My Reports</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>


            
            <!-- /.row -->
            <div class="row">
                <div class="alert alert-danger" style="display:none;"></div>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="technicianTable">
                        <thead>
                        </thead>            
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h2>Basic Reports</h2>
                    <div id="basicReports" class='list-group gallery'>
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" style="height:51px;" alt="" src="../dist/img/report_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/horbar_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/multibar_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 3</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/piechart_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 4</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/linegraph_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 5</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/full_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Report 6</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                    </div> <!-- list-group / end -->
                </div>
            </div> <!-- row / end -->
            <div class="row">
                <div class="col-lg-12">
                    <h2>Advanced Reports</h2>
                    <div id="advancedReports" class='list-group gallery' style="height:180px;">
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/tech_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 1</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/techs_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 2</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" height="67" alt="" src="../dist/img/checkmark_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 3</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/time_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 4</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/time_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 5</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class='col-sm-3 col-xs-6 col-md-2 col-lg-2'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="#">
                                <img class="img-responsive" alt="" src="../dist/img/time_icon.png" />
                                <div class='text-right'>
                                    <small class='text-muted'>Component 6</small>
                                </div> <!-- text-right / end -->
                            </a>
                        </div> <!-- col-6 / end -->
                        <div class="col-md-1 col-md-offset-11">
                            <button id="techrept" class="btn btn-default">Save</button>
                        </div>
                    </div> <!-- list-group / end -->
                </div>
            </div> <!-- row / end -->
            <div class="row">
                <div class="col-md-2 col-sm-offset-10" style="padding-left:30px;">
                    <button id="tickrept" class="btn btn-default">Generate Report</button>
                </div>
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
    <script src="../js/myreports.js"></script>
    <script src="../js/includetime.js"></script>
    <script src="../dist/js/jquery.fancybox.js"></script>
</body>

</html>
