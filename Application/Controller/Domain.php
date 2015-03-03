<?php

namespace Application\Controller;

class Domain extends Generic
{
    public function indexAction()
    {
        $c   = new \Application\Model\Domain();
        $all = $c->all();
        $this->log(['nb' => count($all)]);

        $this->data($all);

        echo $this->getApiJson();
    }

    public function showAction($domain_id)
    {
        $c   = new \Application\Model\Domain();

        if($c->idExists($domain_id) === true){
            $all = $c->get($domain_id);
            $this->log('domain %s exists', $domain_id);
            $this->log(['nb' => count($all)]);
            $this->data($all);
        }
        else {
            $this->nok('domain %s not exists', $domain_id);
        }

        echo $this->getApiJson();
    }
}
