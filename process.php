<?php
session_start();
$name='';
$location='';
$update=false;
$id=0;
  include 'db.php';
  if(isset($_POST['save']))
  {
  	  $name=$_POST['name'];
  	  $location=$_POST['location'];
  	 

  	  $stmt=$conn->prepare("insert into crud(name,location)values(?,?)");
  	  $stmt->bind_param("ss",$name,$location);
  	  $stmt->execute();
  	   $_SESSION['message']="Recored has been Saved";
  	  $_SESSION['msg_type']="success";
  	  header('location:crud.php');
  	    


  }
  if(isset($_GET['delete']))
  {
  	   $id=$_GET['delete'];
  	   
  	   $stmt=$conn->prepare("delete from crud where id=?");
  	   $stmt->bind_param('i',$id);
  	   $stmt->execute();
  	   $_SESSION['message']="Record has been deleted";
  	   $_SESSION['msg_type']="danger";
  	   header('location:crud.php');
  }
  if(isset($_GET['edit']))
  {
  	   $id=$_GET['edit'];
  	   $update=true;
  	   $stmt=$conn->prepare("select * from crud where id=?");
  	   $stmt->bind_param('i',$id);
  	   $stmt->execute();
  	   // $stmt->fetch();
  	   $result=$stmt->get_result();
  	   
  	   


  	   
  	   	$row=$result->fetch_assoc();
  	   	$name=$row['name'];
  	   	$location=$row['location'];

  	   
  }
  if(isset($_POST['update']))
  {
  	 $id=$_POST['id'];
  	 $name=$_POST['name'];
  	 $location=$_POST['location'];
  	 $stmt=$conn->prepare("update crud set name=?,location=? where id=?");
  	 $rc=$stmt->bind_param('ssi',$name,$location,$id);
  	 if(false==$rc)
  	 {
  	 	die('bind_param() failed: ' . htmlspecialchars($stmt->error));
  	 }
  	 $stmt->execute();
  	  $_SESSION['message']="Record has been Updated";
  	   $_SESSION['msg_type']="primary";
  	   header('location:crud.php');
  }



?>