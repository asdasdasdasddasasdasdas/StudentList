<?php
declare(strict_types=1);

use app\core\Router;


session_start();


spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', dirname(__FILE__) . "/" . $class . '.php');

    $path = str_replace('/public', '', $path);

    if (file_exists($path)) {
        require $path;
    }
});

require '../app/bootstrap.php';
$router = new Router($di);
$router->run();

// ОСНОВА  ^
// ОСНОВА  |


/* $dsn = "mysql:host=localhost;dbname=users;charset=utf8mb4";
$pdo = new pdo($dsn, "root", "");
$stmt=$pdo->query("SELECT discription.disc FROM students, discription WHERE students.id=discription.user_id ");

while($result=$stmt->fetch(PDO::FETCH_ASSOC)){
 echo '<br>'.$result['disc'];
}*/
