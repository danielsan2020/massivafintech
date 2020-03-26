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
if (!function_exists('create_barcode')) {

    function create_barcode($data) {
        $openpay = initialize_openpay();
        $charge = $openpay->charges->create($data);
        return $charge;
    }

}

if (!function_exists('create_customer')) {

    function create_customer($data) {
        $openpay = initialize_openpay();
        $customer = $openpay->customers->add($data);
        return $customer->id;
    }

}

if (!function_exists('add_card_to_customer')) {

    function add_card_to_customer($customer_id, $data) {
        $openpay = initialize_openpay();
        $customer = $openpay->customers->get($customer_id);
        try {
            $card = $customer->cards->add($data);
            return $card;
        } catch (Exception $e) {
            $card = array('message' => $e->getMessage());
            return $card;
        }
    }

}

if (!function_exists('subscribe_customer_to_plan')) {

    function subscribe_customer_to_plan($customer_id, $data) {
        $openpay = initialize_openpay();
        $customer = $openpay->customers->get($customer_id);
        try {
            $subscription = $customer->subscriptions->add($data);
            return $subscription;
        } catch (Exception $e) {
            $subscription = array('message' => $e->getMessage());
            return $subscription;
        }
    }

}

