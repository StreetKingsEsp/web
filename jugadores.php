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
    
    <h3>PORTEROS</h3>
    <?php
        // Consulta para obtener todos los porteros de la liga
        $orden1 = "SELECT jugadores.nombre, jugadores.apellido1, jugadores.posicion, jugadores.dorsal, jugadores.idEquipo, equipos.nombre AS nombreEquipo, equipos.escudo FROM JUGADORES INNER JOIN EQUIPOS ON jugadores.idEquipo = equipos.idEquipo WHERE posicion='Portero' ORDER BY dorsal ASC";
        $resultado1 = mysqli_query($link, $orden1);
    ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Equipo</th>
        </tr>
        <?php 
            while ($fila = mysqli_fetch_assoc($resultado1)) {
                $nombre = $fila['nombre']; 
                $apellido1 = $fila['apellido1']; 
                $dorsal = $fila['dorsal']; 
                $idEquipo = $fila['idEquipo']; 
                $equipo = $fila['nombreEquipo']; 
                $escudo = $fila['escudo'];
                echo "<tr class='escudo-jugadores'>";
                    echo "<td>";
                        echo "$dorsal. $nombre $apellido1";
                    echo "</td>";
                    echo "<td>";
                        echo "$equipo"; 
                    echo "</td>";
                    echo "<td>";
                        echo "<img src='img/$escudo' alt='Escudo $equipo'>"; 
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table><br>

    <h3>CIERRES</h3>
    <?php
        // Consulta para obtener todos los cierres de la liga
        $orden2 = "SELECT jugadores.nombre, jugadores.apellido1, jugadores.posicion, jugadores.dorsal, jugadores.idEquipo, equipos.nombre AS nombreEquipo, equipos.escudo FROM JUGADORES INNER JOIN EQUIPOS ON jugadores.idEquipo = equipos.idEquipo WHERE posicion='Cierre' ORDER BY dorsal ASC";
        $resultado2 = mysqli_query($link, $orden2);
    ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Equipo</th>
        </tr>
        <?php 
            while ($fila = mysqli_fetch_assoc($resultado2)) {
                $nombre = $fila['nombre']; 
                $apellido1 = $fila['apellido1']; 
                $dorsal = $fila['dorsal']; 
                $idEquipo = $fila['idEquipo']; 
                $equipo = $fila['nombreEquipo'];  
                $escudo = $fila['escudo'];
                echo "<tr class='escudo-jugadores'>";
                    echo "<td>";
                        echo "$dorsal. $nombre $apellido1";
                    echo "</td>";
                    echo "<td>";
                        echo "$equipo"; 
                    echo "</td>";
                    echo "<td>";
                        echo "<img src='img/$escudo' alt='Escudo $equipo'>"; 
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table><br>

    <h3>ALAS</h3>
    <?php
        // Consulta para obtener todos los alas de la liga
        $orden3 = "SELECT jugadores.nombre, jugadores.apellido1, jugadores.posicion, jugadores.dorsal, jugadores.idEquipo, equipos.nombre AS nombreEquipo, equipos.escudo FROM JUGADORES INNER JOIN EQUIPOS ON jugadores.idEquipo = equipos.idEquipo WHERE posicion='Ala' ORDER BY dorsal ASC";
        $resultado3 = mysqli_query($link, $orden3);
    ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Equipo</th>
        </tr>
        <?php 
            while ($fila = mysqli_fetch_assoc($resultado3)) {
                $nombre = $fila['nombre']; 
                $apellido1 = $fila['apellido1']; 
                $dorsal = $fila['dorsal']; 
                $idEquipo = $fila['idEquipo']; 
                $equipo = $fila['nombreEquipo'];  
                $escudo = $fila['escudo'];
                echo "<tr class='escudo-jugadores'>";
                    echo "<td>";
                        echo "$dorsal. $nombre $apellido1";
                    echo "</td>";
                    echo "<td>";
                        echo "$equipo"; 
                    echo "</td>";
                    echo "<td>";
                        echo "<img src='img/$escudo' alt='Escudo $equipo'>"; 
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table><br>

    <h3>PÍVOTS</h3>
    <?php
        // Consulta para obtener todos los pívots de la liga
        $orden4 = "SELECT jugadores.nombre, jugadores.apellido1, jugadores.posicion, jugadores.dorsal, jugadores.idEquipo, equipos.nombre AS nombreEquipo, equipos.escudo FROM JUGADORES INNER JOIN EQUIPOS ON jugadores.idEquipo = equipos.idEquipo WHERE posicion='Pívot' ORDER BY dorsal ASC";
        $resultado4 = mysqli_query($link, $orden4);
    ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Equipo</th>
        </tr>
        <?php 
            while ($fila = mysqli_fetch_assoc($resultado4)) {
                $nombre = $fila['nombre']; 
                $apellido1 = $fila['apellido1']; 
                $dorsal = $fila['dorsal']; 
                $idEquipo = $fila['idEquipo']; 
                $equipo = $fila['nombreEquipo'];  
                $escudo = $fila['escudo'];
                echo "<tr class='escudo-jugadores'>";
                    echo "<td>";
                        echo "$dorsal. $nombre $apellido1";
                    echo "</td>";
                    echo "<td>";
                        echo "$equipo"; 
                    echo "</td>";
                    echo "<td>";
                        echo "<img src='img/$escudo' alt='Escudo $equipo'>"; 
                    echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>