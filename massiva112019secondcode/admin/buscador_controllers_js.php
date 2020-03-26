<?php

$ficheros_services_js = scandir('public_html/js/services');
$ficheros_controllers_js = scandir('public_html/js/controllers');
$arreglo_de_servicios = crear_arreglo_de_metodos($ficheros_services_js, 'public_html/js/services/', 'this.', 9, "'");
$arreglo_de_controllers_js = crear_arreglo_de_controllers_js($ficheros_controllers_js, 'public_html/js/controllers/', ').then', 6, '(');

function crear_arreglo_de_controllers_js($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundadrio = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $path = $ruta_path . $ficheros[$k];
        $leer_fichero = fopen($path, "r");
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar_servicio = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar_servicio !== 0) {
                $nombre_funcion_servicio = read_linea_por_linea($linea, '.', 1, $delimitador, 0);
                $servicio = '.' . $nombre_funcion_servicio;
                $nombre_funcion_servicio_explode = explode($servicio, $linea);
                $nombre_servicio = trim($nombre_funcion_servicio_explode[0]);
                $array_secundadrio[$nombre_servicio][$nombre_funcion_servicio] = array('veces_ocupadas' => 0);
            }
            if ($nombre_fichero_sin_extension !== FALSE) {
                $array_principal[$nombre_fichero_sin_extension] = $array_secundadrio;
            }
        }
    }
    return $array_principal;
}

function crear_arreglo_de_metodos($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundadrio = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $path = $ruta_path . $ficheros[$k];
        $leer_fichero = fopen($path, "r");
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar_servicio = substr_count($linea, 'service(');
            if ($linea_con_palabra_a_buscar_servicio !== 0) {
                $nombre_servicio = read_linea_por_linea($linea, 'service(', $caracteres_de_palabra_a_buscar, $delimitador, 0);
            }
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $nombre_funcion = read_linea_por_linea($linea, 'this.', 5, '=', 0);
                $array_secundadrio[$nombre_servicio][$nombre_funcion] = array('veces_ocupadas' => 0);
            }
        }
        if ($nombre_fichero_sin_extension !== FALSE) {
            $array_principal[$nombre_fichero_sin_extension] = $array_secundadrio;
        }
    }
    return $array_principal;
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

for ($q = 2; $q < count($ficheros_controllers_js); $q++) {
    $path = 'public_html/js/controllers/' . $ficheros_controllers_js[$q];
    $read_file = fopen($path, 'r');
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        $linea_con_palabra_a_buscar_servicio = substr_count($linea, ').then');
        if ($linea_con_palabra_a_buscar_servicio !== 0) {
            $nombre_funcion_servicio = read_linea_por_linea($linea, '.', 1, '(', 0);

            $servicio = '.' . $nombre_funcion_servicio;
            $nombre_funcion_servicio_explode = explode($servicio, $linea);
            $nombre_servicio = trim($nombre_funcion_servicio_explode[0]);
            for ($k = 2; $k < count($ficheros_services_js); $k++) {
                $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros_services_js[$k], '.js', 0);
                if (array_key_exists($nombre_servicio, $arreglo_de_servicios[$nombre_fichero_sin_extension])) {
                    if (array_key_exists($nombre_funcion_servicio, $arreglo_de_servicios[$nombre_fichero_sin_extension][$nombre_servicio])) {
                        $arreglo_de_servicios[$nombre_fichero_sin_extension][$nombre_servicio][$nombre_funcion_servicio]['veces_ocupadas'] ++;
                    }
                }
            }
        }
    }
//    exit();
}
//
echo "<pre>";
print_r($arreglo_de_servicios);
echo "</pre>";
