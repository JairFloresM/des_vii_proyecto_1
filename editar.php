<?php
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
</head>
<body>

    <?php
        $actividad;
        //clase nota
        include_once('class/notas.php');
        $obj_filtrar = new nota();
        $obj_notas=new nota();
        
        //clase actividades
        include("class/actividades.php");
        $obj_actividades=new actividad();
        $actividades=$obj_actividades->mostrar_actividades();
        if(array_key_exists('enviar', $_POST)){
            
            $obj_notas->editar($_REQUEST['id'],$_REQUEST['titulo'],$_REQUEST['fecha'],$_REQUEST['hora'],$_REQUEST['ubicacion'],$_REQUEST['correo'],$_REQUEST['repetir'],$_REQUEST['tiem_repetir'],$_REQUEST['actividad']);
            echo "Se envio correctamente ";
    ?>
    <div class="boton">
        <a href="index.php">Regresar</a>
    </div>         
    <?php
        }else{
            $id=$_GET['id'];
            $resultado = $obj_filtrar->filtar_id($id);
            foreach($resultado as $res){
                $titulo= $res['titulo'];
                $fecha=$res['fecha'];
                $hora=$res['hora'];
                $ubicacion=$res['ubicacion'];
                $correo=$res['correo'];
                $repetir=$res['repetir'];
                $tiemp_rep=$res['tiempo_repetir_hora'];
                $actividad=$res['id_actividad'];
                

            }  
        
        
    ?>
    <h1>Editar Nota</h1>
    
    <div class="boton">
        <a href="index.php">Regresar</a>
    </div>
    <form action="editar.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id?>">
        Titulo: <input type="text" name="titulo" value="<?php echo $titulo?>"><br>
        Fecha: (Año-Mes-Dia) <input type="text" name="fecha" value=" <?php echo $fecha ?>"><br>
        Hora: <input type="time" name="hora" value="<?php echo $hora ?>"><br>
        Ubicacion: <input type="text" name="ubicacion" value="<?php echo $ubicacion?>"><br>
        Correo: <input type="email" name="correo" value="<?php echo $correo?>"><br>
        Repetir: <input type="text" name="repetir" value="<?php echo $repetir?>"><br>
        Tiempo de Repeticion: <input type="time" name="tiem_repetir" value="<?php echo $tiemp_rep?>"><br>
        Actividad:
        <select name="actividad">
            
            <?php
                //lista todas las actividades en la base de datos (si se actualiza la base de datos de actualiza automaticamente)
                foreach($actividades as $resultado_a){
                    print("<option value='" . $res['id_actividad']."'>" .$resultado_a['descripcion']."</option>");
                }
            ?>
        </select><br>
        
        <a href="index.html"><input type="submit" value="Agregar" name="enviar" id="click"></a>
    </form>
    
    <?php
    }
    ?>
</body>
</html>