<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pinocchio</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap-sortable.css" />

    <!-- JS/PHP includes -->
    <script src="jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="bootstrap-sortable.js"></script>
    <script src="search.js"></script>
    <script src="validation.js"></script>

</head>
<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand">Pinocchio</a>
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse navHeaderCollapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="userAdmin.php">User Admin</a></li>
                    <li class="active"><a href="roundAdmin.php">Round Admin</a></li>
                    <li><a href="teamAdmin.html">Team Admin</a></li>
                    <li><a href="questionAdmin.html">Question Admin</a></li>
                    <li><a href="questionnaireAdmin.html">Questionnaire Admin</a></li>
                    <li><a href="fileManager.html">File Manager</a></li>
                    <li><a href="serverManager.html">Server Manager</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Create Round <b class="caret"></b>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <!-- TODO Validation of input -->
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="post" action="#">
                            <div class="form-group">
                                <!-- Questionnaire Select -->
                                <label for="questionnaireID" class="col-sm-2 control-label">Questionnaire ID:</label>
                                <div class="col-sm-3">
                                    <?php
                                        include 'genericSQLStatements.php';

                                        $con = mysqli_connect("localhost","root","","peerreview");
                                        // Check connection
                                        if (mysqli_connect_errno())
                                        {
                                            echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                                        }

                                        $query = "SELECT questionnaireID FROM rounddetail";
                                        $result = mysqli_prepared_query($con, $query);

                                        $out = "<select class='form-control' id='questionnaireID'>";
                                        foreach($result as $id)
                                        {
                                           // $out += "<option>" + $id + "</option>";
                                        }
                                        $out += "</select>";

                                        echo $out;
                                        mysqli_close($con);
                                    ?>
                                    
                                    <!-- <select class="form-control"></select> -->
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="roundID" class="col-sm-2 control-label">Round ID:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="roundID" placeholder="Round ID">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="roundStartingDate" class="col-sm-2 control-label">Round Starting Date:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="roundStartingDate" placeholder="Round Starting Date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="roundEndingDate" class="col-sm-2 control-label">Round Ending Date:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="roundEndingDate" placeholder="Round Ending Date">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="roundDescription" class="col-sm-2 control-label">Round Description:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="roundDescription" placeholder="Round Description">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info" id="submitRound" onclick="roundSubit()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Maintain Round <b class="caret"></b>
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <a class="btn btn-info">Export to CSV</a>
                        <div class="panel-body">
                            
                            <input type="type" class="form-control" id="search" placeholder="Search" onkeyup="showResult(this.value)" />

                            <?php
                                //include 'genericSQLStatements.php';

                                $con = mysqli_connect("localhost","root","","peerreview");
                                // Check connection
                                if (mysqli_connect_errno())
                                {
                                    echo "Failed to connect to MySQL: " . mysqli_connect_errno();
                                }

                                $result = selectFromTable("rounddetail",array(1=>1));
                                echo " <div class='table-responsive'>
                                <table class='table sortable'>
                                    <thead>
                                        <tr>
                                            <th>Round ID</th>
                                            <th>Questionnaire ID</th>
                                            <th>Starting Date</th>
                                            <th>Ending Date</th>
                                            <th>Round Description</th>
                                            <th data-defaultsort='disabled'>Change Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                $list = array();
                                foreach($result as $row)
                                {
                                    $list[] = $row;
                                }
                                
                                $count = 0;
                                $out  = "";
                                foreach($list as $key => $element)
                                {
                                    $row = array();
                                    $out .= "<tr>";
                                    foreach($element as $subkey => $subelement)
                                    {
                                        $out .= "<td contenteditable=true>$subelement</td>";
                                        $row[$subkey] = $subelement;
                                    }
                                    $stringRow = serialize($row);
                                    $out.= "<td><button type='button' class='btn btn-success btn-xs' id='accept' onclick='acceptEdit($stringRow)'>&#10004;</button></td>";
                                    $out.= "<td><button type='button' class='btn btn-warning btn-xs' id='delete' onclick='deleteRow($stringRow)'>&#10008;</button></td>";
                                    $out .= "</tr>";
                                    $count = $count + 1;
                                }
                                $out .= "</tbody>";
                                $out .= "</table>";

                                echo $out;                          
                                mysqli_close($con);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left">&copy; Dillon Heins</p>
            <a class="navbar-btn btn-danger btn pull-right">Log Out</a>
        </div>
    </div>

</body>
</html>