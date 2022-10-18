<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Reporte de Actividades</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

    <h3>Reporte de actividades</h3>
    <div class="nav">
        <a href="index.php">Regresar</a>

    </div>

    <?php
    require_once('class/notas.php');
    $obj_notas = new Nota();


    if (array_key_exists('filtrar', $_POST)) {
        $notas = $obj_notas->filtrar_nota($_REQUEST['filtro'], $_REQUEST['opcion']);
    } else {
        $notas = $obj_notas->mostrar_notas();
    }


    ?>

    <form action="reporte.php" method="post">
        Filtrar por
        <select name="filtro">
            <option value="descripcion" selected>Actividad</option>
            <option value="day">Dia</option>
            <option value="week">Semana</option>
            <option value="month">Mes</option>
            <option value="year">Año</option>
        </select>
        con el valor de
        <input type="text" name="opcion">
        <input name="filtrar" value="Filtrar Actividades" type="submit">
        <input name="todos" value="Todas las Actividades" type="submit">
    </form>

    <table border="true">
        <thead>
            <td>Id</td>
            <td>Titulo</td>
            <td>Fecha</td>
            <td>Ubicación</td>
            <td>Correo</td>
            <td>Repetir</td>
            <td>Tiempo de Repeticion</td>
            <td>Actividad</td>
        </thead>

        <tbody>
            <?php foreach ($notas as $nota) { ?>
                <tr>

                    <td> <?= $nota['id'] ?> </td>
                    <td> <?= $nota['titulo'] ?> </td>
                    <td> <?= $nota['fecha'] ?> </td>
                    <td> <?= $nota['ubicacion'] ?> </td>
                    <td> <?= $nota['correo'] ?> </td>
                    <td> <?= $nota['repetir'] ?> </td>
                    <td> <?= $nota['tiempo_repetir_hora'] ?> </td>
                    <td> <?= $nota['descripcion'] ?> </td>
                </tr>
            <?php } ?>


        </tbody>
    </table>


</body>

</html>