<?php
    require 'header_expert.php';
    require 'function.php';

    //คำสั่ง sql เรียกเฉพาะข้อมูล = 9999
    $sql2 = "SELECT *  FROM herb_place 
            INNER JOIN herb_owner  
            ON herb_place.owner_id = herb_owner.owner_id 
            INNER JOIN herb_name  
            ON herb_place.name_id = herb_name.name_id
            WHERE name_th = 'ก9999' ";
    $result2 = pg_query($db, $sql2);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ระบบเก็บข้อมูลสมุนไพร</title>
       
        <script>
            var url = window.location; 
            // Will only work if string in href matches with location  

           $('ul.nav a[href="'+ url +'"]').parent().addClass('active');    
           // Will also work for relative and absolute hrefs  

           $('ul.nav a').filter(function() { 
                return this.href == url;
           }).parent().addClass('active');
        </script>
    </head>
    <body>

        <div class="container">

            <h2>ข้อมูลสมุนไพร</h2> 

            <center><div id="map"></div></center>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr class="info">
<!--                        <th><center>#</center></th>-->
                        <th><center>ชื่อสมุนไพร</center></th>
                        <th><center>รูปภาพ</center></th>
                        <th><center>ดูข้อมูล</center></th>
                        <th><center>แก้ไข</center></th>
                    </tr>
                </thead>

                <!-- show data -->
                <?php
                    //คำสั่ง sql
                    $query = "SELECT *  FROM herb_place 
                                INNER JOIN herb_owner
                                ON herb_place.owner_id = herb_owner.owner_id
                                INNER JOIN herb_name
                                on herb_place.name_id = herb_name.name_id
                                WHERE name_th NOT IN ('ก9999')
                                ORDER BY place_id ASC";

                    $result = pagination($query);
                    while ($row = pg_fetch_array($result)) {
                ?>

                    <tbody>
                        <tr>

                            <!-- ชื่อ 
                            <td><center><?php echo $row['place_id']; ?></center></td>-->

                            <!-- ชื่อสมุนไพร -->
                            <td><center><?php echo $row['name_th']; ?></center></td>

                            <!-- รูปภาพ -->
                            <td><center><img src="../images/<?php echo $row['place_herbimg']; ?>" style="width:100px;height:100px;"></center></td>

                            <!-- ดูข้อมูล -->
                            <td><center><a href="show_place_data.php?place_id=<?php echo $row['place_id']; ?>" class="btn btn-info btn-md">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a></center></td>

                            <!-- edit -->
                            <td><center><a href="frm_place_edit.php?place_id=<?php echo $row['place_id']; ?>" class="btn btn-warning btn-md">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a></center></td>

                        </tr>
                    </tbody>
                <?php } ?> 
            </table>

            <!-- paginationBar -->
            <?php
                $total_page = paginationBar($query);
            ?>

            <nav>
                <ul class="pagination">
                    <li class="active">
                        <a href="place_manage.php?page=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li><a href="place_manage.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="active">
                        <a href="place_manage.php?page=<?php echo $total_page; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- paginationBar -->

            <h2>ข้อมูลสมุนไพรที่ไม่ปรากฎชื่อ</h2> 
            <table class="table table-bordered">
                <tr class="danger">
                    <!--<th><center>#</center></th>-->
                    <!--<th><center>ชื่อ</center></th>-->
                    <th><center>ชื่อสมุนไพร</center></th>
                <th><center>รูปภาพ</center></th>
                <th><center>ดูข้อมูล</center></th>
                <th><center>แก้ไข</center></th>
                <!--<th><center>ลบ</center></th>-->
                </tr>

                <?php while ($row2 = pg_fetch_array($result2)) { ?>

                    <tr>
                        <td><center><?php echo $row2['name_th']; ?></center></td>
                        <td><center><img src="../images/<?php echo $row2['place_herbimg']; ?>" style="width:100px;height:100px;"></center></td>
                        <!-- ดูข้อมูล -->
                        <td><center><a href="show_place_data.php?place_id=<?php echo $row2['place_id']; ?>" class="btn btn-info btn-md">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a></center></td>
                        <!-- edit -->
                        <td><center><a href="frm_place_edit.php?place_id=<?php echo $row2['place_id']; ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a></center></td>
                    </tr>
                <?php } ?>
            </table>
            <br>                      
        </div>

    </body>
</html>


