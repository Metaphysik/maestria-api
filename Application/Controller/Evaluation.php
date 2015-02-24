<?php

namespace Application\Controller;

class Evaluation extends Generic
{
    public function indexAction($user_id = null)
    {

        if($user_id !== null) {

            $evaluation = new \Application\Model\Evaluation($user_id);
            $all = $evaluation->mine();
            $this->log('You log only professor evaluation');
            $this->log(['nb' => count($all)]);
            $this->data($all);
        }
        else {
            $evaluation = new \Application\Model\Evaluation();
            $all = $evaluation->all();
            
            $this->log(['nb' => count($all)]);
            $this->data($all);
        }
        
        echo $this->getApiJson();
    }

    public function showAction($evaluation_id = null, $user_id = null)
    {
        
        $evaluation = new \Application\Model\Evaluation();
        
        if($evaluation->exists($evaluation_id) === true) {
            $this->log('evaluation %s exists', $evaluation_id);
            $this->data($evaluation->get($evaluation_id));
        }
        else {
            $this->nok('evaluation %s not exists', $evaluation_id);
        }

        echo $this->getApiJson();
    }
}
