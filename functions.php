<?php
    $servername = 'localhost'; // Replace with your actual database server name
    $username = 'root'; // Replace with your actual database username
    $password = ''; // Replace with your actual database password
    $dbname = 'foodbook'; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "Connected successfully";

    // Perform your database operations here

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $usernameOrEmail = $_POST["username"];
        $password = $_POST["password"];
    
        // Call the check_login function
        check_login($usernameOrEmail, $password, $conn);
    }

    function check_login($usernameOrEmail, $password, $mysqli){
        $stmt = $mysqli->prepare("SELECT Username FROM users WHERE Username=? OR E_mail=? AND Password=?");
        $stmt->bind_param("sss",$usernameOrEmail, $usernameOrEmail, $password);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0 ){
            return true;
        }else{
            return false;
        }
        $stmt->close();
    }
    
    // Close connection
    function close_connection($conn) {
        $conn->close();
    }
?>
