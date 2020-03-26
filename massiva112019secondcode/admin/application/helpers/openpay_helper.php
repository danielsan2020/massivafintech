<?php

if (!function_exists('initialize_openpay')) {

    function initialize_openpay() {
        $CI = &get_instance();
        $CI->load->library('openpay');
        Openpay::setId('mfmjdwdwwxgufkzbobfp');
        Openpay::setApiKey('sk_cf454bf421f343ad96297ca7c27f3401');
        return Openpay::getInstance('mfmjdwdwwxgufkzbobfp', 'sk_cf454bf421f343ad96297ca7c27f3401');
    }

}
if (!function_exists('add_openpay_plan')) {

    function add_openpay_plan($data) {
//        if (ENVIRONMENT === 'production') {
            $openpay = initialize_openpay();
            $plan = $openpay->plans->add($data);
            return $plan->id;
//        } else {
//            return '0000';
//        }
    }

}

//if (!function_exists('get_openpay_plan')) {
//
//    function get_openpay_plan($open_pay_id) {
//        $openpay = initialize_openpay();
//        return $openpay->plans->get($open_pay_id);
//    }
//
//}

if (!function_exists('update_openpay_plan')) {

    function update_openpay_plan($open_pay_id, $data) {
        if (ENVIRONMENT === 'production') {
            $openpay = initialize_openpay();
            $plan = $openpay->plans->get($open_pay_id);
            $plan->name = $data['nombre'];
            $plan->save();
        }
        return TRUE;
    }

}

if (!function_exists('delete_openpay_plan')) {

    function delete_openpay_plan($open_pay_id) {
        if (ENVIRONMENT === 'production') {
            $openpay = initialize_openpay();
            $plan = $openpay->plans->get($open_pay_id);
            $plan->delete();
        }
        return TRUE;
    }

}
