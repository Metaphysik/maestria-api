<?php

namespace Application\Controller;

class Question extends Generic
{
    public function indexAction($evaluation_id)
    {
        $question   = new \Application\Model\Questions($evaluation_id);
        $all        = $question->all();
        
        $this->log(['nb' => count($all)]);
        $this->data($all);


        echo $this->getApiJson();
    }

    public function showAction($evaluation_id, $question_id)
    {
        $question   = new \Application\Model\Questions($evaluation_id);
        
        if($question->exists($question_id) === true) {
            $this->log('question %s exists', $question_id);
            $this->data($question->getID($question_id)[0]);

        }
        else {
            $this->nok('question %s not exists', $question_id);
        }
        echo $this->getApiJson();
    }
}
