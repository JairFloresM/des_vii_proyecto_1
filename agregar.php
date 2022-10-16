<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar nota</title>
</head>
<body>
    <?php
        include("class/actividades.php");
        $obj_actividades=new actividad();
        $actividades=$obj_actividades->mostrar_actividades();
        $nactividad=count($actividades);
        $valor="Holi";
    ?>
<h1>Agregar Nota</h1>
    <div class="boton">
        <a href="index.php">Regresar</a>
    </div>
    <form action="agregar.php" method="post">
        Titulo: <input type="text" name="titulo" value="<?php echo $valor?>"><br>
        Fecha: <input type="date" name="fecha" id=""><br>
        Hora: <input type="time" name="hora" id=""><br>
        Ubicacion: <input type="text" name="ubicacion"><br>
        Correo: <input type="email" name="correo" id=""><br>
        Repetir: <input type="text" name="repetir" id=""><br>
        Tiempo de Repeticion: <input type="time" name="tiem_repetir"><br>
        Actividad:
        <select name="actividad">
            
            <?php
                //lista todas las actividades en la base de datos (si se actualiza la base de datos de actualiza automaticamente)
                foreach($actividades as $resultado_a){
                    print("<option value='" .$resultado_a['id']."'>" .$resultado_a['descripcion']."</option>");
                }
            ?>
        </select><br>
        <input type="submit" value="Agregar" name="enviar">
    </form>
    <?php
    include("class/notas.php");
    //envia los datos a la base de datos
    if(array_key_exists('enviar', $_POST)){
        $obj_notas=new Nota();
        
        print("Titulo: ".$_REQUEST['titulo']."<br>");
        print("Hora: ".$_REQUEST['hora']."<br>");
        print("fecha: ".$_REQUEST['fecha']."<br>");
        print("Hora: ".$_REQUEST['hora']."<br>");
        print("ubicacion: ".$_REQUEST['ubicacion']."<br>");
        print("correo: ".$_REQUEST['correo']."<br>");
        print("repetir: ".$_REQUEST['repetir']."<br>");
        print("tiem_repetir: ".$_REQUEST['tiem_repetir']."<br>");
        print("ACtividad: ".$_REQUEST['actividad']."<br>");
        $obj_notas->agregar_nota($_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['hora'],$_REQUEST['ubicacion'],$_REQUEST['correo'],$_REQUEST['repetir'],$_REQUEST['tiem_repetir'],$_REQUEST['actividad']);
        echo "Se envio correctamente";
    }
    
    ?>
</body>
</html>