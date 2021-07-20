<?php

# to be executed on destination hosts
############

$src = "/var/www/html/phar";
$extract_to = "/var/www/html/phar/app";


#if (!file_exists($extract_to)) {
#        mkdir($extract_to, 0777, true);
#        mkdir($extract_to.'/src', 0777, true);
#
#}



$phar = new Phar($src . "/myapp.phar");
$phar->extractTo($extract_to);


