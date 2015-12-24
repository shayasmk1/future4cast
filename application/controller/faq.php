<?php
class Faq extends Controller
{
    function __construct()
    {
        session_start();
    }
    public function index()
    {
        require APP . 'view/faq/index.php';
    }
}
?>