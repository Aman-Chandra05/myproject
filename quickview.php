<?php 
include 'config.php';
if(isset($_POST['id']))
{
    $id=$_POST['id'];
}
//$sql="SELECT * FROM products WHERE `product_id`='$id'";
$sql = "SELECT products.*,categories.category_name FROM products, categories WHERE products.product_id='$id' AND products.category_id=categories.category_id";

$res=$conn->query($sql);
$row=$res->fetch_assoc();
echo json_encode( array('product'=>$row));

?>