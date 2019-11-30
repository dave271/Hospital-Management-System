<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "hospital");
if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "select * from logintb where username='$username' and password='$password' ";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel.php");
    } else {
        header("Location:error.php");
    }
}
if (isset($_POST['pat_submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $docapp = $_POST['docapp'];
    $payment = $_POST['payment'];
    $query = "insert into doctorapp(fname,lname,email,contact,docapp,payment)values('$fname','$lname',
    '$email','$contact','$docapp','$payment')";
    $result = mysqli_query($con, $query);
    if ($result) {
        echo "<script>alert('Appointment registered.')</script>";
        echo "<script>window.open('admin-panel.php','_self')</script>";
    }
}
if (isset($_POST['update_data'])) {
    $contact_data = $_POST['contact_data'];
    $status = $_POST['status'];
    $query = "update doctorapp set payment='$status' where contact='$contact_data';";
    $result = mysqli_query($con, $query);
    if ($result) {
        header("Location:updated.php");
    }
}
function display_docs()
{
    global $con;
    $query = 'select * from doctb';
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        echo '<option  value="' . $name . '">' . $name . '</option>';
    }
}
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];
    $query = "insert into doctb(name)values('$name');";
    $result = mysqli_query($con, $query);
    if ($result)
        header("Location:add-doc.php");
}
function display_admin_panel()
{
    echo '<!DOCTYPE html>
    <html land="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- font-awesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#3498DB;color:#ffffff">
            <a class="navbar-brand" href="#" style="color:#ffffff"><i class="fa fa-user-plus" aria-hidden="true"></i>Capital Hospital</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="
    #navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php" style="color:#ffffff"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="patient-search.php" method="post">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="enter phone number">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="patient-search-submit" type="submit" style="color:#ffffff">Search</button>
                </form>
            </div>
        </nav>
        <div class="jumbotron" id="backimg"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-appointment-list" data-toggle="list" href="#list-appointment" role="tab" aria-controls="appointment">Appointment</a>
                        <a class="list-group-item list-group-item-action" id="list-payment-status-list" data-toggle="list" href="#list-payment-status" role="tab" aria-controls="payment-status">Payment Status</a>
                        <a class="list-group-item list-group-item-action" id="list-prescription-list" data-toggle="list" href="#list-prescription" role="tab" aria-controls="prescription">Prescription</a>
                        <a class="list-group-item list-group-item-action" id="list-doctors-section-list" data-toggle="list" href="#list-doctors-section" role="tab" aria-controls="doctors-section">Doctors Section</a>
                        <a class="list-group-item list-group-item-action" id="list-attendance-list" data-toggle="list" href="#list-attendance" role="tab" aria-controls="attendance">Attendance</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-appointment" role="tabpanel" aria-labelledby="list-appointment-list">
                            <div class="card" style="height:700px">
                                <div class="card-header" style="background-color:#3498DB;color:#ffffff;text-align:center">
                                    <h4>Create an appointment</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form-group" action="func.php" method="post">
                                        <label>First Name :</label>
                                        <input type="text" name="fname" class="form-control"><br>
                                        <label>Last Name :</label>
                                        <input type="text" name="lname" class="form-control"><br>
                                        <label>Email id :</label>
                                        <input type="text" name="email" class="form-control"><br>
                                        <label>Phone number :</label>
                                        <input type="text" name="contact" class="form-control"><br>
                                        <label>Doctor :</label>
                                        <select class="form-control" name="docapp">
                                            <option value="Dr David">Dr David James</option>
                                            <option value="Dr Esther">Dr Esther Mordi</option>
                                            <option value="Dr Jane">Dr Jane Daniels</option>
                                            <option value="Dr John">Dr John Fayemi</option>
                                            <option value="Dr Kelechi">Dr Kelechi Emmanuel</option>
                                            <?php display_docs();?>
                                        </select><br>
                                        <label>Payment :</label>
                                        <select class="form-control" name="payment">
                                            <option value="paid">Paid</option>
                                            <option value="pay later">Pay later</option>
                                        </select><br>
                                        <input type="submit" class="btn btn-primary" name="pat_submit" value="Create new entry" id="inputbtn">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-payment-status" role="tabpanel" aria-labelledby="list-payment-status-list">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-group" method="post" action="func.php">
                                        <input type="text" name="contact_data" class="form-control" placeholder="enter phone number"><br>
                                        <select name="status" class="form-control">
                                            <option value="paid">paid</option>
                                            <option value="pay later">pay later</option>
                                        </select><br>
                                        <hr>
                                        <input type="submit" value="update" name="update_data" class="btn btn-primary">
                                    </form>
                                </div>
                            </div><br><br>
                        </div>
                        <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                        <div class="tab-pane fade" id="list-doctors-section" role="tabpanel" aria-labelledby="list-doctors-section-list">
                            <form class="form-group" method="post" action="func.php">
                                <label>Doctors name: </label>
                                <input type="text" name="name" placeholder="enter doctors name" class="form-control"><br>
                                <input type="submit" name="doc_sub" value="Add Doctor" class="btn btn-primary">
                            </form>
                        </div>
                        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
    
                    </div>
                </div>
            </div>
        </div>
    
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    
    </html>';
}
