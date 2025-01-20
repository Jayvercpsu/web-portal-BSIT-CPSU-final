 
<?php
define('DB_SERVER', getenv('HEROKU_HOST') ? getenv('HEROKU_HOST') : 'localhost');
define('DB_USER',  getenv('HEROKU_USERNAME') ? getenv('HEROKU_USERNAME') : 'root');
define('DB_PASS', getenv('HEROKU_PASSWORD') ? getenv('HEROKU_PASSWORD') : '');
define('DB_NAME', getenv('HEROKU_DB') ? getenv('HEROKU_DB') : 'vnhs');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
 