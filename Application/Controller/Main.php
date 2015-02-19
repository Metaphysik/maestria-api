<?php

namespace Application\Controller;

class Main extends Generic
{
    public function indexAction()
    {
        echo '<html><head><title>Maestria Api</title></head><body><h1>Maestria API</h1><h2>Contact administrator</h2></body></html>';
        // TODO : Help message with full api
    }

    public function loginAction()
    {
        $user       = (isset($_POST['user']) === true)     ? $_POST['user']     : null;
        $password   = (isset($_POST['password']) === true) ? $_POST['password'] : null;

        if ($user === null) {
            $this->error('Post data : user are not found');
            $this->nok();
        }

        if ($password === null) {
            $this->error('Post data : password are not found');
            $this->nok();
        }

        $this->ok();
        echo $this->getApiJson();
    }
}
