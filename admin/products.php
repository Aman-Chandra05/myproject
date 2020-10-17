
  
<?php
 include 'config.php';
 $error=array();
 $msg='';
 $img_req='required';
 $image='';
 $name='';
 $category='';
 $price='';
 $description='';
 $a='';
 $b=array();
 $b=(array) null;
 $img_req='required';
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$category=$_POST['category'];
	$price=$_POST['price'];
//	$image=$_FILES['image']['name'];
	$description=$_POST['description'];
	$a=$_POST['tg'];
	$b=implode(",",$a);
	if(sizeof($error)==0)
	{
		$sql = "SELECT * FROM tags WHERE `tag_name`='".$name."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$error[]=array('input'=>'form','msg'=>"Tag already exists");
 
		}
		else
		{
			if(isset($_GET['operation'])&& isset($_GET['id']))
			{  
				$id=$_GET['id'];
				if($_GET['operation']=='edit')
				{  
					if($_FILES['image']['name']!='')
					{
						$image=$_FILES['image']['name'];
						move_uploaded_file($_FILES['image']['tmp_name'],'products/'.$_FILES['image']['name']);
						$update_sql="UPDATE `products` SET `name`='$name',`price`='$price',`description`='$description',`image`='$image',`category_id`='$category',`tag`='$b' WHERE `product_id`='$id'";
					}
					else
					{
						$update_sql="UPDATE `products` SET `name`='$name',`price`='$price',`description`='$description',`category_id`='$category',`tag`='$b' WHERE `product_id`='$id'";
					}
					$conn->query($update_sql); 
				}		   
			}
			else
			{
				$image=$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'products/'.$_FILES['image']['name']);
				$sql = "INSERT INTO products (`category_id`, `name`, `price`,`description`,`image`,`tag`) VALUES ('".$category."', '".$name."', '".$price."', '".$description."','".$image."','".$b."')";
				$result = $conn->query($sql);
			   if($result==TRUE)
			   {
				   $msg="Product added!!!";
			   }	
			 //  $conn->close();	
			}	
			header('location:products.php');			     
		}
	}
}
if(isset($_GET['operation'])&& isset($_GET['id']))
{
	$img_req='';
	$id=$_GET['id'];
	if($_GET['operation']=='delete')
	{
		$delete_sql="DELETE FROM products WHERE `product_id`='$id'";
		$conn->query($delete_sql);
		header('location:products.php');
	}
	if($_GET['operation']=='edit')
	{   
		$sql = "SELECT * FROM products WHERE `product_id`='".$id."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$name=$row['name'];
		$category=$row['category_id'];
		$price=$row['price'];
		$description=$row['description'];
		$a=$row['tag'];
		$b=explode(",",$a);
	}
}


?>
<?php include ('header.php');?>
<?php include ('sidebar.php');?>

	<div id="main-content"> <!-- Main Content Section with everything -->
			
		<noscript> <!-- Show a notification if the user has disabled javascript -->
			<div class="notification error png_bg">
				<div>
					Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
				</div>
			</div>
		</noscript>
			
		<!-- Page Head -->
		<h2>Welcome John</h2>
		<p id="page-intro">What would you like to do?</p>
						
		<div class="clear"></div> <!-- End .clear -->
			
		<div class="content-box"><!-- Start Content Box -->
				
			<div class="content-box-header">
					
				<h3>Products</h3>
					
				<ul class="content-box-tabs">
					<li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
					<li><a href="#tab2">Add</a></li>
				</ul>
					
				<div class="clear"></div>
					
			</div> <!-- End .content-box-header -->
				
			<div class="content-box-content">
					
				<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
						
					<div class="notification attention png_bg">
						<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
						<div>
							This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
						</div>
					</div>
						
					<table>
							
						<thead>
							<tr>
								<th><input class="check-all" type="checkbox" /></th>
							   <th>Id</th>
							   <th>Image</th>
							   <th>Name</th>
							   <th>Category</th>
							   <th>Price </th>
							   <th>Description</th>
							   <th>Tags</th>
							   <th>Action</th>
							</tr>
								
						</thead>
						 
						<!--<tfoot>
							<tr>
								<td colspan="6">
									<div class="bulk-actions align-left">
										<select name="dropdown">
											<option value="option1">Choose an action...</option>
											<option value="option2">Edit</option>
											<option value="option3">Delete</option>
										</select>
										<a class="button" href="#">Apply to selected</a>
									</div>
										
									<div class="pagination">
										<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
										<a href="#" class="number" title="1">1</a>
										<a href="#" class="number" title="2">2</a>
										<a href="#" class="number current" title="3">3</a>
										<a href="#" class="number" title="4">4</a>
										<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
									</div>  End .pagination 
									<div class="clear"></div>
								</td>
							</tr>
						</tfoot>     -->
						 
						<tbody>
							<?php 
							   $sql = "SELECT products.*,categories.category_name FROM products, categories WHERE products.category_id=categories.category_id";
							   $result = $conn->query($sql) or die($conn->error);
							   if ($result->num_rows > 0)
							    {
 									 while($row = $result->fetch_assoc())
										{   ?>
									
										  <tr>
											 <td><input type="checkbox" /></td>
										 	 <td><?php echo $row['product_id']; ?></td>
											 <td><img src="products/<?php echo $row['image']; ?>"></td>
											 <td><?php echo $row['name']; ?></td>
										 	 <td><?php echo $row['category_name']; ?></td>
											 <td><?php echo $row['price']; ?></td>
											 <td><?php echo $row['description']; ?></td>
											 <td><?php echo $row['tag']; ?></td>
											 <td>
										     	<!-- Icons -->
											    <a href="products.php?operation=edit&id=<?php echo $row['product_id'];?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
											    <a href="products.php?operation=delete&id=<?php echo $row['product_id'];?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
											    <a href="products.php"title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
											 </td>
											 </tr>
								 <?php } 
								}?>
						</tbody>							
					</table>
						
				</div> <!-- End #tab1 -->
					
				<div class="tab-content" id="tab2">
					
					<form  method="post" enctype="multipart/form-data">							
						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            
							<p>
								<label>Name</label>
								<input required class="text-input medium-input datepicker"  type="text" id="medium-input" name="name" value="<?php echo $name ;?>" /> <!--<span class="input-notification error png_bg">Error message</span>  -->
							</p>

							<p>
								<label>Price</label>
								<input required class="text-input small-input" type="text" id="small-input" name="price" value="<?php echo $price ;?>" /> <!-- <span class="input-notification success png_bg"> Successful message</span> Classes for input-notification: success, error, information, attention -->  
							</p>
							
							<p>
								<label>Image</label>
								<input <?php echo $img_req; ?> class="text-input small-input" type="file" id="image" name="image" /> <!-- <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
							</p>
							
                            <p>
								<label>Category</label>              
								<select name="category" class="small-input">
								  <?php 
									 $sql="SELECT `category_id`,`category_name` FROM categories";
									 $result = $conn->query($sql) or die($conn->error);
										while($row = $result->fetch_assoc())
										{
											if($row['category_id']==$category)
											{
												echo "<option selected value=".$row['category_id'].">".$row['category_name']."</option>";
											}
											else
											{
												echo "<option value=".$row['category_id'].">".$row['category_name']."</option>";
											}
										}
									?>
								</select> 
							</p>
								
							<p>
								<label>Tags</label>
								  <?php 
									$sql="SELECT `tag_id`,`tag_name` FROM tags";
									$result = $conn->query($sql) or die($conn->error);
									while($row = $result->fetch_assoc())
									{?>
										<input type='checkbox' name='tg[]' value="<?php echo $row['tag_name'] ;?>" <?php if(in_array($row['tag_name'],$b)){echo 'checked';}?>><?php echo $row['tag_name'];?> 
										<?php 
									} ?>
							</p>
			
							<p>
								<label>Description</label>
								<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"><?php echo $description ;?></textarea>
							</p>
					
							<p>
								<input class="button" type="submit" value="Submit" name="submit" />
							</p>
								
						</fieldset>
							
						<div class="clear"></div><!-- End .clear -->
							
					</form>
				<div> 
					<p class="field_success"> <?php 
						if($msg!=='')
						  {
							echo $msg;
						  }?>
					</p>
					<p class="field_error">
						<?php foreach($error as $err)
							{?>
								<?php echo $err['msg']; ?>
								<?php 
							} ?>
					</p>
				</div>

				</div> <!-- End #tab2 -->        
					
			</div> <!-- End .content-box-content -->
				
		</div> <!-- End .content-box -->
			
			<div class="clear"></div>
			
			
			<!-- Start Notifications -->
			<!--
			<div class="notification attention png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
				</div>
			</div>
			
			<div class="notification information png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification success png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
			
			<div class="notification error png_bg">
				<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
				<div>
					Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
				</div>
			</div>
       -->
			<!-- End Notifications -->
			<?php include ('footer.php'); ?>		

