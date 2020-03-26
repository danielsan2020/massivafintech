<?php

$ficheros_services = scandir("public_html/js/services");
$ficheros_controllers = scandir("application/controllers/api");
$arreglo_de_metodos_publicas_controllers = crear_arreglo_de_metodos_get_or_post($ficheros_controllers, 'application/controllers/api/', 'public function', 16, '(');
$arreglo_de_servicios = crear_arreglo_de_servicios($ficheros_services, 'public_html/js/services/', "url: api_url + '", 16, '/');

//


function crear_arreglo_de_metodos_get_or_post($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundadrio = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.php', 0);
        $path = $ruta_path . $ficheros[$k];
        $leer_fichero = fopen($path, "r");
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $funcion_con_get_o_post = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 0);
                $funcion = quitar_get_o_post_metodo($funcion_con_get_o_post);
                $array_secundadrio[$funcion] = array('veces_ocupadas' => 0);
            }
        }
        if ($nombre_fichero_sin_extension !== FALSE) {
            $array_principal[$nombre_fichero_sin_extension] = $array_secundadrio;
        }
    }
    return $array_principal;
}

function quitar_get_o_post_metodo($funcion) {
    if (substr($funcion, -4) === '_get') {
        $nombre_funcion_explode = explode('_get', $funcion);
        return $nombre_funcion_explode[0];
    } else if (substr($funcion, -5) === '_post') {
        $nombre_funcion_explode = explode('_post', $funcion);
        return $nombre_funcion_explode[0];
    }
}

function obtener_nombre_fichero($nombre_modelo, $extension, $posicion_array) {
    $numero_caracteres_extension = (int) (strlen($extension));
    if (trim(substr($nombre_modelo, -$numero_caracteres_extension)) === $extension) {
        $nombre_fichero = explode($extension, $nombre_modelo);
        return trim(strtolower($nombre_fichero[$posicion_array]));
    } else {
        return FALSE;
    }
}

function read_linea_por_linea($linea, $substring, $numero_caracteres_substring, $delimitador, $posicion_array) {
    $posicion = strpos($linea, $substring) + $numero_caracteres_substring;
    $funcion = substr($linea, $posicion);
    $funcion_explode = explode($delimitador, $funcion);
    return trim($funcion_explode[$posicion_array]);
}

function crear_arreglo_de_servicios($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundadrio = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $path = $ruta_path . $ficheros[$k];
        $leer_fichero = fopen($path, "r");
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $buscar_controller = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 0);
                $buscar_metodo = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 1);
                $metodo_explode = explode("'", $buscar_metodo);
                $metodo = $metodo_explode[0];
                $array_secundadrio[$buscar_controller][$metodo] = array('veces_ocupadas' => 0);
            }
        }
        if ($nombre_fichero_sin_extension !== FALSE) {
            $array_principal[$nombre_fichero_sin_extension] = $array_secundadrio;
        }
    }
    return $array_principal;
}

for ($q = 2; $q < count($ficheros_services); $q++) {
    $path = 'public_html/js/services/' . $ficheros_services[$q];
    $read_file = fopen($path, "r");
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        $linea_con_palabra_a_buscar = substr_count($linea, "url: api_url + '");
        if ($linea_con_palabra_a_buscar !== 0) {
            $controller = read_linea_por_linea($linea, "url: api_url + '", 16, '/', 0);
            $buscar_metodo = read_linea_por_linea($linea, "url: api_url + '", 16, '/', 1);
            $metodo_explode = explode("'", $buscar_metodo);
            $metodo = $metodo_explode[0];
            if (array_key_exists($controller, $arreglo_de_metodos_publicas_controllers)) {
                if (array_key_exists($metodo, $arreglo_de_metodos_publicas_controllers[$controller])) {
                    $arreglo_de_metodos_publicas_controllers[$controller][$metodo]['veces_ocupadas'] ++;
                }
            }
        }
    }
}




//
echo "<pre>";
print_r($arreglo_de_metodos_publicas_controllers);
echo "</pre>";
