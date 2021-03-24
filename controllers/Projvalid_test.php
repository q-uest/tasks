<?php

ob_start();
#require_once '/var/www/html/prod/index.php';
require_once '/var/www/html/prod/tasks/controllers/Projects.php';
#
#
#
#
class projvalid_test extends projects {
#$projvalid_test=new Projects();
public function test2() {
$output=$this->test_dummy();

echo "output=".$output;
}

}
?>
