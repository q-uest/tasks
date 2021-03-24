<?php

class test {

	public function printmsg() {

	return("i am from test func()");
}
}


#$pmsg=new test();
#echo $pmsg->printmsg();


class testchild extends test {
	public function printmsg2() {
	echo "this is testchild";
	echo $this->printmsg();
	}
}


$pmsg2=new testchild();
echo $pmsg2->printmsg2();



?>
