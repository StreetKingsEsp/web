<!DOCTYPE html>
<html lang="es">
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
        <a href="#equipos">EQUIPOS</a>
        <a href="#jugadores">JUGADORES</a>
        <a href="#ligas">LIGAS</a>
        <a href="#torneos">TORNEOS</a>
        <a href="#clas-liga">CLASIFICACION DE LIGA</a>
        <a href="#partidos">PARTIDOS</a>
        <a href="#eq-en-partidos">EQUIPOS EN PARTIDOS</a>
        <a href="#goles">GOLES</a>
        <a href="#asist">ASISTENCIAS</a>
        <a href="#part-jugados">PARTIDOS JUGADOS</a>
        <a href="#tar-am">TARJETAS AMARILLAS</a>
        <a href="#doble-tar-am">DOBLE TARJETAS AMARILLAS</a>
        <a href="#tar-roja">TARJETAS ROJAS</a>
        <a href="#goles-contra">PORTEROS GOLES EN CONTRA</a>

        <h2 id="equipos">EQUIPOS</h2>
            <h3>AÑADIR EQUIPO</h3>
            <form action="bd/añadir-equipo.php" method="get">
                Nombre equipo: <input type="text" name="nombre-equipo" required> <br>
                Color equipación: <input type="text" name="color-equipacion" required> <br>
                Escudo equipo: <input type="file" name="escudo-equipo" required> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR EQUIPO</h3>
            <h3>BORRAR EQUIPO</h3>
            
        <hr>

        <h2 id="jugadores">JUGADORES</h2>
            <h3>AÑADIR JUGADOR</h3>
            <form action="bd/añadir-jugador.php" method="get">
                Nombre jugador: <input type="text" name="nombre-jugador" required> <br>
                Apellido1 jugador: <input type="text" name="apellido1-jugador" required> <br>
                Dorsal jugador: <input type="number" name="dorsal-jugador" required> <br>
                Posición jugador: <input type="text" name="posicion-jugador" required> <br>
                Foto jugador: <input type="file" name="foto-jugador" required> <br>
                Equipo jugador: <select name="equipo-jugador" required>
                                    <option></option>
                                    <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idEquipo, nombre FROM EQUIPOS";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idEquipo = $fila1['idEquipo']; 
                                        $nombre = $fila1['nombre']; 
                                        echo "<option value='$idEquipo'>$idEquipo. $nombre</option>";
                                    }
                                    ?>
                                </select> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR JUGADOR</h3>
            <h3>BORRAR JUGADOR</h3>
        
        <hr>

        <h2 id="ligas">LIGAS</h2>
            <h3>AÑADIR LIGAS</h3>
            <form action="bd/añadir-liga.php" method="get">
                <input type="submit" value="Añadir +1">
            </form>
            <h3>MODIFICAR LIGAS</h3>
            <h3>BORRAR LIGAS</h3>
        
        <hr>

        <h2 id="torneos">TORNEOS</h2>
            <h3>AÑADIR TORNEOS</h3>
            <form action="bd/añadir-torneo.php" method="get">
                <input type="submit" value="Añadir +1">
            </form>
            <h3>MODIFICAR TORNEOS</h3>
            <h3>BORRAR TORNEOS</h3>
        
        <hr>

        <h2 id="clas-liga">CLASIFICACION DE LIGA</h2>
            <h3>AÑADIR AÑADIR EQUIPO A LA CLASIFICACIÓN DE UNA LIGA</h3>
            <form action="bd/clasificacion-liga.php" method="get">
                ID equipo: <select name="idEquipo" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idEquipo, nombre FROM EQUIPOS";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idEquipo = $fila1['idEquipo']; 
                                        $nombre = $fila1['nombre']; 
                                        echo "<option value='$idEquipo'>$idEquipo. $nombre</option>";
                                    }
                                ?>
                            </select> <br>
                ID liga: <select name="idLiga" required>
                <option></option>
                                <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idLiga FROM LIGAS WHERE idLiga > 0";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idLiga = $fila1['idLiga']; 
                                        echo "<option value='$idLiga'>$idLiga</option>";
                                    }
                                ?>
                        </select> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR EQUIPO DE LA CLASIFICACIÓN DE UNA LIGA</h3>
            <h3>BORRAR EQUIPO DE LA CLASIFICACIÓN DE UNA LIGA</h3>
        
        <hr>

        <h2 id="partidos">PARTIDOS</h2> 
            <h3>AÑADIR PARTIDOS</h3>
            <form action="bd/añadir-partido.php" method="get">
                ID liga: <select name="idLiga" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idLiga FROM LIGAS WHERE idLiga > 0";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idLiga = $fila1['idLiga']; 
                                        echo "<option value='$idLiga'>$idLiga</option>";
                                    }
                                ?>
                            </select> <br>
                <!-- ID torneo: <select required></select> <br> -->
                ID jornada: <select name="idJornada" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todas las jornadas
                                    $orden1 = "SELECT idJornada, numJornada FROM JORNADAS WHERE idLiga = 1";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJornada = $fila1['idJornada']; 
                                        $numJornada = $fila1['numJornada']; 
                                        echo "<option value='$idJornada'>$numJornada</option>";
                                    }
                                ?>
                            </select> <br>
                Jugado: <select name="jugado" required>
                            <option></option>
                            <option>Si</option>
                            <option>No</option>
                        </select> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR PARTIDOS</h3>
            <h3>BORRAR PARTIDOS</h3>
        
        <hr>

        <h2 id="eq-en-partidos">EQUIPOS EN PARTIDOS</h2>
            <h3>AÑADIR EQUIPO AL PARTIDO</h3>
            <form action="bd/añadir-equipo-partido.php" method="get">
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                ID equipo1: <select name="idEquipo1" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idEquipo, nombre FROM EQUIPOS";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idEquipo = $fila1['idEquipo']; 
                                        $nombre = $fila1['nombre']; 
                                        echo "<option value='$idEquipo'>$idEquipo. $nombre</option>";
                                    }
                                ?>
                            </select> <br>
                ID equipo2: <select name="idEquipo2" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los equipos
                                    $orden1 = "SELECT idEquipo, nombre FROM EQUIPOS";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idEquipo = $fila1['idEquipo']; 
                                        $nombre = $fila1['nombre']; 
                                        echo "<option value='$idEquipo'>$idEquipo. $nombre</option>";
                                    }
                                ?>
                            </select> <br>
                Goles equipo Local: <input type="number" name="golesLocales" required> <br>
                Goles equipo Visitante: <input type="number" name="golesVisitantes" required> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR EQUIPO DEL PARTIDO</h3>
            <h3>BORRAR EQUIPO DEL PARTIDO</h3>

        <hr>

        <h2 id="goles">GOLES</h2>
            <h3>AÑADIR GOLES</h3>
            <form action="bd/añadir-goles-jugador.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad" required> <br>
                Tipo de gol: <select name="tipo" required>
                                <option>Normal</option>
                                <option>Penalti</option>
                                <option>Doble Penalti</option>
                            </select> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR GOLES</h3>
            <h3>BORRAR GOLES</h3>

        <hr>

        <h2 id="asist">ASISTENCIAS</h2>
            <h3>AÑADIR ASISTENCIAS</h3>
            <form action="bd/añadir-asistencia.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad" required> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR ASISTENCIAS</h3>
            <h3>BORRAR ASISTENCIAS</h3>

        <hr>

        <h2 id="part-jugados">PARTIDOS JUGADOS</h2>
            <h3>AÑADIR PARTIDOS JUGADOS</h3>
            <form action="bd/añadir-partidos-jugados.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR PARTIDOS JUGADOS</h3>
            <h3>BORRAR PARTIDOS JUGADOS</h3>

        <hr>

        <h2 id="tar-am">TARJETAS AMARILLAS</h2>
            <h3>AÑADIR TARJETAS AMARILLAS</h3>
            <form action="bd/añadir-tar-amarilla.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad"> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR TARJETAS AMARILLAS</h3>
            <h3>BORRAR TARJETAS AMARILLAS</h3>

        <hr>

        <h2 id="doble-tar-am">DOBLES TARJETAS AMARILLAS</h2>
            <h3>AÑADIR DOBLES TARJETAS AMARILLAS</h3>
            <form action="bd/añadir-doble-tar-amarilla.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad"> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR DOBLES TARJETAS AMARILLAS</h3>
            <h3>BORRAR DOBLES TARJETAS AMARILLAS</h3>

        <hr>

        <h2 id="tar-roja">TARJETAS ROJAS</h2>
            <h3>AÑADIR TARJETAS ROJAS</h3>
            <form action="bd/añadir-tar-roja.php" method="get">
                ID jugador: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad"> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR TARJETAS ROJAS</h3>
            <h3>BORRAR TARJETAS ROJAS</h3>

        <hr>

        <h2 id="goles-contra">GOLES EN CONTRA AL PORTERO</h2>
            <h3>AÑADIR GOLES EN CONTRA AL PORTERO</h3>
            <form action="bd/añadir-goles-contra-por.php" method="get">
                ID portero: <select name="idJugador" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los jugadores
                                    $orden1 = "SELECT idJugador, nombre, apellido1 FROM JUGADORES WHERE posicion = 'Portero'";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idJugador = $fila1['idJugador']; 
                                        $nombre = $fila1['nombre'];
                                        $apellido1 = $fila1['apellido1']; 
                                        echo "<option value='$idJugador'>$idJugador. $nombre $apellido1</option>";
                                    }
                                ?>
                            </select> <br>
                ID partido: <select name="idPartido" required>
                                <option></option>
                                <?php
                                    // Consulta para obtener todos los partidos
                                    $orden1 = "SELECT idPartido FROM PARTIDOS WHERE idPartido";
                                    $resultado1 = mysqli_query($link, $orden1);
                                    while ($fila1 = mysqli_fetch_assoc($resultado1)) {
                                        $idPartido = $fila1['idPartido']; 
                                        echo "<option value='$idPartido'>$idPartido</option>";
                                    }
                                ?>
                            </select> <br>
                Cantidad: <input type="number" name="cantidad"> <br>
                <input type="submit" value="Envíar">
            </form>
            <h3>MODIFICAR GOLES EN CONTRA AL PORTERO</h3>
            <h3>BORRAR GOLES EN CONTRA AL PORTERO</h3>
    </body>
</style>
</html>