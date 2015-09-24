<? php 

function dbConnect()
{
    global $pdo;
    $conn = '';
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=localhost", DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e) {
        if (DEBUG_MODE) echo "<div class='alert alert-danger'><i class='fa fa-exclamation-circle'></i><strong>Database connection error</strong>: " . $e->getMessage() . "</div>";
    }

    return true;
}

?>