<?php
$host = 'localhost'; 
$username = 'belal'; 
$password = 'belal';
$dbname = 'views'; 

try {
    // Connect to MySQL (without specifying database first)
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Create the 'views' database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    // Now connect to the 'views' database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    // Create 'visits' table if it doesn't exist
    $pdo->exec("CREATE TABLE IF NOT EXISTS visits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        visit_count INT NOT NULL DEFAULT 1
    )");

    // Check if there's already a record
    $stmt = $pdo->query("SELECT visit_count FROM visits WHERE id = 1");
    $row = $stmt->fetch();

    if ($row) {
        // Increment visit count
        $newCount = $row['visit_count'] + 1;
        $pdo->prepare("UPDATE visits SET visit_count = ? WHERE id = 1")->execute([$newCount]);
    } else {
        // Insert first visit record
        $newCount = 1;
        $pdo->exec("INSERT INTO visits (visit_count) VALUES (1)");
    }

echo "
    <style>
        body {
            background-color: #333; 
            color: #FFF2C2;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh; 
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }
        b {
            font-size: 1.5em;
        }
    </style>
    <h1>Hello world ...</h1>
    <p>This site has been visited <b>$newCount</b> times.</p>
";


} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
