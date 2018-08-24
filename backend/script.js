$(function () {
    //alert($("#type").val());
    $("#alphabet") . change(function () {
        $("#name_th").remove();
        if($("#alphabet").val() !== '--เลือกตัวอักษร--') {
            $.get("get_name.php", {alphabet_id: $("#alphabet").val()} )
                .done(function (data) {
                    //alert(data);
                    $("#alphabet").after(data);
            });
        }
    });
    
});


