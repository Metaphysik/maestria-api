<?php

namespace Application\Controller;

class Classroom extends Generic
{
    public function indexAction()
    {
        $c   = new \Application\Model\Classe();
        $all = $c->all();
        $this->log(['nb' => count($all)]);

        $this->data($all);

        echo $this->getApiJson();
    }

    public function showAction($classroom_id)
    {
        $c   = new \Application\Model\UserClass();

        if($c->hasUsers($classroom_id) === true){
            $all = $c->getUsers($classroom_id);
            $this->log('class %s exists', $classroom_id);
            $this->log(['nb' => count($all)]);
            $this->data($all);
        }
        else {
            $this->nok('class %s not exists', $classroom_id);
        }

        echo $this->getApiJson();
    }
}
