<?php
class Contact extends Controller
{
    function __construct()
    {
        session_start();
    }
    public function index()
    {
        require APP . 'view/contact/index.php';
    }
}
?>