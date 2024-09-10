<!DOCTYPE html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

    <title>Edit House Property</title>
</head>
<body style="background-color:#daebe8;">
<center>
    <nav class="navbar navbar-fixed-top"  style="background-color:#2f8379;">
            <h2><strong>EDIT HOUSE PROPERTY</strong></h2>
        </nav>
    <div class="container-fluid" style="background-color:#2f8379;">
        <h2><strong>Edit House Property</strong></h2>
    </div>
    <br><br>
    <form action="controller.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <?php
            getRecord($_GET['id']);
        ?>
    </div>
    <div class="container">
        <button class="btn btn-primary btn-md" type="submit" name="update_record">Update Record</button>
        <a href="index.php" class="btn btn-warning">Cancel</a>
    </div>
    </form>
</center>
</body>
</html>


<?php
    function getRecord($recno){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_houseinfo WHERE houseID='$recno'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "
                    <input type='hidden' name='txtid' value='".$row['houseID']."'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <table  class='table table-bordered'>
                                <tr>
                                    <th colspan='6'>
                                        <h4 class='text-center'><strong>HOUSE INFORMATION</strong></h4>
                                    </th>
                                </tr>
                                <tr>
                                    <th>House Type</th>
                                    <td colspan='3'>
                                        <select class='form-control' type='text' name='txttype' required='true' style='background-color:#fff2df;'>
                                            <option value='".$row['houseType']."' selected hidden>".$row['houseType']."</option>
                                            <option>TOWNHOUSE</option>
                                            <option>SINGLE-FAMILY HOUSE</option>
                                            <option>BEACH HOUSE</option>
                                            <option>VILLA</option>
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <th>Offer Type</th>
                                    <td class='col-md-6'>
                                        <select class='form-control' type='text' name='txtoffer' required='true' style='background-color:#fff2df;'>
                                            <option value='".$row['offerType']."' selected hidden>".$row['offerType']."</option>
                                            <option>FOR SALE</option>
                                            <option>FOR RENT</option>
                                            <option>FOR LEASE</option>
                                        </select>
                                    </td>
                                    <th>No. of Bedroom</th>
                                    <td class='col-md-2'><input class='form-control' type='number' min='0' name='txtbed' required='true' style='background-color:#fff2df;'
                                    value='".$row['bedroom']."'>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td colspan='3'><input class='form-control' type='text' name='txtloc' required='true'
                                                style='text-transform:uppercase; background-color:#fff2df;'  value='".$row['location']."'/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td colspan='3'><input class='form-control' type='number' min='0' step='.01' name='txtprice' required='true' style='background-color:#fff2df;'
                                    value='".$row['price']."'>
                                    </td>
                                </tr>
                                <tr>
                                    <th>New House Photo</th>
                                    <td colspan='3'><input class='form-control' type='file' name='txtpic' style='background-color:#fff2df;'>
                                    <input type='hidden' name='txtpic_old' value='".$row['pic']."'>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class='col-md-6'>
                            <a href='uploads/$row[pic]'>
                                <img src='uploads/$row[pic]' width='500' height=325' alt='$row[pic]'>
                                <p><strong>House #$row[houseID] Old House Photo</strong></p>
                            </a>
                        </div> 
                    </div>
                    
              
                    <br>
                    
                <div class='col-md-6 col-md-offset-3'>
                    <table  class='table table-bordered'>
                        <tr>
                            <th colspan='6'>
                                <h4 class='text-center'><strong>SELLER INFORMATION</strong></h4>
                            </th>
                        </tr>
                        <tr>
                            <th>Seller Name</th>
                            <td><input class='form-control' type='text' name='txtname' required='true'
                                        style='text-transform:uppercase; background-color:#fff2df;'  value='".$row['sellerName']."'>
                            </td>
                        </tr>
                        <tr>
                            <th>PRC ID</th>
                            <td><input class='form-control' type='text' name='txtprc' style='background-color:#fff2df;'  value='".$row['sellerID']."'>
                            </td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><input class='form-control' type='text' name='txtcontact' required='true' style='background-color:#fff2df;'  value='".$row['contact']."'>
                            </td>
                        </tr>
                    </table>
                </div>
                ";
                
            }
        }else{
            echo "no record found";
        }
        $conn->close();
    }
?>