<?php
/*
BCS 2243 WEB ENGINEERING
GROUP : 2B-2
PROJECT : UMP-FK FINAL YEAR PROJECT MANAGEMENT SYSTEM (StudFYP)
MODULE : No.3 (Student)
NAME : NUR IZZLIN BINTI AZMAN 
MATRIC NO : CB20012
*/

/* CONNECTION DATABASE */
include('includes/config.php');

/* SESSION */
session_start();
if(isset($_SESSION['User'])){
    $User = $_SESSION['User'];
}else{
    header("location:/studfyp/login.php");
}

/* INSERT PROPOSAL DATA FUNCTION */
if(isset($_REQUEST['btn_insert']))
{
    $name	= $_REQUEST['txt_name'];//textbox name "txt_name"
    $date	= $_REQUEST['date'];	//textbox name "date"
    $studID	= $_REQUEST['txt_id']; //textbox name "txt_id"

    //FILE UPLOAD
    $message="";
    $file=$_FILES['txt_file']['name'];
    $target="files/".basename($file);

    if(move_uploaded_file($_FILES['txt_file']['tmp_name'],$target)){
        $message="File uploaded successfully";
    }else{
        $message="Failed to upload the file";
    }
    
    
    $insert_data="INSERT INTO thesis (thesis_type,thesis_date,thesis_attach,student_id)VALUES('$name','$date','$file','$studID')";
    $run_data = mysqli_query($bd,$insert_data);

    if($run_data){
        header('location: proposal.php');
    }else{
        echo "Data unsuccessfully insert";
    }
}

?>
	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Proposal | Student</title>
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>

    <body>
        <!-- HEADER SECTION -->
        <?php include('includes/header.php');?>
        <!--  SIDEBAR SECTION -->    
        <?php include('includes/menubar.php');?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"><h1 class="page-head-line">Proposal FYP </h1></div>
                </div>
                <div class="row" >
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"><center>ADD PROPOSAL</center></div>
                            <font color="black" align="left">
                            <div class="panel-body">
                                <form class="form-inline" method="POST"  enctype="multipart/form-data">
                                    <table align="center" width="100%">
                                        <tr>
                                            <td><label class="control-label">Student ID : </label></td>
                                            <td><input type="text" name="txt_id" class="form-control" placeholder="Enter Student ID" required="required" /></td>
                                        </tr>

                                        <tr>
                                            <td><label class="control-label">Proposal Name : </label></td>
                                            <td><input type="text" name="txt_name" class="form-control" placeholder="enter proposal name" required="required" /></td>
                                        </tr>

                                        <tr>
                                            <td><label class="control-label">Date: </label></td>
                                            <td><input type="date" name="date" class="form-control" required="required" /></td>
                                        </tr>
                                                    
                                        <tr>
                                            <td><label class="control-label">Proposal Attach: </label></td>
                                            <td><input type="file" name="txt_file" class="form-control" required="required" /></td>
                                        </tr>
                                                    
                                        <tr>
                                            <td colspan="2">
                                                <br>
                                                <input type="submit"  name="btn_insert" class="btn btn-success " value="SUBMIT">
                                                <input type="reset"   name="btn_reset" class="btn btn-info "value="RESET">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>

        <!-- FOOTER SECTION -->
        <?php include('includes/footer.php');?>

        <!-- SCRIPT SECTION -->
        <script src="assets/js/jquery-1.11.1.js"></script>
        <script src="assets/js/bootstrap.js"></script>
    </body>
</html>