<?php

# to be executed on the destination host
###################

$srcRoot = "/var/www/html/phar/app";
$buildRoot = "/var/www/html/phar";

$phar = new Phar($buildRoot . "/myapp.phar",
        FilesystemIterator::CURRENT_AS_FILEINFO |       FilesystemIterator::KEY_AS_FILENAME, "myapp.phar");

$phar->buildFromDirectory($srcRoot);
$phar["index.php"] = file_get_contents($srcRoot."/index.php");
$phar->setStub($phar->createDefaultStub("index.php",'app/index.php'));

