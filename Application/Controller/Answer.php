<?php

namespace Application\Controller;

class Answer extends Generic
{
    public function indexAction($evaluation_id)
    {
    	$answer = new \Application\Model\Answer();

        if($answer->existsEval($evaluation_id) === true) {
            $this->log('answer %s exists', $evaluation_id);
            $this->data($answer->getEvaluation($evaluation_id)[0]);

        }
        else {
            $this->nok('answer %s not exists', $question_id);
        }

        echo $this->getApiJson();
    }

}
