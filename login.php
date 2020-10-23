<?php
session_start();
include 'config.php';
if(isset($_POST['email']) && isset($_POST['password']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    //echo $email=$_POST['email'].$password=$_POST['password'];
}
$sql="SELECT * FROM userinfo WHERE email='$email'AND password='$password'";
$res=$conn->query($sql);
if($res->num_rows>0)
{
    $row=$res->fetch_assoc();
    $_SESSION['username']=$row['username'];
    $_SESSION['loginstatus']='active';
    $_SESSION['user_id']=$row['user_id'];
    echo "present";
}
else
{
    echo "wrong";
}

?>