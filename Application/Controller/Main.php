<?php

namespace Application\Controller;

use Sohoa\Framework\Kit;

class Main extends Kit {

    public function indexAction() {
        echo '<html><head><title>Maestria Api</title></head><body><h1>Maestria API</h1><h2>Contact administrator</h2></body></html>';
    }

    public function sampleAction() { // Routed by /Main/Sample/ with generic route

        $this->data->sample = ': Gordon foobar';
        $this->greut->render(); // Go to hoa://Application/View/Main/Foo.tpl.php
    }

    public function loginAction() {
    	echo json_encode(['d' => 'wawa', 'c' => 'a']);
    }

}
