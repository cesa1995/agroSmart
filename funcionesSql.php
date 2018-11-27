<?php

require 'conexion.php';

class sql{
    function __construct()
    {
    }

//listar usuario fincas y equipos

/*---USUARIOS----*/

    public static function login($email){
        $consulta = "SELECT * FROM usuarios WHERE email=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($email));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOExeption $e){
            return 0;
        }
    }

    public static function addUsuario($nombre,$apellido,$email,$contrasena,$nivel){
        $consulta = "INSERT INTO usuarios (nombre, apellido, email, contrasena, nivel) VALUES (?,?,?,?,?)";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$apellido,$email,$contrasena,$nivel));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function usuarios(){
        $consulta = "SELECT * FROM usuarios ORDER BY nombre ASC";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function upUsuariosByID($nombre,$apellido,$nivel,$id){
        $consulta = "UPDATE usuarios SET nombre=?, apellido=?, nivel=? WHERE id=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$apellido,$nivel,$id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function upUsuarioPassByID($password,$id){
        $consulta = "UPDATE usuarios SET contrasena=? WHERE id=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($password,$id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function rmUsuariosByID($id){
        $consulta1 = "DELETE FROM usuarios WHERE id=?";
        $consulta2 = "DELETE FROM fincausu WHERE usuarioid=?";
        try{
            $comando1 = conexion::getInstance()->getDb()->prepare($consulta1);
            $comando1->execute(array($id));
            $comando2 = conexion::getInstance()->getDb()->prepare($consulta2);
            $comando2->execute(array($id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function usuariosByID($id){
        $consulta = "SELECT * FROM usuarios WHERE id=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    /*---FINCAS----*/

    public static function addFincas($nombre,$telefono,$direccion){
        $consulta = "INSERT INTO fincas (nombre,telefono,direccion) VALUES (?,?,?)";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$telefono,$direccion));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function fincas(){
        $consulta = "SELECT * FROM fincas ORDER BY nombre ASC";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function upFincasByID($nombre,$telefono,$direccion,$id){
        $consulta = "UPDATE fincas SET nombre=?, telefono=?, direccion=? WHERE id=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$telefono,$direccion,$id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function rmFincaByID($id){
        $consulta1="DELETE FROM fincas WHERE id=?";
        $consulta2="DELETE FROM fincaequ WHERE fincaid=?";
        $consulta3="DELETE FROM fincausu WHERE fincaid=?";
        try{
            $comando1=conexion::getInstance()->getDb()->prepare($consulta1);
            $comando1->execute(array($id));
            $comando1=conexion::getInstance()->getDb()->prepare($consulta2);
            $comando1->execute(array($id));
            $comando1=conexion::getInstance()->getDb()->prepare($consulta3);
            $comando1->execute(array($id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function fincasByID($id){
        $consulta = "SELECT * FROM fincas WHERE id=?";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    /*------EQUIPOS------*/

    public static function addEquipos($nombre,$devicetype,$descripcion){
        $consulta="INSERT INTO equipos (nombre,devicetype,descripcion) VALUES (?,?,?)";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$devicetype,$descripcion));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function equipos(){
        $consulta = "SELECT * FROM equipos ORDER BY nombre ASC";
        try{
            $comando = conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function equiposByID($id){
        $consulta = "SELECT * FROM equipos WHERE id=?";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function upEquiposByID($nombre,$devicetype,$descripcion,$id){
        $consulta="UPDATE equipos SET nombre=?, devicetype=?, descripcion=? WHERE id=?";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nombre,$devicetype,$descripcion,$id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function rmEquipoByID($id){
        $consulta1="DELETE FROM equipos WHERE id=?";
        $consulta2="DELETE FROM fincaequ WHERE equipoid=?";
        try{
            $comando1=conexion::getInstance()->getDb()->prepare($consulta1);
            $comando1->execute(array($id));
            $comando2=conexion::getInstance()->getDb()->prepare($consulta2);
            $comando2->execute(array($id));
        }catch(PDOExection $e){
            return 0;
        }
    }

    /*----ASOCIAR-----*/

    public static function usuariosByNivel($nivel1,$nivel2){
        $consulta="SELECT * FROM usuarios WHERE nivel=? OR nivel=? ORDER BY nombre";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($nivel1,$nivel2));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function fincausuByID($id){
        $consulta="SELECT nombre,nivel,fincausu.id FROM usuarios INNER JOIN fincausu WHERE usuarios.id=fincausu.usuarioid AND fincausu.fincaid=? ORDER BY nombre";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function fincaequByID($id){
        $consulta="SELECT nombre,fincaequ.estado,fincaequ.id FROM equipos INNER JOIN fincaequ WHERE equipos.id=fincaequ.equipoid AND fincaequ.fincaid=? ORDER BY nombre";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function addFincaequ($fincaid,$equipoid,$estado){
        $consulta="INSERT INTO fincaequ (fincaid,equipoid,estado) VALUES (?,?,?)";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($fincaid,$equipoid,$estado));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function usuarioValidByID($id){
        $consulta="SELECT usuarioid FROM fincausu WHERE usuarioid=?";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function addFincausu($fincaid,$usuarioid){
        $consulta="INSERT INTO fincausu (fincaid,usuarioid) VALUES (?,?)";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($fincaid,$usuarioid));
        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function rmFincaequByID($id){
        $consulta="DELETE FROM fincaequ WHERE id=?";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));

        }catch(PDOExection $e){
            return 0;
        }
    }

    public static function rmFincausuByID($id){
        $consulta="DELETE FROM fincausu WHERE id=?";
        try{
            $comando=conexion::getInstance()->getDb()->prepare($consulta);
            $comando->execute(array($id));
        }catch(PDOExection $e){
            return 0;
        }
    }
}

//otras funciones
//funcion para validar el correo electronico
function email($str){
    $result = (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
    if($result){
        list($user,$domain) = preg_split('/[@]/', $str);
        $result = checkdnsrr($domain, "MX");
    }
    return $result;
}
?>