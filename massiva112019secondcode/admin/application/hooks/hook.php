<?php

class Hook {

    public function seguridad() {
        $CI = &get_instance();
        $CI->load->helper('session');
        if (!check_id()) {
            //en caso de que no haya iniciado sesion
            $data['mensaje'] = 'Para ingresar a este sitio se debe iniciar sesión';
            $this->_response_error($CI, $data, 401);
        } else {
            //en caso de que tenga sesion se checa si tiene permisos
            $tipo_usuario_session = $_SESSION[$CI->config->item('project_name')]['tipo'];
            $tipo_usuario_config = $CI->config->item('tipo_usuario');
            if (is_array($tipo_usuario_config)) {
                $usuario_encontrado = FALSE;
                foreach ($tipo_usuario_config as $tipo_usuario) {
                    if ($tipo_usuario === $tipo_usuario_session) {
                        $usuario_encontrado = TRUE;
                        break;
                    }
                }
                if (!$usuario_encontrado) {
                    $data['mensaje'] = 'NO tienes permisos para ingresar a este sitio';
                    $this->_response_error($CI, $data, 403);
                }
            } else {
                if ($tipo_usuario_config !== $tipo_usuario_session) {
                    $data['mensaje'] = 'NO tienes permisos para ingresar a este sitio';
                    $this->_response_error($CI, $data, 403);
                }
            }
            //en caso contrario continua
        }
    }

    private function _response_error($CI, $data_error, $status) {
        $data_error['home_url'] = $CI->config->item('home_url');
        if ($CI->config->item('rest_default_format') === NULL) {
            //en caso de que este accediendo directamente desde el navegador
            http_response_code($status);
            exit($CI->load->view('redirect_view', $data_error, TRUE));
        } else {
            //en caso de que sea peticion rest
            if ($status === 401) {
                $CI->response($data_error, REST_Controller::HTTP_UNAUTHORIZED);
            } else {
                $CI->response($data_error, REST_Controller::HTTP_FORBIDDEN);
            }
        }
        exit();
    }

    private function _element_in_array($search, $element, $array) {
        $finded = false;
        foreach ($array as $value) {
            if ($value[$element] == $search) {
                $finded = true;
            }
        }
        return $finded;
    }

}
