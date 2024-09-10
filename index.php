<!DOCTYPE html>
<?php session_start(); ?>

<html>
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

    <title>House Records</title>
</head>
<body style="background-color:#daebe8;">
    <center>
        <nav class="navbar navbar-fixed-top"  style="background-color:#2f8379;">
            <div class="col-md-6 col-md-offset-3">
                <h2><strong>HOUSE PROPERTIES</strong></h2>
            </div>
            <div class="col-md-2 col-md-offset-1">
                <br>
                <form action="insert.php" method="POST">
                    <button class="btn btn-primary" type="submit" name="add_record">+ Add New Record</button>
                </form>
                <br>
            </div>
        </nav>
    
        <div class="container-fluid">
            <h1>House Properties</h1>
        </div>
        <br>
        <div class="container">
            <?php
                if(isset($_SESSION['status']) && $_SESSION != ''){
                    $status = $_SESSION['status'];
                    echo "
                    <div class='container'>
                        <div class='alert alert-success'>
                            <a href='#' class='close' data-dismiss='alert'>&times;</a>
                            <p><strong>$status</strong></p>
                        </div>
                    </div>
                    ";
                    echo "<br>";
                    unset ($_SESSION['status']);
                }
            ?>
            <br><br><br>
            <table class="table table-hover table-condensed">
                <tr>
                    <th class='lead text-center'><strong>HOUSE</strong></th>
                    <th colspan="2" class='lead text-center'><strong>DESCRIPTION</strong></th>
                </tr>

                <?php
                    viewAll();
                ?>
            </table>
            <br>
            <br>
        </div>
    
</body>
</html>

<?php


    function viewAll(){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_houseinfo order by houseID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $offer = "$row[offerType]";
                if($offer === "FOR SALE"){
                    $span = "<span class='label label-success'>";
                }else if($offer === "FOR RENT"){
                    $span = "<span class='label label-info'>";
                }else if($offer === "FOR LEASE"){
                    $span = "<span class='label label-warning'>";
                }
                
                $sellerID = trim("$row[sellerID]");
                if($sellerID === ""){
                    $sellerID="NONE";
                }

                $formattedPrice = number_format("$row[price]", 2);
                
                echo "
                    <tr>
                        <td class='text-center'>
                            <a href='uploads/$row[pic]'>
                                <img src='uploads/$row[pic]' width='650' alt='$row[pic]' class='img-thumbnail'>
                                <br>
                                <p class='lead text-center'>House #$row[houseID]</p>
                            </a>                        
                        </td>
                        <td class='col-md-4'>
                            <h4 class='lead'><strong>$row[houseType]</strong> $span$row[offerType]</span></h4>
                            <p><strong><span class='glyphicon glyphicon-pushpin'></span> Location: $row[location]</strong></p>
                            <br>
                            <h2><strong>₱$formattedPrice</strong></h2>
                            <br>
                            <h5><strong>Inclusion:</strong></h5>
                            <h5><span class='glyphicon glyphicon-bed'></span><strong> $row[bedroom]</strong> Bedrooms</h5>
                            
                                              
                        </td>
                        <td class='text-right col-md-2'>
                            <a href='edit.php?id=$row[houseID]' class='btn btn-primary btn-md' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-edit'></span></a>
                            <a href='controller.php?id=$row[houseID]&pic=$row[pic]' class='btn btn-danger btn-md' data-toggle='tooltip' data-placement='bottom' title='Delete'><span class='glyphicon glyphicon-trash'></span></a>
                            <br><br><br><br><br><br><br><br><br><br>
                            <p class='text-right'><strong>Seller</strong><br>$row[sellerName]</p><br>
                            <p class='text-right'><strong>PRC ID</strong><br>$sellerID</p><br>
                            <p class='text-right'><strong>Contact details</strong><br>$row[contact]</p>
                        </td>
                    </tr>
                ";
            }
        }else{
            echo "
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            ";
        }
    }
?>