<?php
    require 'connect/connectdb.php';
    
    //รับข้อมูล
    $herb_search = $_POST['herb_search'];
    $search = $herb_search . '%' ;
    
    //sql search data
    $sql_search = " SELECT * FROM herb_place
                    INNER JOIN herb_name
                    ON herb_place.name_id = herb_name.name_id
                    INNER JOIN herb_data
                    ON herb_name.name_id = herb_data.name_id
                    WHERE name_th LIKE '$search' AND name_th NOT IN ('ก9999')
                  ";
    $res_search = pg_query($db, $sql_search);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="background-color: rgb(241, 242, 246);">

        <?php require 'header.php'; ?>

        <div class="container">
            <div class="row">                    
                <!-- ค้นหาข้อมูลสมุนไพร -->
                <div class="col-md-3">
                    <form action="search.php" method="post">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    <input name="herb_search" type="text" class="form-control" placeholder="ค้นหาชื่อสมุนไพร">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></button>
                                </td>     
                            </tr>
                        </table>
                    </form>
                </div>
                
                <!-- query data -->

                <div class="col-md-9">
                    
                    <table class="table table-bordered">
                        <tr class="info">
                            <th><center>#</center></th>
                            <th><center>ชื่อสมุนไพร</center></th>
                            <th><center>ภาพสมุนไพร</center></th>
                        </tr>
                        
                        <?php
                            while ($row_search = pg_fetch_array($res_search)) {
                        ?>
                        <tr>
                            <td><center><?php echo $row_search['place_id']; ?></center></td>
                            <td><center>
                                <a href="herb_detail.php?place_id=<?php echo $row_search['place_id']; ?>"><?php echo $row_search['name_th']; ?></a>
                            </center></td>
                            <td><center><img src="images/<?php echo $row_search['place_herbimg']; ?>" style="width: 100px; height: 100px;"></center></td>
                        </tr>
                        <?php } ?>
                        <div>
                            
                        </div>
                    </table>
                </div>  
                         
        </div> <!-- row -->           
    </div> <!-- container -->

    <!-- footer -->
    <?php require 'footer.php'; ?>

</body>
</html>
