<?php

namespace Application\Controller;

class Main extends Generic
{
    public function indexAction()
    {
        $dump = $this->router->dump();

        $help = [
            'root' => 'This message',
            'login' => 'Test user credential',
            'indexuser' => 'All user password in sha1 with class & domain',
            'showUser'  => 'Get user information with class & domain'
        ];

        $private = [
            '--error--',
            '--err404--',
            'ErrorException',
        ];

        echo '<h1>Maestria API</h1>';
        echo '<table><thead><tr><th>ID</th><th>Match rule</th><th>Method</th><th>Controller</th><th>Help message</th></tr></thead>'."\n";
        echo '<tbody>'."\n";

        foreach ($dump as $rule) {
            if(in_array($rule[0], $private) === false)
                echo '<tr><td>'.$rule[0].'</td><td>'.$rule[2].'</td><td>'.$rule[1].'</td><td>'.$rule[3].'</td><td>'.((isset($help[$rule[0]]) === true) ? $help[$rule[0]] : '' ).'</td></tr>'."\n";
        }
        echo '</tbody>';
        echo '</table>';
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
