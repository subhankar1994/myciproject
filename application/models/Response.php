<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Response extends CI_Model {

    function api_generic_response($dataGet){
        $data = new stdClass();
        foreach($dataGet as $key => $value){
            $data->{$key} = $value;
        }
        return $data;
    }

}