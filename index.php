<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/area.controlador.php";

require_once "modelos/area.modelo.php";

$rutas =  new ControladorRutas();
$rutas -> index();