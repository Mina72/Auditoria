<?php 
  if(isset($_POST ['usu'])){
    include('conexion.php');
    $sql=new connection();
    $conexion = $sql-> get_conection();

    $consulta=("call paLogin2(?,?)");
    $usuario=($_POST['usu']);
    $pass=($_POST['pass']);


    $rol=0;
    $inicio=0;

    $op=(0);
    $time = time();
    $fecha=(date("d-m-Y (H:i:s)", $time));

    function getRealIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

    $direc=(getRealIP());

  
    
      $cod_rol=$rol+1;
      $consulta=("call paBuscar(?,?)");
      $sentencia = $conexion->prepare($consulta);
      $sentencia->bind_param('ss',$cod_rol,$usuario);
      $sentencia->execute();
      $sentencia->store_result();
      $inicio=$sentencia->num_rows();


    switch ($cod_rol) {
      case '1':
        header("location:opcionesAdmin.php");
        break;
      
      default:
        # code...
        break;
    }




    if($sentencia = $conexion->prepare($consulta)){

      $sentencia->bind_param('ss',$usuario,$pass);

      $sentencia->execute();
      $sentencia->store_result();
      $inicio=$sentencia->num_rows();

      if($inicio<=0){
        echo "Datos Erroneos";

        $desc=("Intento de ingreso al sistema");



      }else{
        echo "Bienvenido al Sistema";

        $desc=("Ingreso al sistema");
        
      }

          $sql=new connection();
          $con = $sql->get_conection();
          $consulta=("call paVit1(?,?,?,?,?,?)");
          $sentencia = $con->prepare($consulta);
          $sentencia->bind_param('ssssss',$usuario,$op,$op,$direc,$desc,$fecha);
          $sentencia->execute();
          $sentencia->close();
    }
  }

    die();

?>
