<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>STREET KINGS</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<?php 
    include "libreria.php"; 
    $link = conectar(); 
?>
<body>
    <?php    
        include 'menu.php';
    ?>

    <?php // Función para mostrar los resultados de un partido
        function resultadoPartido($buscarPartido) {
            global $link;  // Usar la variable $link global

            // Sanitizar el parámetro para evitar inyecciones SQL
            $buscarPartido = (int) $buscarPartido; // Asegurarse de que sea un número entero
            
            // Consulta para obtener el resultado de un partido específico
            $orden = "SELECT idEquipo, idEquipo2, golesLocal, golesVisitante FROM EQUIPOS_PARTIDOS WHERE idPartido = $buscarPartido";
            $resultado = mysqli_query($link, $orden);

            // Consulta para saber si se ha jugado el partido o no
            $orden2 = "SELECT jugado FROM PARTIDOS WHERE idPartido = $buscarPartido";
            $resultado2 = mysqli_query($link, $orden2);
            while ($fila = mysqli_fetch_assoc($resultado2)) {
                $jugado = $fila['jugado']; 
            }

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                // Solo si hay resultados en la consulta
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $idEquipo1 = $fila['idEquipo']; 
                    $idEquipo2 = $fila['idEquipo2']; 
                    $golesLocal = $fila['golesLocal']; 
                    $golesVisitante = $fila['golesVisitante']; 

                    // Consulta para obtener el nombre del equipo local
                    $orden2 = "SELECT nombre FROM EQUIPOS WHERE idEquipo = $idEquipo1";
                    $resultado2 = mysqli_query($link, $orden2);
                    $fila2 = mysqli_fetch_assoc($resultado2);
                    $equipo1 = $fila2['nombre']; 

                    // Consulta para obtener el nombre del equipo visitante
                    $orden3 = "SELECT nombre FROM EQUIPOS WHERE idEquipo = $idEquipo2";
                    $resultado3 = mysqli_query($link, $orden3);
                    $fila3 = mysqli_fetch_assoc($resultado3);
                    $equipo2 = $fila3['nombre']; 

                    if ($jugado == 'Si') {
                        $result = $golesLocal . ' - ' . $golesVisitante;
                    } else {
                        $result = 'vs';
                    }

                    // Mostrar el resultado
                    echo "$equipo1 $result $equipo2 <br>";
                }
            } else {
                echo "No se encontraron resultados para este partido.<br><br>";
            }
        }
    ?>

    <h2>LIGA 1</h2>

    <br>

    <?php

    $buscarPartido = 1;
    $jornada = 1;

    while ($buscarPartido != 7){
        echo "<h3>JORNADA $jornada</h3>";
    
        echo "<p>";
        resultadoPartido($buscarPartido);
    
        $buscarPartido = $buscarPartido + 1;

        resultadoPartido($buscarPartido);

        echo "</p><br>";
    
        $buscarPartido = $buscarPartido + 1;
        $jornada = $jornada + 1;
    }
    ?>
</body>
</html>