<?php

$ficheros_controllers = scandir("application/controllers/api");
$data_controllers = array_metodos($ficheros_controllers);

//echo "<pre>";
//print_r($data_controllers);
//echo "</pre>";

function array_metodos($ficheros_controllers) {
    $array_controller = array();
    for ($k = 2; $k < count($ficheros_controllers); $k++) {
        $array_metodos = array();
        $nombre_modelo_sin_extension = obtener_nombre_fichero($ficheros_controllers[$k], '.php', 0);
        $path = "application/controllers/api/" . $ficheros_controllers[$k];
        $read_file = fopen($path, "r");
        while (!feof($read_file)) {
            $linea = fgets($read_file);
            $linea_con_private_function = substr_count($linea, "private function");
            if ($linea_con_private_function !== 0) {
                $funcion = read_linea_por_linea($linea, "private function", 16, "(", 0);
                $array_metodos[$funcion] = array('veces_ocupadas' => 0);
            }
        }
        if ($nombre_modelo_sin_extension !== FALSE) {
            $array_controller[$nombre_modelo_sin_extension] = $array_metodos;
        }
    }
    return $array_controller;
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

for ($k = 2; $k < count($ficheros_controllers); $k++) {
    $nombre_modelo_sin_extension = obtener_nombre_fichero($ficheros_controllers[$k], '.php', 0);
    $path = "application/controllers/api/" . $ficheros_controllers[$k];
    $read_file = fopen($path, "r");
    while (!feof($read_file)) {
        $linea = fgets($read_file);
        $linea_con_private_function = substr_count($linea, "private function");
        if (strpos($linea, "this->_") !== FALSE) {
            $modelo_con_metodo = substr($linea, (strpos($linea, "this->")) + 6);
            $modelo_metodo_explode = explode("(", $modelo_con_metodo);
            $modelo = $modelo_metodo_explode[0];
            if (array_key_exists($nombre_modelo_sin_extension, $data_controllers)) {
                if (array_key_exists($modelo, $data_controllers[$nombre_modelo_sin_extension])) {
                    $data_controllers[$nombre_modelo_sin_extension][$modelo]['veces_ocupadas'] ++;
                }
            }
        }
    }
}

echo "<pre>";
print_r($data_controllers);
echo "</pre>";
