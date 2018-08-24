<?php
    require '../connect/connectdb.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../bootstrap/js/jquery.min.js" type="text/javascript"></script>
        
        <script>
            function list(tagNext, val, txtCon) {
                $.getJSON('search.php', {name: txtCon, value: val}, function (data) {
                    var select = $(tagNext);
                    var options = select.attr('options');
                    $('option', select).remove();
                    $(select).append('<option value=""> - เลือก - </option>');
                    $.each(data, function (index, array) {
                        $(select).css("display", "inline");
                        $(select).append('<option value="' + array[0] + '">' + array[1] + '</option>');
                    });
                });
            }

        </script>
        
    </head>
    <body>
        <h1>DropDownList</h1>
        <form name="formname" method="post" action="">
            
            <!-- country combobox -->
            <select id="alphabet" name="alphabet" onchange="list('#name', this.value, 'alphabet')">
                
                <?php
                    $query_alphabet = "SELECT * FROM herb_alphabet";
                    $result_alphabet = pg_query($db, $query_alphabet);
                    
                    while ($row_alphabet = pg_fetch_array($result_alphabet)) {
                        $alphabet_id = $row_alphabet['alphabet_id'];
                        $alphabet_th = $row_alphabet['alphabet_th'];
                        echo "<option value='$alphabet_id' selected>$alphabet_th</option>";
                    }
                ?>  
                
            </select>
            
            <!-- state combobox is chained by country combobox-->
            <select name="name" id="name"></select>
            
        </form>
    </body>
</html>
