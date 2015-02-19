<?php

namespace Application\Controller;

class Main extends Generic
{
    public function indexAction()
    {
        echo '<html><head><title>Maestria Api</title></head><body><h1>Maestria API</h1><h2>Contact administrator</h2></body></html>';
    }

    public function sampleAction()
    { // Routed by /Main/Sample/ with generic route

        $this->data->sample = ': Gordon foobar';
        $this->greut->render(); // Go to hoa://Application/View/Main/Foo.tpl.php
    }

    public function loginAction()
    {
        $user       = (isset($_POST['user']) === true)     ? $_POST['user']     : null;
        $password   = (isset($_POST['password']) === true) ? $_POST['password'] : null;

        if ($user === null) {
            $this->error('Post data : user are not found');
        }

        if ($password === null) {
            $this->error('Post data : password are not found');
        }

        echo $this->getApiJson();
    }
}
