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
            $this->nok('Post data : user are not found');
        }

        if ($password === null) {
            $this->nok('Post data : password are not found');
        }

        $this->log($user);
        $this->log($password);


        $m_user = new \Application\Model\User();
        $bool   = $m_user->check($user, $password, true);

        if($bool === false){
            $this->nok('Your credential are not reconized');
        }
        else {
            $information = $m_user->getByUser($user);

            if($information !== null) {
                $this->ok();
                $this->data($information);
            }
            else {
                $this->nok('Error API');
            }
        }
        echo $this->getApiJson();
    }
}
