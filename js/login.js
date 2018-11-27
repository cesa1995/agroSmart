var jwt = sessionStorage.getItem('jwt');
if(jwt!==null){
    window.location="administrador/administrador.php";
}