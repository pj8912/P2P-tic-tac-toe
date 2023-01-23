<?php 
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../vendor/autoload.php';
use Ttc\Database\Database;
use Ttc\Models\User;

if(isset($_SESSION['u_id'])){
    
    $database = new Database();
    $db = $database->connect();

    $u = new User($db);
    $uid  = $_SESSION['u_id'];
    $u->update_last_seen($uid);
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();

}