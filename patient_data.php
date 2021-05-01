<?php
if(!empty($_GET['firstName'])) {
    $firstName = $_GET['firstName'];

    require_once('../mysqli_config.php'); //adjust the relative path as necessary to find your config file
    //Retrieve specific vendor data using prepared statements:
    $query = "SELECT * FROM Patient WHERE firstName = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "s", $firstName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($result);
    if($rows==1){ //Client found
        $client = mysqli_fetch_assoc($result); //Fetches the row as an associative array with DB attributes as keys
        $patientId = $client['patientID'];
        $firstName = $client['firstName'];
        $lastName = $client['lastName'];
        $email = $client['email'];
        $phoneNum = $client['phoneNum'];
        $testResults = $client['currentCovidResults'];
    } // end if($result)
    else {
        echo "<h2>That client was not found</h2>";
        mysqli_close($dbc);
        exit;
    }
}
else {
    echo "You have reached this page in error";
    exit;
}
//Clients found, output results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient</title>
    <meta charset ="utf-8">
    <!-- Add some spacing to each table cell -->
    <style> td, th {padding: 1em;} </style>
</head>
<body>
<h2>Patient: <?php echo "$patientId";?></h2>
<h3>FirstName: <?php echo "$firstName";?></h2>
    <h3>LastName: <?php echo "$lastName";?></h2>
        <h3>Email: <?php echo "$email";?></h2>
            <h3>Phone Number: <?php echo "$phoneNum";?></h2>
                <h3>Covid Test: <?php echo "$testResults";?></h2>
        <h3><a href="find_patient.html">Lookup another patient</a></h3>
        <h3><a href="projectMainMenu.html">Back to Home</a></h3>
</body>
</html>