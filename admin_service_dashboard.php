<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="admin_service_dashboard.css">
</head>

<body>

    <?php
    include("data_class.php");

    $msg = "";

    if (!empty($_REQUEST['msg'])) {
        $msg = $_REQUEST['msg'];
    }

    // if ($msg == "done") {
    //     echo "<div class='alert alert-success' role='alert'>Sucssefully Done</div>";
    // } elseif ($msg == "fail") {
    //     echo "<div class='alert alert-danger' role='alert'>Fail</div>";
    // }

    ?>
    <!-- ***********************************************side bar************************************************
    ********************************************************************************************************* -->
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class="fas fa-book"></i>
                <div class="logo_name">Library M</div>
            </div>
        </div>
        <ul class="nav-list">

            <li>
                <Button><i class="fas fa-home"></i> Admin</Button>
            </li>
            <li>
                <Button class="links_name" onclick="openpart('addbook')"><i class="fas fa-plus-square"></i>Add Book</Button>
            </li>
            <li>
                <Button onclick="openpart('bookreport')"><i class="fas fa-book"></i> Book Report</Button>
            </li>
            <li>
                <Button onclick="openpart('bookrequestapprove')"> <i class="fas fa-heart"></i>Book Requests</Button>
            </li>
            <li>
                <Button onclick="openpart('addperson')"><i class="fas fa-plus-square"></i> Add Person</Button>
            </li>
            <li>
                <Button onclick="openpart('studentrecord')"><i class="fas fa-history"></i> Person Report</Button>
            </li>
            <li>
                <Button onclick="openpart('issuebook')"><i class="fas fa-cog"></i> Issue Book</Button>
            </li>
            <li>
                <Button onclick="openpart('issuebookreport')"><i class="fas fa-history"></i> Issued Books Report</Button>
            </li>

        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="images\sanjay.png" alt="">
                    <div class="name_job">
                        <div class="name">SANJAY MANDAL</div>
                        <div class="job">Admin</div>
                    </div>
                </div>

                <Button><a href="index.php"><i class="fas fa-sign-out-alt" id="Log_out"></i></a></Button>
            </div>
        </div>
    </div>
    <!-- *********************************************************************************************************
    ********************************************************************************************************* -->


    <div class="container">
        <div class="innerdiv">
            <!-- <div class="row"><img class="imglogo" src="images/top.jpg" /></div> -->
            
            <div class="rightinnerdiv">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Approve Book Requests </Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->requestbookdata();
                    $recordset = $u->requestbookdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 0px solid #ddd;
            padding: 8px;'>Person Name</th><th>person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        "<td>$row[1]</td>";
                        "<td>$row[2]</td>";

                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[4]</td>";
                        $table .= "<td>$row[5]</td>";
                        $table .= "<td>$row[6]</td>";
                        // $table.="<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approved BOOK</button></a></td>";
                        $table .= "<td><a href='approvebookrequest.php?reqid=$row[0]&book=$row[5]&userselect=$row[3]&days=$row[6]'><button type='button' class='btn btn-primary'>Approve</button></a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                        echo "display:none";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">
                    <Button class="greenbtn">Add New Book</Button>
                    <div class="anb">
                        <form action="addbookserver_page.php" method="post" enctype="multipart/form-data">

                            <label>Book Name:</label><input class="intpt" type="text" name="bookname" />
                            </br><br>
                            <label>Detail:</label><input class="intpt" type="text" name="bookdetail" /></br><br>
                            <label>Autor:</label><input class="intpt" type="text" name="bookaudor" /></br><br>
                            <label>Publication</label><input class="intpt" type="text" name="bookpub" /></br>
                            <div>Branch:<input type="radio" name="branch" value="other" />other<input type="radio" name="branch" value="BSIT" />BSIT<div style="margin-left:80px"><input type="radio" name="branch" value="BSCS" />BSCS<input type="radio" name="branch" value="BSSE" />BSSE</div>
                            </div>
                            <label>Price:</label><input class="intpt" type="number" name="bookprice" /></br><br>
                            <label>Quantity:</label><input class="intpt" type="number" name="bookquantity" /></br><br>
                            <label>Book Photo</label><input class="intpt bp" type="file" name="bookphoto" /></br>
                            </br>

                            <input class="submit" type="submit" value="SUBMIT" />
                            </br>
                            </br>

                        </form>
                    </div>
                </div>
            </div>


            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Add Person</Button>
                    <div class="ap">
                        <form action="addpersonserver_page.php" method="post" enctype="multipart/form-data">
                            <label>Name:</label><input class="intpt" type="text" name="addname" />
                            </br><br>
                            <label>Pasword:</label><input class="intpt" type="pasword" name="addpass" />
                            </br><br>
                            <label>Email:</label><input class="intpt" type="email" name="addemail" /></br><br>
                            <label for="typw">Choose Type:</label>
                            <select class="intpt" name="type">
                                <option value="Student">Student</option>
                                <option value="Teacher">Teacher</option>
                            </select>
                            <br><br>
                            <input class="submit" type="submit" value="SUBMIT" />
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Person Record</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->userdata();
                    $recordset = $u->userdata();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 0px solid #ddd;
            padding: 8px;'> Name</th><th>Email</th><th>Type</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[1]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[4]</td>";
                        // $table.="<td><a href='deleteuser.php?useriddelete=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Issued Books Record</Button>

                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->issuereport();
                    $recordset = $u->issuereport();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 0px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th></tr>";

                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[3]</td>";
                        $table .= "<td>$row[6]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[4]</td>";
                        // $table.="<td><a href='otheruser_dashboard.php?returnid=$row[0]&userlogid=$userloginid'>Return</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>

            <!--             

issue book -->
            <div class="rightinnerdiv">
                <div id="issuebook" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Issue Books</Button>
                    <div class="ib">
                        <form action="issuebook_server.php" method="post" enctype="multipart/form-data">
                            <label for="book">Choose Book:</label>
                            <select class="intpt" name="book">
                                <?php
                                $u = new data;
                                $u->setconnection();
                                $u->getbookissue();
                                $recordset = $u->getbookissue();
                                foreach ($recordset as $row) {

                                    echo "<option  value='" . $row[2] . "'>" . $row[2] . "</option>";
                                }
                                ?>
                            </select>
                            <br><br>
                            <label for="">Name</label>
                            <label for="Select Student">:</label>
                            <select class="intpt" name="userselect">
                                <?php
                                $u = new data;
                                $u->setconnection();
                                $u->userdata();
                                $recordset = $u->userdata();
                                foreach ($recordset as $row) {
                                    $id = $row[0];
                                    echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                                }
                                ?>
                            </select>
                            <br><br>
                            Days<input class="intpt" type="number" name="days" />
                            <br><br>
                            <input class="submit" type="submit" value="SUBMIT" />
                            <br><br>
                        </form>
                    </div>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookdetail" class="innerright portion" style="<?php if (!empty($_REQUEST['viewid'])) {
                                                                            $viewid = $_REQUEST['viewid'];
                                                                        } else {
                                                                            echo "display:none";
                                                                        } ?>">

                    <Button class="greenbtn">Book Details</Button>
                    </br>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbookdetail($viewid);
                    $recordset = $u->getbookdetail($viewid);
                    foreach ($recordset as $row) {

                        $bookid = $row[0];
                        $bookimg = $row[1];
                        $bookname = $row[2];
                        $bookdetail = $row[3];
                        $bookauthour = $row[4];
                        $bookpub = $row[5];
                        $branch = $row[6];
                        $bookprice = $row[7];
                        $bookquantity = $row[8];
                        $bookava = $row[9];
                        $bookrent = $row[10];
                    }
                    ?>

                    <img class="bkd-img" src="uploads/<?php echo $bookimg ?> " />
                    <!-- </br> -->
                    <div class="bd">
                        <p class="bkd"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                        <p class="bkd line"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                        <p class="bkd"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthour ?></p>
                        <p class="bkd"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                        <p class="bkd"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                        <p class="bkd"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                        <p class="bkd"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                        <p class="bkd"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>
                    </div>

                </div>
            </div>



            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion">
                    <Button class="greenbtn">Book Record</Button>
                    <?php
                    $u = new data;
                    $u->setconnection();
                    $u->getbook();
                    $recordset = $u->getbook();

                    $table = "<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 0px solid #ddd;
            padding: 8px;'>Book Name</th><th>Price</th><th>Qnt</th><th>Available</th><th>Rent</th></th><th>View</th></tr>";
                    foreach ($recordset as $row) {
                        $table .= "<tr>";
                        "<td>$row[0]</td>";
                        $table .= "<td>$row[2]</td>";
                        $table .= "<td>$row[7]</td>";
                        $table .= "<td>$row[8]</td>";
                        $table .= "<td>$row[9]</td>";
                        $table .= "<td>$row[10]</td>";
                        $table .= "<td><a href='admin_service_dashboard.php?viewid=$row[0]'><button type='button' class='btn btn-primary'>View BOOK</button></a></td>";
                        // $table.="<td><a href='deletebook_dashboard.php?deletebookid=$row[0]'>Delete</a></td>";
                        $table .= "</tr>";
                        // $table.=$row[0];
                    }
                    $table .= "</table>";

                    echo $table;
                    ?>

                </div>
            </div>



        </div>
    </div>

    <script src="admin_service_dashboard.js"></script>
    <script src="https://kit.fontawesome.com/d35fbd3f4e.js" crossorigin="anonymous"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>