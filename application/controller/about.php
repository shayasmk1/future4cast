<?php
class About extends Controller
{
    function __construct()
    {
        session_start();
    }
    public function index()
    {
        require APP . 'view/about/index.php';
    }
}
?>