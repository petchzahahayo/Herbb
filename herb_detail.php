<?php 
    require 'connect/connectdb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <style>
            p.p1 {
                font-family: verdana;
                font-size: 18px;
        </style>
        
    </head>
    <body style="background-color: rgb(241, 242, 246);">
        
        <!-- header -->
        <?php require 'header.php'; ?>
        
        <div class="container">
            
            <?php
                $place_id = $_GET['place_id'];
                $sql_place = "  SELECT * FROM herb_place
                                INNER JOIN herb_name
                                ON herb_place.name_id = herb_name.name_id
                                INNER JOIN herb_data
                                ON herb_name.name_id = herb_data.name_id
                                WHERE place_id = '$place_id'                                                                        
                             ";
                $res_place = pg_query($db, $sql_place);
                    
                while ($row_place = pg_fetch_array($res_place)) {  
            ?>
            
            <div class="row">
                
                <div class="col-md-2">
                   
                </div>
                
                <div class="col-md-8">
                    <div>
                        <center><img class="thumbnail" src="images/<?php echo $row_place['place_herbimg']; ?>" style="width:400px;height:300px;"></center>
                    </div>
                    
                    <div>
                        <h2><?php echo $row_place['name_th']; ?></h2>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['name_th']; ?></strong>
                            ชื่อภาษาอังกฤษ: <?php echo $row_place['data_name_eng']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['name_th']; ?></strong>
                            ชื่อวิทยาศาสตร์: <?php echo $row_place['data_name_sci']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['name_th']; ?></strong>
                            รายละเอียด: <?php echo $row_place['data_detail']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['name_th']; ?></strong>
                            ส่วนที่ใช้ทำยา: <?php echo $row_place['data_medicine']; ?>
                        </p>
                    </div>
                    
                    <div class="alert alert-info">
                        <p class="p1"><strong><?php echo $row_place['name_th']; ?></strong>
                            สรรพคุณ: <?php echo $row_place['data_properties']; ?>
                        </p>
                    </div>
                    
                    <div>
                        <a class="btn btn-info" href="index.php">กลับหน้าหลัก</a>
                    </div>
                    
                </div>
                
                <div class="col-md-2">
                    
                </div>
                
            </div>            
            
            <?php } ?>            
        </div>
        <br>
        <!-- footer -->
            <?php require 'footer.php'; ?>
    </body>
</html>
