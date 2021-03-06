<?php
/*This code assumes user input is valid and correct only for demo purposes - it does NOT validate form data.*/
if(!empty($_GET['id'])) { //must have at least a managerid not = NULL
    $id = $_GET['id'];
    $first = $_GET['first'];
    $last = $_GET['last'];
    $email = $_GET['email'];
    $phoneNum = $_GET['phoneNum'];
    $currentTest = $_GET['currentTest'];
    require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file

    //Make sure manager id doesn't already exist in the db
    $query1 = "SELECT * FROM Patient where patientID = ?";
    $stmt1 = mysqli_prepare($dbc, $query1);
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $result=mysqli_stmt_get_result($stmt1);
    $rows=mysqli_num_rows($result);
    if ($rows >=1) {
        echo "<h2>That patient id is already in use. Please go back and choose another.</h2>";
        mysqli_close($dbc);
        exit;
    }



    $query3 = "INSERT INTO Patient VALUES (?,?,?,?,?,?)";
    $stmt3 = mysqli_prepare($dbc, $query3);

    //second argument one for each ? either i(integer), d(double), b(blob), s(string or anything else)
    mysqli_stmt_bind_param($stmt3, "isssis", $id, $first, $last, $email, $phoneNum, $currentTest);

    if(!mysqli_stmt_execute($stmt3)) { //it did not run successfully
        echo "<h2>We were unable to add the patient at this time.</h2>";
        mysqli_close($dbc);
        exit;
    }
    mysqli_close($dbc);
}
else {
    echo "<h2>You have reached this page in error</h2>";
    mysqli_close($dbc);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Insert Patient</title>
    <meta charset ="utf-8">
</head>
<body>
<h2>Patient <?php echo "$first $last";?> was successfully added</h2>
<h3><a href="add_patient.html">Add another patient</a><h3>
        <h3><a href="projectMainMenu.html">Back to Home</a></h3>
</body>
</html>