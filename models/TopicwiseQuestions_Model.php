<?php

/**
 * Description of Questions_Model
 *
 * @author owner
 */
class TopicwiseQuestions_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getAllQuestionsForTopic($params) {

        $starting_position = (CURRENT_PAGE - 1) * QUESTIONS_PER_PAGE;

        $query2 = "select * from questions where qtype= :qtype and topic=:topic" . " ORDER BY qtype_value DESC, qno ASC" . " limit " . $starting_position . "," . QUESTIONS_PER_PAGE;
        /*  sample values
          $exam = "IAS";
          $paper =  "GS"; //GS or CSAT
          $paperType = "CSP"; //past paper or mock paper
          $paperNo = "2015"; // IAS_2015, MOCK 12
         */
        $values = Array(
            ':qtype' => $params['paperType'],
            ':topic' => $params['topic']
        );

        return $this->query($query2, $values);
    }

    public function getQuestionsForTopicOfPaper($params) {

        $starting_position = (CURRENT_PAGE - 1) * QUESTIONS_PER_PAGE;

        $query2 = "select * from questions where qtype= :qtype and qtype_value=:paperNo and topic=:topic" . " ORDER BY qtype_value DESC, qno ASC" . " limit " . $starting_position . "," . QUESTIONS_PER_PAGE;
        /*  sample values
          $exam = "IAS";
          $paper =  "GS"; //GS or CSAT
          $paperType = "CSP"; //past paper or mock paper
          $paperNo = "2015"; // IAS_2015, MOCK 12
         */
        $values = Array(
            ':qtype' => $params['paperType'],
            ':topic' => $params['topic'],
            ':paperNo' => $params['paperNo']
        );

        return $this->query($query2, $values);
    }

    public function getTotalCountQuestionsForTopic($params) {
        $qury = "select count(id) as count from questions where qtype= :qtype and topic=:topic";
        $values = Array(
            ':qtype' => $params['paperType'],
            ':topic' => $params['topic']
        );
        $result = $this->query($qury, $values); //$result returned is an array of arrays, the count value is in first item of the first array
        return $result[0]['count'];
    }

    public function getTotalCountQuestionsForTopicOfPaper($params) {
        $qury = "select count(id) as count from questions where qtype= :qtype and qtype_value=:paperNo and topic=:topic";
        $values = Array(
            ':qtype' => $params['paperType'],
            ':topic' => $params['topic'],
            ':paperNo' => $params['paperNo']
        );
        $result = $this->query($qury, $values); //$result returned is an array of arrays, the count value is in first item of the first array
        return $result[0]['count'];
    }

}
