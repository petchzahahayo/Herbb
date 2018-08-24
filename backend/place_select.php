<?php
    require '../connect/connectdb.php';

    //recive data
    $type_id = $_GET['type_id'];

    //sql select
    $sql =  " SELECT * 
              FROM herb_place
              INNER JOIN herb_name  
              ON herb_place.name_id = herb_name.name_id
              INNER JOIN herb_data
              ON herb_name.name_id = herb_data.name_id
              WHERE type_id='$type_id'
            ";
    $result = pg_query($db, $sql);
?>

<div class="col-md-3" id="name_row">
    <div class="input-group">  
        <select name="place_id" id="place_id" class="form-control">
            <option>--- เลือกสมุนไพร ---</option>

            <?php
                while ($row = pg_fetch_array($result)) {
                    echo '<option value="'.$row['place_id'].'">'.$row['name_th'].'</option>';
                }
            ?>

        </select>
        <button>click</button>
    </div>
    
</div>    

