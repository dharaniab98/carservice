<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of Email
 *
 * @author dharanikumar
 */
class Email {
    //put your code here
    public function getGmail()
    {
         return   $gmail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'dharaniab98@gmail.com',
        'password' => 'dharaniab',
        'transport' => 'Smtp'
    );
    }
}
