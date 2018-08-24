<?php
require 'connect/connectdb.php';
?>

<!DOCTYPE html>
<html>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>ระบบเก็บข้อมูลสมุนไพร</title>
        </head>
        <body style="background-color: rgb(241, 242, 246);">

            <?php require 'header.php'; ?>
                    
            <div class="container">
                <div class="row">

                    <!-- Main jumbotron -->
                    <div class="row">
                        <div class="col-md-9">
                            <div class="jumbotron">
                                <div class="jumbotron-contents">
                                    <h1>ระบบเก็บข้อมูลสมุนไพร</h1> 
                                    <p></p> 
                                </div>
                            </div>
                        </div>

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
                    </div>

                    <!-- query data -->
                    <?php
                        //กำหนดจำนวนหน้า
                        $perpage = 10;

                        //เช็คว่าเป็นค่าว่างหรือไม่
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $start = ($page - 1) * $perpage;
                        $sql_place = "  SELECT DISTINCT ON (herb_place.name_id) herb_place.place_id, herb_place.place_herbimg, herb_name.name_th
                                        FROM herb_place
                                        INNER JOIN herb_name
                                        on herb_place.name_id = herb_name.name_id
                                        WHERE herb_name.name_th NOT IN ('ก9999')
                                        ORDER BY herb_place.name_id, herb_place.place_id limit {$perpage} offset {$start}
                                     ";
                        $res_place = pg_query($db, $sql_place);
                        while ($row_place = pg_fetch_array($res_place)) {
                    ?>

                        <!-- Example row of columns -->
                        <div class="col-md-3">
                            <div class="thumbnail">              
                                <img src="images/<?php echo $row_place['place_herbimg']; ?>" 
                                     style="width:200px;height:200px;">                        
                                <div class="caption">
                                    <h3><?php echo $row_place['name_th']; ?></h3>
                                    <p>
                                        <a href="herb_detail.php?place_id=<?php echo $row_place['place_id']; ?>" class="btn btn-primary">รายละเอียด...</a> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div> <!-- row -->

                <?php
                $sql2 = "   SELECT DISTINCT ON (herb_place.name_id) herb_place.place_id, herb_place.place_herbimg, herb_name.name_th
                            FROM herb_place
                            INNER JOIN herb_name
                            on herb_place.name_id = herb_name.name_id
                            WHERE herb_name.name_th NOT IN ('ก9999')
                            ORDER BY herb_place.name_id, herb_place.place_id
                        ";
                $query2 = pg_query($db, $sql2);
                $total_record = pg_num_rows($query2);
                $total_page = ceil($total_record / $perpage);
                ?>

                <nav>
                    <ul class="pagination">
                        <li class="active">
                            <a href="index.php?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                            <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <li class="active">
                            <a href="index.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div> <!-- container -->
            
            <!-- footer -->
            <?php require 'footer.php'; ?>

        </body>
    </html>