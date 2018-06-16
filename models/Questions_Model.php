<?php

/**
 * Description of Questions_Model
 *
 * @author owner
 */
class Questions_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getQuestions($params) {
        /*
          if(isset($_GET["page_no"]))
          {
          $starting_position=($_GET["page_no"]-1)*QUESTIONS_PER_PAGE;
          var_dump($starting_position);

          }
         * 
         */
        $starting_position = (CURRENT_PAGE - 1) * QUESTIONS_PER_PAGE;

        $query2 = "select * from questions where qtype= :qtype and qtype_value=:qtype_value" . " ORDER BY qno ASC " . " limit " . $starting_position . "," . QUESTIONS_PER_PAGE;
        /*  sample values
          $exam = "IAS";
          $paper =  "GS"; //GS or CSAT
          $paperType = "PAST"; //past paper or mock paper
          $paperNo = "2015"; // IAS_2015, MOCK 12
         */
        $values = Array(
            ':qtype' => $params['paperType'],
            ':qtype_value' => $params['paperNo']
        );

        return $this->query($query2, $values);
    }

    public function getSimilarQuestions($params) {

        $qId = $params['questionID'];
        $query1 = "select statement, A ,B, C, D from questions where id=:id ";
        $values1 = Array(
            ':id' => $params['questionID']
        );
        $result = $this->query($query1, $values1);
//        var_dump($result);
        $strToSearch = $result[0]["statement"] . " " . $result[0]["A"] . " " . $result[0]["B"] . " " . $result[0]["C"] . " " . $result[0]["D"];
//        var_dump($strToSearch);

        $query = "SELECT * FROM questions WHERE MATCH (statement,A,B,C,D) AGAINST (:str IN NATURAL LANGUAGE MODE) LIMIT 5";
        $values2 = Array(
            ':str' => $strToSearch
        );

        return $this->query($query, $values2);
    }

    public function getTotalQuestions($params) {
        $qury = "select count(id) as count from questions where qtype= :qtype and qtype_value=:qtype_value";
        $values = Array(
            ':qtype' => $params['paperType'],
            ':qtype_value' => $params['paperNo']
        );
        $result = $this->query($qury, $values); //$result returned is an array of arrays, the count value is in first item of the first array
        return $result[0]['count'];
    }

}
