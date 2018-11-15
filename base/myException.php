<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 12:49
 */


class myException
{
    private $message;
    private $code;
    public function __construct($message = "",$code =0)
    {
        $this->message=$message;
        $this->code=$code;
    }

    public function throw_me(){
        try{
            throw new Exception($this->message,$this->code);
        }catch (Exception $e){
            echo $e->getMessage();
            die;
        }
    }
}