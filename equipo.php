<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>STREET KINGS</title>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    </head>
<?php 
    include "libreria.php"; 
    $link = conectar();
    
    // Obtener el idEquipo
    if (isset($_GET['idEquipo'])) {
        $idEquipo = $_GET['idEquipo'];
    }

    // Obtener color equipo
    if ($idEquipo == 1){
        $color1 = 'cb2d26';
        $color2 = 'ffffff';
    }
    if ($idEquipo == 2){
        $color1 = '151722';
        $color2 = 'ae8e43';
    }
    if ($idEquipo == 3){
        $color1 = 'a6a6a6';
        $color2 = 'ffffff';
    }
    if ($idEquipo == 4){
        $color1 = '004aad';
        $color2 = 'ffbd59';
    }

    // Consulta para obtener todos los jugadores de un equipo
    $orden = "SELECT idJugador, nombre, apellido1, posicion, dorsal, foto_jugador FROM JUGADORES WHERE idEquipo=$idEquipo ORDER BY dorsal ASC";
    $resultado = mysqli_query($link, $orden);

    // Consulta para obtener datos del equipo
    $orden2 = "SELECT nombre, escudo FROM EQUIPOS WHERE idEquipo=$idEquipo";
    $resultado2 = mysqli_query($link, $orden2);
    while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        $equipo = $fila2['nombre']; 
        $escudo = $fila2['escudo'];
    }
?>
<body>
    <?php    
        include 'menu.php';
    ?>

    <div class="banner-equipo">
        <?php
            echo "<img src='img/$escudo' class='escudo-equipo' alt='Escudo $equipo'>";
            echo "<h1>$equipo</h1>";
        ?>
    </div>
    
    <h2>PLANTILLA</h2><hr>

    <div class="jugadores-container">
        <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $idJugador = $fila['idJugador']; 
                $nombre = $fila['nombre']; 
                $apellido1 = $fila['apellido1'];
                $posicion = $fila['posicion'];
                $dorsal = $fila['dorsal'];
                $foto_jugador = $fila['foto_jugador'];
                $total_goles = 0;
                $total_asistencias = 0;
                $total_partidos = 0;

                // Consulta para obtener todos los goles de un jugador
                $orden3 = "SELECT cantidad FROM JUGADORES_MARCAN_GOLES_PARTIDOS WHERE idJugador = $idJugador";
                $resultado3 = mysqli_query($link, $orden3);
                while ($fila3 = mysqli_fetch_assoc($resultado3)) {
                    $cantidad = $fila3['cantidad'];
                    $total_goles = $total_goles + $cantidad;
                }

                // Consulta para obtener todas las asistencias de un jugador
                $orden4 = "SELECT cantidad FROM JUGADORES_DAN_ASISTENCIAS_PARTIDOS WHERE idJugador = $idJugador";
                $resultado4 = mysqli_query($link, $orden4);
                while ($fila4 = mysqli_fetch_assoc($resultado4)) {
                    $cantidad = $fila4['cantidad'];
                    $total_asistencias = $total_asistencias + $cantidad;
                }
                
                // Consulta para obtener todas las asistencias de un jugador
                $orden5 = "SELECT * FROM JUGADORES_JUEGAN_PARTIDOS WHERE idJugador = $idJugador";
                $resultado5 = mysqli_query($link, $orden5);
                while ($fila5 = mysqli_fetch_assoc($resultado5)) {
                    $total_partidos = $total_partidos + 1;
                }

                // Consulta para obtener todas las tarjetas amarillas
                $orden6 = "SELECT COUNT(idJugador) AS tarjetas_amarillas FROM jugadores_tarjetas_amarilla WHERE idJugador = $idJugador";
                $resultado6 = mysqli_query($link, $orden6);
                while ($fila6 = mysqli_fetch_assoc($resultado6)) {
                    $tarjetas_amarillas = $fila6['tarjetas_amarillas'];;
                }

                // Consulta para obtener todas las tarjetas rojas
                $orden7 = "SELECT COUNT(idJugador) AS tarjetas_rojas FROM jugadores_tarjetas_roja WHERE idJugador = $idJugador";
                $resultado7 = mysqli_query($link, $orden7);
                while ($fila7 = mysqli_fetch_assoc($resultado7)) {
                    $tarjetas_rojas = $fila7['tarjetas_rojas'];;
                }

                // Consulta para obtener todas las dobles tarjetas amarillas
                $orden8 = "SELECT COUNT(idJugador) AS dobles_tarjetas_amarillas FROM jugadores_doble_tarjeta_amarilla WHERE idJugador = $idJugador";
                $resultado8 = mysqli_query($link, $orden8);
                while ($fila8 = mysqli_fetch_assoc($resultado8)) {
                    $dobles_tarjetas_amarillas = $fila8['dobles_tarjetas_amarillas'];;
                }
                
                echo "<div class='container-jugadores-equipo2'>";
                    echo "<div class='container-jugadores-equipo'>";
                        echo "<div class='jugador-equipo'>";
                            echo "<div class='img-jugador'>";
                                echo "<img src='img/$foto_jugador' alt='Foto $nombre $apellido1'>";
                            echo "</div>";
                            echo "<div class='info-stats-jugador'>";
                                echo "<div class='info-jugador'>";
                                    echo "$nombre $apellido1 <br>";
                                    echo "$posicion<br>";
                                    echo "#$dorsal";
                                echo "</div><br>";
                                echo "<div class='stats-jugador'>";
                                    echo "<table>";
                                        echo "<tr>";
                                            echo "<th>Partidos</th>";
                                            echo "<th>Goles</th>";
                                            echo "<th>Asisten.</th>";
                                            echo "<th><img src='img/tarjeta-amarilla.png' alt='Tarjetas Amarillas' class='tarjetas'></th>";
                                            echo "<th><img src='img/tarjeta-doble.png' alt='Doble Tarjetas Amarillas' class='tarjetas'></th>";
                                            echo "<th><img src='img/tarjeta-roja.png' alt='Tarjetas Rojas' class='tarjetas'></th>";
                                        echo "</tr>";
                                        echo "<tr class='num-stats-jugador'>";
                                            echo "<td>$total_partidos</td>";
                                            echo "<td>$total_goles</td>";
                                            echo "<td>$total_asistencias</td>";
                                            echo "<td>$tarjetas_amarillas</td>";
                                            echo "<td>$dobles_tarjetas_amarillas</td>";
                                            echo "<td>$tarjetas_rojas</td>";
                                        echo "<tr>";
                                    echo "</table>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        ?>
    </div>

    <h2>RESERVAS</h2><hr>
</body>
<style>
    .jugador-equipo {
        background: linear-gradient(to right, <?php echo "#$color1"; ?> 10%, <?php echo "#$color2"; ?> 90%);
    } 
    body{
        background-color: <?php echo "#$color1"; ?>;
    }
</style>
</html>