<?php

namespace Application\Controller;

class Theme extends Generic
{
    public function indexAction()
    {
        $c   = new \Application\Model\Theme();
        $all = $c->all();
        $this->log(['nb' => count($all)]);

        $this->data($all);

        echo $this->getApiJson();
    }

    public function showAction($theme_id)
    {
        $c   = new \Application\Model\Theme();

        if($c->idExists($theme_id) === true){
            $all = $c->get($theme_id);
            $this->log('theme %s exists', $theme_id);
            $this->log(['nb' => count($all)]);
            $this->data($all);
        }
        else {
            $this->nok('theme %s not exists', $theme_id);
        }

        echo $this->getApiJson();
    }
}
