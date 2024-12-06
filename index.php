<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>STREET KINGS</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">

    <script>
        // Esta función se ejecuta cuando el usuario cambia el desplegable
        function cambiarLiga() {
            // Obtener el valor seleccionado del select
            var idLiga = document.getElementById("idLiga").value;
            
            // Crear un formulario con el valor seleccionado y enviarlo por POST (sin recargar la página)
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'index.php#tabla-clasificacion';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'idLiga';
            input.value = idLiga;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();  // Enviar el formulario
        }
    </script>
</head>
<?php 
    include "libreria.php"; 
    $link = conectar(); 

    // Obtener idLiga seleccionado, por defecto es 1 si no se ha seleccionado nada
    $idLigaSeleccionada = isset($_POST['idLiga']) ? $_POST['idLiga'] : 1;  // Valor por defecto es 1
?>
<body>
    <?php    
        // Incluir el menú de navegación
        include 'menu.php';
    ?>

    <div class="img-cabecera-equipos">
        <a href="equipo.php?idEquipo=2"><img src="img/samba-fc.png" alt="Logo Samba FC" class="img-cabecera-equipos-img"></a>
        <a href="equipo.php?idEquipo=3"><img src="img/galacticos-fc.png" alt="Logo Galácticos FC" class="img-cabecera-equipos-img"></a>
        <a href="equipo.php?idEquipo=1"><img src="img/tractores-fc.png" alt="Logo Tractores FC" class="img-cabecera-equipos-img"></a>
        <a href="equipo.php?idEquipo=4"><img src="img/al-kebab-fc.png" alt="Logo Al-Kebab FC" class="img-cabecera-equipos-img"></a>
    </div>

    <hr class="white"> 

    <div class="img-cabecera">
        <img src="img/ganadores-amistoso.jpg" alt="Imagen 1">
        <img src="img/jugadores-galacticos.jpg" alt="Imagen 2">
    </div>
    

    <?php
        // Asumamos que el nombre correcto de la columna es "liga_id"
        // Realizamos la consulta utilizando "liga_id" en lugar de "idLiga"
        $orden_equipos = "SELECT * FROM CLASIFICACION_LIGA WHERE idLiga = '$idLigaSeleccionada'";
        $resultado_equipos = mysqli_query($link, $orden_equipos);
    ?>

    <br>

    <table id="tabla-clasificacion">
        <caption>
            <select id="idLiga" onchange="cambiarLiga()">
                <?php
                // Consulta para obtener todos los idLigas de la tabla LIGAS
                $orden = "SELECT idLiga FROM LIGAS"; // Solo idLiga, ya que no tienes nombre en la tabla
                $resultado = mysqli_query($link, $orden);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    // Mostrar cada opción del desplegable
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Verificar si es el idLiga seleccionado para agregar el atributo "selected"
                        $selected = ($fila['idLiga'] == $idLigaSeleccionada) ? 'selected' : '';
                        echo "<option value='" . $fila['idLiga'] . "' $selected>Liga " . $fila['idLiga'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No hay ligas disponibles</option>";
                }
                ?>
            </select>
        </caption>
        <tr>
            <th>Posición</th>
            <th>Equipo</th>
            <th>Puntos</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>GF</th>
            <th>GC</th>
            <th>DG</th>
        </tr>

        <?php
        // Consulta SQL para obtener los datos de CLASIFICACION_LIGA
        $orden_clasificacion = "SELECT idEquipo, PJ, PG, PE, PP, GF, GC, DG, puntos FROM CLASIFICACION_LIGA WHERE idLiga='$idLigaSeleccionada' ORDER BY puntos DESC, DG DESC, GF DESC, GC DESC, PG DESC, PE DESC, PP DESC"; 
        $resultado_clasificacion = mysqli_query($link, $orden_clasificacion);  // Ejecutar la consulta

        if ($resultado_clasificacion && mysqli_num_rows($resultado_clasificacion) > 0) {
            $posicion = 1;  // Inicializar la posición
            // Mostrar cada fila de resultados
            while ($fila = mysqli_fetch_assoc($resultado_clasificacion)) {
                $idEquipo = $fila['idEquipo']; 
                $pj = $fila['PJ'];
                $pg = $fila['PG'];
                $pe = $fila['PE'];
                $pp = $fila['PP'];
                $gf = $fila['GF'];
                $gc = $fila['GC'];
                $dg = $fila['DG'];
                $puntos = $fila['puntos'];  

                // Obtener el nombre del equipo
                $orden_equipo = "SELECT nombre FROM equipos WHERE idEquipo = '$idEquipo'";
                $resultado_equipo = mysqli_query($link, $orden_equipo);
                if ($equipo = mysqli_fetch_assoc($resultado_equipo)) {
                    echo "<tr>";
                    echo "<td>" . $posicion++ . "º</td>";  
                    echo "<td>" . $equipo['nombre'] . "</td>";  
                    echo "<td>" . $puntos . "</td>";
                    echo "<td>" . $pj . "</td>"; 
                    echo "<td>" . $pg . "</td>"; 
                    echo "<td>" . $pe . "</td>"; 
                    echo "<td>" . $pp . "</td>"; 
                    echo "<td>" . $gf . "</td>"; 
                    echo "<td>" . $gc . "</td>"; 
                    echo "<td>" . $dg . "</td>";   
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='10'>No hay resultados disponibles.</td></tr>";
        }
        ?>
    </table>
</body>
</html>