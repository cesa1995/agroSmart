var jwt = sessionStorage.getItem('jwt');

if(jwt==null){
    window.location="../";
}

var url = 'http://localhost/agroSmart/api/usuarios/countuser.php';
var data = {jwt:sessionStorage.getItem('jwt')};
var log='hola';
fetch(url,{
    method:'POST',
    body:JSON.stringify(data),
    headers:{'Content-Type':'application/json'}})
.then(response => response.json())
.then(response =>{
    console.log(response);
})
.catch(error => console.error('Error:',error));

function exit(){
    sessionStorage.removeItem('jwt');
    window.location="../";
}
