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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usernameOrEmail = $_POST["username"];
        $password = $_POST["password"];
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

    function get_all_posts_from_user($username, $mysqli){
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE Username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }

    
    
    // Close connection
    function close_connection($conn) {
        $conn->close();
    }
?>
