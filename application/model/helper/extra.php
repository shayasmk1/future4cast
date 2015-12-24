<?php
class extra {
    function generate_random_string($name_length = 8) {
            $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            return substr(str_shuffle($alpha_numeric), 0, $name_length);
    }
}

