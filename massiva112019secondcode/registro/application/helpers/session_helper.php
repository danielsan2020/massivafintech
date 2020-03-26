<?php

/**
 * Sesion
 *
 * @package Helpers
 * @subpackage
 * @category Sesion
 * @author Villegas Gonzalez Juan Carlos
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//funcion que inicializa la session 
if (!function_exists('init_session')) {

    function init_session() {
        if (ENVIRONMENT === 'production') {
            $CI = & get_instance();
            session_name($CI->config->item('session_name'));
            session_set_cookie_params(0, '/', '.' . $CI->config->item('session_domain'));
        }
        @session_start();
    }

}
//funcion que verifica si la session tiene el id del usuario 
if (!function_exists('check_id')) {

    function check_id() {
        init_session();
        $CI = & get_instance();
        return (isset($_SESSION[$CI->config->item('project_name')]['id'])) ? $_SESSION[$CI->config->item('project_name')]['id'] : FALSE;
    }

}
if (!function_exists('get_id')) {

    function get_id() {
        init_session();
        $CI = & get_instance();
        return $_SESSION[$CI->config->item('project_name')]['id'];
    }

}
if (!function_exists('get_persona_id')) {

    function get_persona_id() {
        init_session();
        $CI = & get_instance();
        return $_SESSION[$CI->config->item('project_name')]['persona_id'];
    }

}

if (!function_exists('set_persona_id')) {

    function set_persona_id($persona_id) {
        init_session();
        $CI = & get_instance();
        $_SESSION[$CI->config->item('project_name')]['persona_id'] = $persona_id;
    }

}

if (!function_exists('get_contabilidad_atrasada')) {

    function get_contabilidad_atrasada() {
        init_session();
        $CI = & get_instance();
        return $_SESSION[$CI->config->item('project_name')]['contabilidad_atrasada'];
    }

}

if (!function_exists('set_contabilidad_atrasada')) {

    function set_contabilidad_atrasada($contabilidad_atrasada) {
        init_session();
        $CI = & get_instance();
        $_SESSION[$CI->config->item('project_name')]['contabilidad_atrasada'] = $contabilidad_atrasada;
    }

}

if (!function_exists('get_tiene_efirma_vigente')) {

    function get_tiene_efirma_vigente() {
        init_session();
        $CI = & get_instance();
        return $_SESSION[$CI->config->item('project_name')]['tiene_efirma_vigente'];
    }

}

if (!function_exists('set_tiene_efirma_vigente')) {

    function set_tiene_efirma_vigente($tiene_efirma_vigente) {
        init_session();
        $CI = & get_instance();
        $_SESSION[$CI->config->item('project_name')]['tiene_efirma_vigente'] = $tiene_efirma_vigente;
    }

}
//funcion que verifica si la session tiene el usuario 
if (!function_exists('check_user')) {

    function check_user() {
        init_session();
        $CI = & get_instance();
        return (isset($_SESSION[$CI->config->item('project_name')]['username'])) ? $_SESSION[$CI->config->item('project_name')]['username'] : FALSE;
    }

}
//funcion que regresa el valor de los numeros de intentos del captcha
if (!function_exists('check_ini')) {

    function check_ini() {
        init_session();
        $CI = & get_instance();
        return (isset($_SESSION[$CI->config->item('project_name') . '_ini'])) ? $_SESSION[$CI->config->item('project_name') . '_ini'] : 0;
    }

}
//permisos para los usuarios
if (!function_exists('get_permisos_by_usuario')) {

    function get_permisos_by_usuario($id) {
        $CI = get_instance();
        $CI->load->model('permisos_model');
        $permisos = $CI->permisos_model->get_permiso($id);
        return $permisos;
    }

}
//funcion que verifica si la session tiene el usuario 
if (!function_exists('session_reopen')) {

    function session_reopen() {
        ini_set('session.use_only_cookies', false);
        ini_set('session.use_cookies', false);
        //ini_set('session.use_trans_sid', false); //May be necessary in some situations
        ini_set('session.cache_limiter', null);
        @session_start(); //Reopen the (previously closed) session for writing.
    }

}

