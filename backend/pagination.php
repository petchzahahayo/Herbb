<?php 
        require 'header.php'; 

        $perpage = 10;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $start = ($page - 1) * $perpage;

        $sql = "select * from herb_data limit ('$perpage') ";
        $query = pg_query($db, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
    <body style="margin-top: 10px;">
        
        <div class="container">
            
            <a href="frm_herb_add.php" class="btn btn-primary" >
                <span class="glyphicon glyphicon-plus"> เพิ่มสมุนไพร</span>
            </a>
            
            <h2>ข้อมูลสมุนไพร</h2> 
            
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php while ($result = pg_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $result['data_id']; ?></td>
                                    <td><?php echo $result['data_name_th']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $sql2 = "select * from herb_data ";
                    $query2 = pg_query($db, $sql2);
                    $total_record = pg_fetch_row($query2);
                    //$total_page = ceil($total_record / $perpage);
                    ?>

                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="index.php?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_record; $i++) { ?>
                                <li><a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php } ?>
                            <li>
                                <a href="index.php?page=<?php echo $total_record; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div> <!-- /container -->
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>