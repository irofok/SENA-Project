function showTrabajadores(){
    $.ajax({
        url:"./viewTrabajador.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
