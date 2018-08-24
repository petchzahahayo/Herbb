<?php
        require 'header.php';
        require 'connect/connectdb.php';
        
        //คำสั่ง sql
        $sql = "SELECT *  FROM herb_place AS d1
                INNER JOIN herb_owner  AS d2
                ON  (d1.owner_id = d2.owner_id) 
                INNER JOIN herb_data  AS d3
                ON  (d1.data_id = d3.data_id)
                WHERE data_name_common NOT IN ('9999')
                ORDER BY place_id ASC";
        $result = pg_query($db, $sql);         
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            
            <h2>ข้อมูลสมุนไพร</h2> 
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
<!--                        <th><center>#</center></th>-->
                        <th><center>ชื่อ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                    </tr>
                </thead>
                
                <!-- show data -->
                <?php while($row = pg_fetch_array($result)){ ?>
                <tbody>
                    <tr>
                        <!-- ชื่อ -->
                        <td><center><?php echo $row['data_name_common']; ?></center></td>
            
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_herb_data.php?data_id=<?php echo $row['data_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                        </a></center></td>

                    </tr>
                </tbody>
                <?php } ?>
            </table>
            
        </div>
    </body>
</html>
<?php
    require 'footer.php';
?>
