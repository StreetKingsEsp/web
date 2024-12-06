<?php
	function conectar() {
		// $link = mysqli_connect("sql303.infinityfree.com", "if0_37778678", "Ud2yTrW2bJvei");        // remota
        // mysqli_select_db($link, "if0_37778678_street_kings");									   // remota
		$link = mysqli_connect("localhost","root","");								    	   // local
		mysqli_select_db($link, "street_kings");										           // local
		mysqli_set_charset($link, "utf8");
		return $link;
	}
?>