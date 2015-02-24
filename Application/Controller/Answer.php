<?php

namespace Application\Controller;

class Answer extends Generic
{
    public function indexAction($evaluation_id = null, $user_id = null)
    {
    	$answer = new \Application\Model\Answer();


        if($user_id !== null) {
            if($answer->exists($user_id, $evaluation_id) === true) {
                $this->log('answer %s exists with %s user_id', [$evaluation_id, $user_id]);
                $this->data($answer->getEvaluation($evaluation_id)[0]);
            }
            else {
                $this->nok('answer %s not exists with %s user_id',[$evaluation_id, $user_id]);
            }
        }
        else {

            if($answer->existsEval($evaluation_id) === true) {
                $this->log('answer %s exists', $evaluation_id);
                $this->data($answer->getEvaluation($evaluation_id)[0]);

            }
            else {
                $this->nok('answer %s not exists', $question_id);
            }
        }

        echo $this->getApiJson();
    }

}
