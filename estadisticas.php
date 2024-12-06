<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>STREET KINGS</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php    
        include 'menu.php';
        include "libreria.php"; 
        $link = conectar(); 
    ?>
    <div>
        <table class="tabla-estadistica">
            <caption>GOLEADORES</caption>
            <tr>
                <th>Posición</th>
                <th>Jugador</th>
                <th>Goles</th>
                <th>Partidos</th>
                <th>Goles(penalti)</th>
                <th>Goles (doble penalti)</th>
            </tr>
            <tr>
                <?php 
                $Count = 1;
                // obtener máximos goleadores
                $maxgoles = "SELECT jugadores.idJugador, jugadores.nombre, jugadores.apellido1, jugadores_marcan_goles_partidos.cantidad FROM jugadores_marcan_goles_partidos  INNER JOIN jugadores ON jugadores_marcan_goles_partidos.idJugador = jugadores.idJugador WHERE jugadores_marcan_goles_partidos.idLiga = 1 ORDER BY cantidad DESC"; // golespen, golesdoblepen falta en el select
                $resultado_maxgoles = mysqli_query($link, $maxgoles); 
                while ($fila = mysqli_fetch_assoc($resultado_maxgoles)) {
                    $nombre = $fila['nombre'];
                    $goles =  $fila['cantidad'];
                    $idJugador = $fila['idJugador'];
                    $apellido1 = $fila['apellido1'];

                    $conspartidos = "SELECT COUNT(idJugador) AS partidos FROM jugadores_juegan_partidos WHERE idLiga = 1 AND idJugador = $idJugador"; 
                    $resultado_conspartidos = mysqli_query($link, $conspartidos); 
                    while ($fila2 = mysqli_fetch_assoc($resultado_conspartidos)) {
                        $partidos = $fila2['partidos'];
                    }
                    
                
                    echo "<tr>";
                        echo "<td>$Count</td>";
                        echo "<td>$nombre $apellido1</td>";
                        echo "<td>$goles</td>";
                        echo "<td>$partidos</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                    echo "</tr>";

                    $Count = $Count + 1;
                }
                ?>
            </tr>
        <table>

        <br>

        <table class="tabla-estadistica">
            <caption>ASISTENTES</caption>
            <tr>
                <th>Posición</th>
                <th>Jugador</th>
                <th>Asistencias</th>
                <th>Partidos</th>
            </tr>
            <tr>
            <?php 
                $Count = 1;
                // obtener máximos asistentes
                $maxasist = "SELECT jugadores.idJugador, jugadores.nombre, jugadores.apellido1, jugadores_dan_asistencias_partidos.cantidad FROM jugadores_dan_asistencias_partidos INNER JOIN jugadores ON jugadores_dan_asistencias_partidos.idJugador = jugadores.idJugador  WHERE jugadores_dan_asistencias_partidos.idLiga = 1 ORDER BY cantidad DESC"; 
                $resultado_maxasist = mysqli_query($link, $maxasist); 
                while ($fila = mysqli_fetch_assoc($resultado_maxasist)) {
                    $nombre = $fila['nombre'];
                    $asistencias =  $fila['cantidad'];
                    $idJugador = $fila['idJugador'];
                    $apellido1 = $fila['apellido1'];

                    $conspartidos = "SELECT COUNT(idJugador) AS partidos FROM jugadores_juegan_partidos WHERE idLiga = 1 AND idJugador = $idJugador"; 
                    $resultado_conspartidos = mysqli_query($link, $conspartidos); 
                    while ($fila2 = mysqli_fetch_assoc($resultado_conspartidos)) {
                        $partidos = $fila2['partidos'];
                    }
                    
                
                    echo "<tr>";
                        echo "<td>$Count</td>";
                        echo "<td>$nombre $apellido1</td>";
                        echo "<td>$asistencias</td>";
                        echo "<td>$partidos</td>";
                    echo "</tr>";

                    $Count = $Count + 1;
                }
                ?>
            </tr>
        <table>

        <br>

        <table class="tabla-estadistica">
            <caption>AMONESTACIONES</caption>
            <tr>
                <th>Posición</th>
                <th>Jugador</th>
                <th><img src="img/tarjeta-amarilla.png" alt="Tarjetas Amarillas" class="tarjetas"></th>
                <th><img src="img/tarjeta-doble.png" alt="Doble Tarjetas Amarillas" class="tarjetas"></th>
                <th><img src="img/tarjeta-roja.png" alt="Tarjetas Rojas" class="tarjetas"></th>
            </tr>
            <?php
                    $Count = 1;
                    // Consulta para obtener todos los jugadores con alguna tarjeta
                    $orden66 = "SELECT jugadores.idJugador, jugadores.nombre, jugadores.apellido1, jugadores_tarjetas_amarilla.cantidad AS tarjetas_amarillas, jugadores_tarjetas_roja.cantidad AS tarjetas_rojas, 
                                jugadores_doble_tarjeta_amarilla.cantidad AS dobles_tarjetas_amarillas,
                                (COALESCE(jugadores_tarjetas_amarilla.cantidad, 0) + 
                                    COALESCE(jugadores_tarjetas_roja.cantidad, 0) + 
                                    COALESCE(jugadores_doble_tarjeta_amarilla.cantidad, 0)) AS total
                                FROM jugadores
                                LEFT JOIN jugadores_tarjetas_amarilla  ON jugadores_tarjetas_amarilla.idJugador = jugadores.idJugador
                                LEFT JOIN jugadores_tarjetas_roja ON jugadores_tarjetas_roja.idJugador = jugadores.idJugador
                                LEFT JOIN jugadores_doble_tarjeta_amarilla ON jugadores_doble_tarjeta_amarilla.idJugador = jugadores.idJugador
                                WHERE jugadores_tarjetas_amarilla.cantidad > 0 OR jugadores_tarjetas_roja.cantidad > 0 OR jugadores_doble_tarjeta_amarilla.cantidad > 0
                                ORDER BY total DESC, tarjetas_rojas DESC, dobles_tarjetas_amarillas DESC, tarjetas_amarillas DESC";
                    $resultado66 = mysqli_query($link, $orden66);
                    while ($fila66 = mysqli_fetch_assoc($resultado66)) {
                        $idJugador = $fila66['idJugador'];
                        $nombre = $fila66['nombre'];
                        $apellido1 = $fila66['apellido1'];
                        $tarjetas_amarillas = $fila66['tarjetas_amarillas'];
                        $tarjetas_rojas = $fila66['tarjetas_rojas'];
                        $dobles_tarjetas_amarillas = $fila66['dobles_tarjetas_amarillas'];

                        echo "<tr>";
                            echo "<td>$Count</td>";
                            echo "<td>$nombre $apellido1</td>";
                            echo "<td>";
                                if ($tarjetas_amarillas == '')
                                {
                                    echo "0";
                                } else {
                                    echo "$tarjetas_amarillas";
                                }
                            echo "</td>";
                            echo "<td>";
                                if ($dobles_tarjetas_amarillas == '')
                                {
                                    echo "0";
                                } else {
                                    echo "$dobles_tarjetas_amarillas";
                                }
                            echo "</td>";
                            echo "<td>";
                                if ($tarjetas_rojas == '')
                                {
                                    echo "0";
                                } else {
                                    echo "$tarjetas_rojas";
                                }
                            echo "</td>";
                        echo "</tr>";

                        $Count = $Count + 1;
                    }
            ?>
        <table>

        <br>

        <table class="tabla-estadistica">
            <caption>MEJORES PORTEROS</caption>
            <tr>
                <th>Posición</th>
                <th>Portero</th>
                <th>Goles Contra(por partido)</th>
                <th>Goles Contra</th>
                <th>Partidos</th>
            </tr>
            <?php
                    $Count = 1;

                    // Consulta para obtener el ranking de porteros
                    $orden77 = "SELECT jugadores.idJugador, jugadores.nombre, jugadores.apellido1, COUNT(jugadores_juegan_partidos.idJugador) AS partidos
                                FROM jugadores 
                                INNER JOIN jugadores_juegan_partidos ON jugadores_juegan_partidos.idJugador = jugadores.idJugador
                                WHERE posicion = 'Portero'
                                GROUP BY jugadores.idJugador, jugadores.nombre, jugadores.apellido1";
                    $resultado77 = mysqli_query($link, $orden77);
                    while ($fila77 = mysqli_fetch_assoc($resultado77)) {
                        $idJugador = $fila77['idJugador'];
                        $nombre = $fila77['nombre'];
                        $apellido1 = $fila77['apellido1'];

                        // Consulta para ver los partidos que ha jugado un jugador
                        $orden88 = "SELECT COUNT(idJugador) AS partidos FROM jugadores_juegan_partidos WHERE idJugador = $idJugador";
                        $resultado88 = mysqli_query($link, $orden88);
                        while ($fila88 = mysqli_fetch_assoc($resultado88)) {
                            $partidos = $fila88['partidos'];
                        }
                        
                        // Consulta para ver los partidos que ha jugado un jugador
                        $orden99 = "SELECT idJugador, SUM(cantidad) AS golesContra
                                    FROM porteros_goles_contra 
                                    WHERE idJugador = $idJugador";
                        $resultado99 = mysqli_query($link, $orden99);
                        while ($fila99 = mysqli_fetch_assoc($resultado99)) {
                            $golesContra = $fila99['golesContra'];
                        }

                        $avgGolesContra = $golesContra / $partidos;
                        $avgGolesContra = number_format($avgGolesContra, 2);

                        echo "<tr>";
                            echo "<td>$Count</td>";
                            echo "<td>$nombre $apellido1</td>";
                            echo "<td>$avgGolesContra</td>";
                            echo "<td>$golesContra</td>";
                            echo "<td>$partidos</td>";
                        echo "</tr>";

                        $Count = $Count + 1;
                    }
            ?>
        <table>
    </div>
</body>
</html>