<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body style="background-color:#3498DB;color:white;padding-top:50px;text-align:center;">
    <?php
    include("func.php");
    if (isset($_POST['patient-search-submit'])) {
        $contact = $_POST['search'];
        $query = "select * from doctorapp where contact='$contact'";
        $result = mysqli_query($con, $query);
        echo "<div>
    <h5>Search Results<h5><br>
                <table class='table table-hover' style='color:#ffffff;'>
                    <thead>
                        <tr>
                            <th scope='col'>First Name</th>
                            <th scope='col'>Last Name</th>
                            <th scope='col'>Email id</th>
                            <th scope='col'>Phone number</th>
                            <th scope='col'>Doctor</th>
                            <th scope='col'>Payment</th>
                        </tr>
                    </thead>
                    <tbody>";
        while ($row = mysqli_fetch_array($result)) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $contact = $row['contact'];
            $docapp = $row['docapp'];
            $payment = $row['payment'];
            echo "  <tr>
        <td>$fname</td>
        <td>$lname</td>
        <td>$contact</td>
        <td>$email</td>
        <td>$docapp</td>
        <td>$payment</td>
      </tr>";
        }
        echo "</tbody></table></div>";
    }
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>