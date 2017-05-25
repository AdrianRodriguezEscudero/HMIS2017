<?php
//session_start();
include_once "conexion.php";

if(!isset($_SESSION['userid']))
{
    if(isset($_POST['login']))
    {
        $_SESSION['userid'] = $result->idusuario;
        header("location:index.php");
    }

}
if(isset($_POST['registro']))
{

$usuario = $_POST['user'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$boolean="false";
if($usuario=="" || $password=="" || $password2==""){
  echo '<div class="error">Uno de los campos está vacío.</div>';
}else if($password!=$password2){
  echo '<div class="error">Las contraseñas no coinciden.</div>';
}else if(verificar_login($usuario,$password,$result) == 1){
  echo '<div class="error">El usuario ya está registrado.</div>';
}else if($password==$password2 && $usuario!=""){

  $mysqli = new mysqli("$hostname","$user","$pass","$database");
  $cadenaSQL = "Insert INTO usuarios(usuario,password) VALUES ('$usuario','$password')";
  $mysqli->query($cadenaSQL);
echo '<div class="correcto">El usuario se ha registrado correctamente.</div>';
}
}
?>
<style type="text/css">
*{
    font-size: 14px;
}
body{
background:#aaa;
}
form.login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 1px solid #DDDDDD;
    font-family: sans-serif;
    margin: 0 auto;
    padding: 20px;
    width: 278px;
    box-shadow:0px 0px 20px black;
    border-radius:10px;

}
form.login div {
    margin-bottom: 15px;
    overflow: hidden;
}
form.login div label {
    display: block;
    float: left;
    line-height: 25px;
}
form.login div input[type="text"], form.login div input[type="password"] {
    border: 1px solid #DCDCDC;
    float: right;
    padding: 4px;
}
form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: left;
    font-weight: bold;
    padding: 4px 20px;
}

form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: left;
    font-weight: bold;
    padding: 4px 20px;
}

.error{
    color: red;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}
.correcto{
    color: green;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}
</style>

<form action="" method="post" class="login">
    <div><label>Usuario</label><input name="user" type="text" ></div>
    <div><label>Contraseña</label><input name="password" type="password"></div>
    <div><label>Contraseña</label><input name="password2" type="password"></div>
    <div><label><input name="login" type="submit" value="Iniciar Sesión"></label>
    <div><label><input name="registro" type="submit" value="Registrarse"></div>
</form>
<?php

?>
