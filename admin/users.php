
  
<?php
 include 'config.php';
 $error=array();
 $msg='';
 $name='';
 $email='';
 $role='';
 $pass_req='required';
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	if(isset($_POST['password']))
	{
		$password=$_POST['password'];
	}
	else
	{
		$password='';
	}
	$role=$_POST['role'];
	if(sizeof($error)==0)
	{
		$sql = "SELECT * FROM users WHERE `name`='".$name."' AND `email`='".$email."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			$error[]=array('input'=>'form','msg'=>"User already exists");
		}
		else
		{
			if(isset($_GET['operation'])&& isset($_GET['id']))
			{  
				$id=$_GET['id'];
				if($_GET['operation']=='edit')
				{  
					if($password!='')
					{
						$update_sql="UPDATE `users` SET `username`='$name',`email`='$email',`role`='$role',`password`='$password' WHERE `user_id`='$id'";
					}
					else
					{
						$update_sql="UPDATE `users` SET `username`='$name',`email`='$email',`role`='$role' WHERE `user_id`='$id'";
					}
					$conn->query($update_sql); 
				}		   
			}
			else
			{
				$sql = "INSERT INTO users (`username`, `password`, `email`, `role`) VALUES ('".$name."', '".$password."', '".$email."', '".$role."')";
				$result = $conn->query($sql);
			   if($result==TRUE)
			   {
				   $msg="User added!!!";
			   }	
			}	
			header('location:users.php');			     
		}
	}
}
if(isset($_GET['operation'])&& isset($_GET['id']))
{
	$pass_req='';
	$id=$_GET['id'];
	if($_GET['operation']=='delete')
	{
		$delete_sql="DELETE FROM users WHERE `user_id`='$id'";
		$conn->query($delete_sql);
		header('location:users.php');
	}
	if($_GET['operation']=='edit')
	{   
		$sql = "SELECT * FROM users WHERE `user_id`='".$id."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$name=$row['username'];
		$email=$row['email'];
		$role=$row['role'];
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
					
				<h3>Users</h3>
					
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
							   <th>Name</th>
							   <th>Email</th>
							   <th>Password </th>
							   <th>Role</th>
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
							   $sql = "SELECT * FROM users";
							   $result = $conn->query($sql) or die($conn->error);
							   if ($result->num_rows > 0)
							    {
 									 while($row = $result->fetch_assoc())
										{   ?>
									
										  <tr>
											 <td><input type="checkbox" /></td>
										 	 <td><?php echo $row['user_id']; ?></td>
											 <td><?php echo $row['username']; ?></td>
										 	 <td><?php echo $row['email']; ?></td>
											 <td><?php echo $row['password']; ?></td>
											 <td><?php echo $row['role']; ?></td>
											 <td>
										     	<!-- Icons -->
											    <a href="users.php?operation=edit&id=<?php echo $row['user_id'];?>" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
											    <a href="users.php?operation=delete&id=<?php echo $row['user_id'];?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
											    <a href="users.php"title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
											 </td>
											 </tr>
								 <?php } 
								}?>
						</tbody>							
					</table>
						
				</div> <!-- End #tab1 -->
					
				<div class="tab-content" id="tab2">
					
					<form  method="post">							
						<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
                            
							<p>
								<label>Name</label>
								<input required class="text-input small-input datepicker"  type="text" id="medium-input" name="name" value="<?php echo $name ;?>" /> <!--<span class="input-notification error png_bg">Error message</span>  -->
							</p>

							<p>
								<label>Email</label>
								<input required class="text-input small-input" type="email" id="small-input" name="email" value="<?php echo $email ;?>" /> <!-- <span class="input-notification success png_bg"> Successful message</span> Classes for input-notification: success, error, information, attention -->  
							</p>
							
							<p>
								<label>Password</label>
								<input <?php echo $pass_req; ?> class="text-input small-input" type="password" id="password" name="password" /> <!-- <span class="input-notification success png_bg">Successful message</span> <!-- Classes for input-notification: success, error, information, attention -->
							</p>
							
							<p>
								<label>Role</label>
								<input required class="text-input small-input" type="text" id="small-input" name="role" value="<?php echo $role ;?>" /> <!-- <span class="input-notification success png_bg"> Successful message</span> Classes for input-notification: success, error, information, attention -->  
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

