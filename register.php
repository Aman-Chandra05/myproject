<?php
include 'config.php';
if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
}
$sql="SELECT * FROM userinfo WHERE email='$email'";
$res=$conn->query($sql);
if($res->num_rows>0)
{
    echo "present";
}
else
{
    $addedon=date('Y-m-d h:i:s');
    $sql="INSERT INTO `userinfo`(`username`, `email`, `password`, `addedon`) VALUES ('$name','$email','$password','$addedon')";
    $res=$conn->query($sql);
    echo "inserted";
}



?>