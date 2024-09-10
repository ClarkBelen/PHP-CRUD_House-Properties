<?php

    session_start();
    include("includes/sqlconnection.php");

    if(isset($_POST['save_record'])){
        
        $sellername = $_POST['txtname'];
        $sellername = strtoupper($sellername);
        $sellerID = $_POST['txtprc'];
        $contact = $_POST['txtcontact'];
        $offerType = $_POST['txtoffer'];
        $houseType = $_POST['txttype'];
        $bedroom = $_POST['txtbed'];
        $location = $_POST['txtloc'];
        $location = strtoupper($location);
        $price = $_POST['txtprice'];
        $pic = $_FILES['txtpic']['name'];

        $sql = "INSERT INTO tbl_houseinfo(sellerName, sellerID, contact, offerType, houseType, bedroom, location, price, pic)
                VALUES('$sellername', '$sellerID', '$contact', '$offerType', '$houseType', '$bedroom', '$location', '$price', '$pic')";

        if($conn->query($sql)===TRUE){
            move_uploaded_file($_FILES["txtpic"]["tmp_name"],"uploads/".$_FILES["txtpic"]["name"]);
            $_SESSION['status'] = "~~~~ Record Inserted Successfully ~~~~";
            header('location:index.php');
        }else{
            $_SESSION['status'] = "Error: Insertion Failed.....";
            header('location:index.php');
        }
        $conn->close();
    }

    if(isset($_POST['update_record'])){
        $id = $_POST['txtid'];
        $sellername = $_POST['txtname'];
        $sellerID = $_POST['txtprc'];
        $contact = $_POST['txtcontact'];
        $offerType = $_POST['txtoffer'];
        $houseType = $_POST['txttype'];
        $bedroom = $_POST['txtbed'];
        $location = $_POST['txtloc'];
        $price = $_POST['txtprice'];
        $pic_new = $_FILES['txtpic']['name'];
        $pic_old = $_POST['txtpic_old'];

        if($pic_new != ''){
            $update_pic = $pic_new;
        }else{
            $update_pic = $pic_old;
        }
        echo "$update_pic";

        $sql = "UPDATE tbl_houseinfo 
        SET sellerName='$sellername', sellerID='$sellerID', contact='$contact', 
        offerType='$offerType', houseType='$houseType', bedroom='$bedroom',
        location='$location', price='$price', pic='$update_pic' WHERE houseID='$id'";

        if($conn->query($sql)===TRUE){
            move_uploaded_file($_FILES["txtpic"]["tmp_name"],"uploads/".$_FILES["txtpic"]["name"]);
            $_SESSION['status'] = "~~~~ Record Updated Successfully ~~~~";
            header('location:index.php');
        }else{
            $_SESSION['status'] = "Error: Update Failed.....";
            header('location:edit.php');
        }
        $conn->close();
      
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pic = $_GET['pic'];

        $sql = "DELETE FROM tbl_houseinfo WHERE houseID = '$id'";

        if($conn->query($sql) === TRUE){
            unlink("uploads/".$pic);
            $_SESSION['status'] = "~~~~ Record Deleted Successfully ~~~~";
            header('location:index.php');
        }else{
            $_SESSION['status'] = "Error: Deletion Failed.....";
            header('location:index.php');
        }
        $conn->close();
    }
?>