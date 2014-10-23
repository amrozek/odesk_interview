<?php
require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');

class UnitTestingClass extends WebTestCase  {
    function testOutputMatch() {
        $this->get('http://localhost/odesk/odesk.php');
        $this->assertText("+----------+----------+----------+----------+");
		$this->assertPattern("/Name.*Color.*Element.*Likes/");
		$this->assertPattern("/Trixie.*Green.*Earth.*Flowers/");
		$this->assertPattern("/Tinker.*Blue.*Air.*Singning/");
		$this->assertPattern("/Blum.*Pink.*Water.*Dancing/");
    }
}
?>
 