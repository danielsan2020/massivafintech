<?php

/**
 * Params helper
 *
 * @package Helpers
 * @subpackage
 * @category Validation
 * @author Villegas Gonzalez Juan Carlos
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('params_validation_errors')) {

    /**
     * Validation Error String
     *
     * Returns all the errors associated with a form submission. This is a helper
     * function for the form validation class.
     *
     * @param	string
     * @param	string
     * @return	string
     */
    function params_validation_errors($prefix = '', $suffix = '') {
        if (FALSE === ($OBJ = & _get_params_validation_object())) {
            return '';
        }
        return $OBJ->error_string($prefix, $suffix);
    }

}
if (!function_exists('_get_params_validation_object')) {

    /**
     * Validation Object
     *
     * Determines what the form validation class was instantiated as, fetches
     * the object and returns it.
     *
     * @return	mixed
     */
    function &_get_params_validation_object() {
        $CI = & get_instance();
        // We set this as a variable since we're returning by reference.
        $return = FALSE;

        if (FALSE !== ($object = $CI->load->is_loaded('Params_validation'))) {
            if (!isset($CI->$object) OR ! is_object($CI->$object)) {
                return $return;
            }
            return $CI->$object;
        }
        
        return $return;
    }

}