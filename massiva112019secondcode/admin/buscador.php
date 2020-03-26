<?php

$ficheros_models = scandir('application/models');
$ficheros_controllers = scandir('application/controllers/api');
$ficheros_services = scandir('public_html/js/services');
$ficheros_controllers_js = scandir('public_html/js/controllers');
$arreglo_de_modelos_y_metodos_existentes = crear_arreglo_de_metodos_y_modelos($ficheros_models, 'application/models/', 'function', 9, '(');
$arreglo_de_metodos_privados = crear_arreglo_de_metodos_y_modelos($ficheros_controllers, 'application/controllers/api/', 'private function', 16, '(');
$arreglo_de_metodos_publicos_controllers = crear_arreglo_de_metodos_get_or_post($ficheros_controllers, 'application/controllers/api/', 'public function', 16, '(');
$arreglo_de_servicios = crear_arreglo_de_servicios($ficheros_services, 'public_html/js/services/', "url: api_url + '", 16, '/');
$arreglo_de_controllers_js = crear_arreglo_de_controllers_js($ficheros_controllers_js, 'public_html/js/controllers/', ').then', 6, '(');
$arreglo_de_servicios_js = crear_arreglo_de_servicios_js($ficheros_services, 'public_html/js/services/', 9, "'");

function crear_arreglo_de_metodos_y_modelos($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundario = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.php', 0);
        $leer_fichero = leer_fichero($ruta_path, $ficheros[$k]);
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $funcion = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 0);
                $array_secundario[$funcion] = array('veces_ocupadas' => 0);
            }
        }
        $array_principal = fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario);
    }
    return $array_principal;
}

function crear_arreglo_de_metodos_get_or_post($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundario = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.php', 0);
        $leer_fichero = leer_fichero($ruta_path, $ficheros[$k]);
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $funcion_con_get_o_post = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 0);
                $funcion = quitar_get_o_post_metodo($funcion_con_get_o_post);
                $array_secundario[$funcion] = array('veces_ocupadas' => 0);
            }
        }
        $array_principal = fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario);
    }
    return $array_principal;
}

function crear_arreglo_de_controllers_js($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundario = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $leer_fichero = leer_fichero($ruta_path, $ficheros[$k]);
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar_servicio = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar_servicio !== 0) {
                $nombre_funcion_servicio = read_linea_por_linea($linea, '.', 1, $delimitador, 0);
                $nombre_funcion_servicio_explode = explode('.' . $nombre_funcion_servicio, $linea);
                $nombre_servicio = trim($nombre_funcion_servicio_explode[0]);
                $array_secundario[$nombre_servicio][$nombre_funcion_servicio] = array('veces_ocupadas' => 0);
            }
        }
        $array_principal = fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario);
    }
    return $array_principal;
}

function crear_arreglo_de_servicios_js($ficheros, $ruta_path, $palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundario = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $leer_fichero = leer_fichero($ruta_path, $ficheros[$k]);
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar_servicio = substr_count($linea, 'service(');
            if ($linea_con_palabra_a_buscar_servicio !== 0) {
                $nombre_servicio = read_linea_por_linea($linea, 'service(', 9, $delimitador, 0);
            }
            $linea_con_palabra_a_buscar = substr_count($linea, 'this.');
            if ($linea_con_palabra_a_buscar !== 0) {
                $nombre_funcion = read_linea_por_linea($linea, 'this.', 5, '=', 0);
                $array_secundario[$nombre_servicio][$nombre_funcion] = array('veces_ocupadas' => 0);
            }
        }
        $array_principal = fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario);
//        echo "<pre>";
//        print_r($array_principal);
//        echo "</pre>";
    }
    return $array_principal;
}

function crear_arreglo_de_servicios($ficheros, $ruta_path, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador) {
    $array_principal = array();
    for ($k = 2; $k < count($ficheros); $k++) {
        $array_secundario = array();
        $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros[$k], '.js', 0);
        $leer_fichero = leer_fichero($ruta_path, $ficheros[$k]);
        while (!feof($leer_fichero)) {
            $linea = fgets($leer_fichero);
            $linea_con_palabra_a_buscar = substr_count($linea, $palabra_a_buscar);
            if ($linea_con_palabra_a_buscar !== 0) {
                $buscar_controller = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 0);
                $buscar_metodo = read_linea_por_linea($linea, $palabra_a_buscar, $caracteres_de_palabra_a_buscar, $delimitador, 1);
                $metodo_explode = explode("'", $buscar_metodo);
                $metodo = $metodo_explode[0];
                $array_secundario[$buscar_controller][$metodo] = array('veces_ocupadas' => 0);
            }
        }
        $array_principal = fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario);
    }
    return $array_principal;
}

function leer_fichero($ruta_path, $fichero) {
    $path = $ruta_path . $fichero;
    $leer_fichero = fopen($path, 'r');
    return $leer_fichero;
}

function fichero_sin_extension($nombre_fichero_sin_extension, $array_principal, $array_secundario) {
    if ($nombre_fichero_sin_extension !== FALSE) {
        $array_principal[$nombre_fichero_sin_extension] = $array_secundario;
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

function quitar_get_o_post_metodo($funcion) {
    if (substr($funcion, -4) === '_get') {
        $nombre_funcion_explode = explode('_get', $funcion);
        return $nombre_funcion_explode[0];
    } else if (substr($funcion, -5) === '_post') {
        $nombre_funcion_explode = explode('_post', $funcion);
        return $nombre_funcion_explode[0];
    }
}

//$contador_metodos_modelos_sin_utilizar = contador_arreglos($ficheros_controllers, 'application/controllers/api/', $arreglo_de_modelos_y_metodos_existentes);
//
////for para obtener los metodos de los modelos sin utilizar. De diferentes archivos
//function contador_arreglos($ficheros, $ruta_path, $arreglo_a_comparar) {
//    for ($q = 2; $q < count($ficheros); $q++) {
//        $leer_fichero = leer_fichero($ruta_path, $ficheros[$q]);
//        while (!feof($leer_fichero)) {
//            $linea = fgets($leer_fichero);
//            $linea_con_palabra_a_buscar_servicio = substr_count($linea, '_model->');
//            if ($linea_con_palabra_a_buscar_servicio !== 0) {
//                $posicion_0 = read_linea_por_linea($linea, 'this->', 6, '->', 0);
//                $metodo_explode = explode('(', read_linea_por_linea($linea, 'this->', 6, '->', 1));
//                $posicion_1 = $metodo_explode[0];
//                if (array_key_exists($posicion_0, $arreglo_a_comparar)) {
//                    if (array_key_exists($posicion_1, $arreglo_a_comparar[$posicion_0])) {
//                        $arreglo_a_comparar[$posicion_0][$posicion_1]['veces_ocupadas'] ++;
//                    }
//                }
//            }
//        }
//    }
//    return $arreglo_a_comparar;
//}
//for para obtener los metodos de los modelos sin utilizar. De diferentes archivos
for ($q = 2; $q < count($ficheros_controllers); $q++) {
    $path = 'application/controllers/api/' . $ficheros_controllers[$q];
    $read_file = fopen($path, "r");
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        if (strpos($linea, '_model->') !== FALSE) {
            $modelo_con_metodo = substr($linea, (strpos($linea, 'this->')) + 6);
            $modelo_metodo_explode = explode('->', $modelo_con_metodo);
            $modelo = $modelo_metodo_explode[0];
            $metodo_explode = explode('(', $modelo_metodo_explode[1]);
            $metodo = $metodo_explode[0];
            if (array_key_exists($modelo, $arreglo_de_modelos_y_metodos_existentes)) {
                if (array_key_exists($metodo, $arreglo_de_modelos_y_metodos_existentes[$modelo])) {
                    $arreglo_de_modelos_y_metodos_existentes[$modelo][$metodo]['veces_ocupadas'] ++;
                }
            }
        }
    }
}


//for para obtener los metodos privados de los controllers sin utilizar. En el mismo archivo
for ($k = 2; $k < count($ficheros_controllers); $k++) {
    $nombre_modelo_sin_extension = obtener_nombre_fichero($ficheros_controllers[$k], '.php', 0);
    $path = 'application/controllers/api/' . $ficheros_controllers[$k];
    $read_file = fopen($path, 'r');
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        if (strpos($linea, 'this->_') !== FALSE) {
            $modelo_con_metodo = substr($linea, (strpos($linea, 'this->')) + 6);
            $modelo_metodo_explode = explode('(', $modelo_con_metodo);
            $modelo = $modelo_metodo_explode[0];
            if (array_key_exists($nombre_modelo_sin_extension, $arreglo_de_metodos_privados)) {
                if (array_key_exists($modelo, $arreglo_de_metodos_privados[$nombre_modelo_sin_extension])) {
                    $arreglo_de_metodos_privados[$nombre_modelo_sin_extension][$modelo]['veces_ocupadas'] ++;
                }
            }
        }
    }
}


for ($q = 2; $q < count($ficheros_services); $q++) {
    $path = 'public_html/js/services/' . $ficheros_services[$q];
    $read_file = fopen($path, 'r');
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        $linea_con_palabra_a_buscar = substr_count($linea, "url: api_url + '");
        if ($linea_con_palabra_a_buscar !== 0) {
            $controller = read_linea_por_linea($linea, "url: api_url + '", 16, '/', 0);
            $buscar_metodo = read_linea_por_linea($linea, "url: api_url + '", 16, '/', 1);
            $metodo_explode = explode("'", $buscar_metodo);
            $metodo = $metodo_explode[0];
            if (array_key_exists($controller, $arreglo_de_metodos_publicos_controllers)) {
                if (array_key_exists($metodo, $arreglo_de_metodos_publicos_controllers[$controller])) {
                    $arreglo_de_metodos_publicos_controllers[$controller][$metodo]['veces_ocupadas'] ++;
                }
            }
        }
    }
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
            for ($k = 2; $k < count($ficheros_services); $k++) {
                $nombre_fichero_sin_extension = obtener_nombre_fichero($ficheros_services[$k], '.js', 0);
                if (array_key_exists($nombre_servicio, $arreglo_de_servicios_js[$nombre_fichero_sin_extension])) {
                    if (array_key_exists($nombre_funcion_servicio, $arreglo_de_servicios_js[$nombre_fichero_sin_extension][$nombre_servicio])) {
                        $arreglo_de_servicios_js[$nombre_fichero_sin_extension][$nombre_servicio][$nombre_funcion_servicio]['veces_ocupadas'] ++;
                    }
                }
            }
        }
    }
//    exit();
}
//
//
// Introduce las variables para saber si se están utilizando los métodos, funciones, servicios, etc. 
// Para saber los modelos utilizados en el controlador -----> $arreglo_de_modelos_y_metodos_existentes
// Para saber los métodos privados utilizados en el controlador -----> $arreglo_de_metodos_privados
// Para saber los métodos publicos (get y post) del controlador que se utilizan en los servicios ----> $arreglo_de_metodos_publicos_controllers
// Para saber los servicios utilizados ------> $arreglo_de_servicios_js

echo "<pre>";
print_r($arreglo_de_controllers_js);
echo "</pre>";
