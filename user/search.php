<?php
    require '../connect/connectdb.php';

    $aD = array();
    $id = $_GET['value'];
    $nameType = $_GET['name'];
    
    if ($nameType == 'alphabet') {
        if ($id != "") {
            /*
            $query_subType = "SELECT * FROM subtype WHERE typeId=$id";
            $subType = mysqli_query($connect, $query_subType);
            $totalRows_subType = mysqli_num_rows($subType);
             * 
             */
            $query_subType = "SELECT * FROM herb_name WHERE alphabet_id=$id";
            $subType = pg_query($db, $query_subType);
            $totalRows_subType = pg_num_rows($subType);
            
            if ($totalRows_subType > 0) {
                /*while ($row_subType=mysqli_fetch_array($subType)) {
                    $aD[] = array($row_subType["subTypeId"], $row_subType["subTypeName"]);
                }
                 * 
                 */
                while ($row_subType = pg_fetch_array($subType)) {
                    $aD[] = array($row_subType['name_id'], $row_subType['name_th']);
                    echo $aD;
                }
            }
        }
    }
    
    echo json_encode($aD);