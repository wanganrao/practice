<?php

/**
 * Description of Questions_Model
 *
 * @author owner
 */
class Question_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getQuestion($params) {
        
        $query2 = "select * from questions where id= :qid ";

        $values = Array(
            ':qid' => $params['questionID']
        );
        
        return $this->query($query2, $values);
    }

}
