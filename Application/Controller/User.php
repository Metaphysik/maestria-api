<?php

namespace Application\Controller;

class User extends Generic
{
    public function indexAction()
    {
        $query  = $this->router->getQuery();
        $filter = isset($query['filter']) ? $query['filter'] : null;
        $start  = isset($query['start'])  ? $query['start']  : 0;
        $nb     = isset($query['nb'])     ? $query['nb']     : 50;
        $user   = new \Application\Model\User();
        $data   = [];
        $all    = $user->all();
        
        $this->log(['nb' => count($all)]);
        $this->data($all);


        echo $this->getApiJson();
    }

    public function showAction($user_id)
    {
        $user   = new \Application\Model\User();
        
        if($user->exists($user_id) === true) {
            $this->log('user %s exists', $user_id);
            $this->data($user->getByUser($user_id));

        }
        else {
            $this->nok('user %s not exists', $user_id);
        }
        echo $this->getApiJson();
    }
}
