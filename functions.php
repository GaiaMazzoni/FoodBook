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
        $stmt->bind_param("sss", $usernameOrEmail, $usernameOrEmail, $password);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0 ){
            return true;
        }else{
            return false;
        }
    }

    function add_post($username, $text, $mysqli){
        $stmt = $mysqli->prepare("SELECT max(IdPost) FROM post WHERE Username=?");
        $stmt->bind_param("s",$username);
        $IdPost = $stmt->fetch_assoc()["max(IdPost)"] + 1;
        $dateAndTime = date('Y-m-d H:i:s');
        $stmt = $mysqli->prepare("INSERT INTO post (`Username`, `IdPost`, `DateAndTime`, `Text`) VALUES ('?', '?', '?', ?);");
        $stmt->bind_param("sisb",$username,$IdPost,$dateAndTime,$text);
        $stmt->execute;
    }
    
    // Close connection
    function close_connection($conn) {
        $conn->close();
    }
?>
