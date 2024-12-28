<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=io;charset=utf8", "root", "root");
} catch ( PDOException $e ){
     print $e->getMessage();
     exit;
}
?>