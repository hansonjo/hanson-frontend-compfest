<?php

if(!function_exists('api_domain')) {
    function api_domain(){
        return 'https://hansoncompfestbackend.herokuapp.com/api';
    }
}

if(!function_exists('get_token')) {
    function get_token(){
        return \Session::get('token');
    }
}

if(!function_exists('get_role')) {
    function get_role(){
        return \Session::get('role');
    }
}

if(!function_exists('get_id')) {
    function get_id(){
        return \Session::get('id');
    }
}