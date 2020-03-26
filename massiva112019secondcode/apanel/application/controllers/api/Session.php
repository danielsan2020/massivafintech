<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

class Session extends REST_Controller {

    public function logout_get() {
        unset($_SESSION[$this->config->item('project_name')]);
        $this->response(['message' => 'Has Cerrado Sessión'], REST_Controller::HTTP_OK);
    }

}
