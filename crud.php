<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php  require_once  'process.php'; ?>
    <?php
      if(isset($_SESSION['message']))
      {

    ?>
       <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
           <?php
                echo $_SESSION['message'];
                unset($_SESSION['messgae']);
              ?>
       </div>
       <?php }   ?>
      <?php
        include "db.php";
       
         $stmt=$conn->prepare("select * from crud");
          $stmt->execute();

          $result=$stmt->get_result();
           
          
      ?>
      <div class="container">
      <div class="row justify-content-center">
              <table class="table table-dark table-striped">
                <thead>
                	<tr>
                		<th>Name</th>
                		<th>Location</th>
                		<th colspan="">Action</th>
                	</tr>
                </thead>
            <?php
               while($user=$result->fetch_assoc())
               { 

              



            ?>
              <tbody>
              	  <tr>
              	  	<td><?php echo $user['name'];   ?></td>
              	  	<td><?php  echo $user['location'];   ?></td>
              	  	<td><a href="crud.php?edit=<?php echo $user['id'];  ?>"
              	  	class="btn btn-info">Edit
              	  	</a>
              	  	<a href="process.php?delete=<?php echo $user['id'];   ?>" class="btn btn-danger">Delete</a>
              	  	</td>
              	  	<td></td>
              	  </tr>
              </tbody>
              <?php  }   ?>


              	
              </table>
      	
      </div>

	<div class="row justify-content-center">
    <form action="process.php" method="post">
    <input type="hidden" name="id" value="<?php  echo $id; ?>"></input>
    <div class="form-group">
    <label>Name</label>
       <input type="text" name="name" value="<?php  echo $name;?>" placeholder="Enter the Name" class="form-control"></input>
       </div>
       <div class="form-group">
       <label>Location</label>
       <input type="text" name="location" value="<?php echo $location;   ?>" placeholder="Enter the Location" class="form-control"></input>
       </div>
       <div class="form-group">
       <?php if($update==true){   ?>
       <button type="submit" name="update" class="btn btn-success">update</button>
       <?php }else {   ?>
       
     
       <button type="submit" name="save" class="btn btn-success">Save</button>
       </div>
       <?php }   ?>
    	
    </form>
    </div>
    </div>


</body>
</html>