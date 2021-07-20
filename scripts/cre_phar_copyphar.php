<?php
$src_dest = "/var/www/html/phar/copyphar";
$build = "/var/www/html/phar";

$phar = new Phar($build . "/myapp.phar",
        FilesystemIterator::CURRENT_AS_FILEINFO |       FilesystemIterator::KEY_AS_FILENAME, "myapp.phar");

$phar->buildFromDirectory($src_dest);
$phar["index.php"] = file_get_contents($src_dest."/index.php");
$phar->setStub($phar->createDefaultStub("index.php",$src_dest.'/index.php'));
