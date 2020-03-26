<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(
    'class' => 'Hook',
    'function' => 'seguridad',
    'filename' => 'hook.php',
    'filepath' => 'hooks'
);
