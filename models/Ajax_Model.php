<?php

/**
 * Description of Questions_Model
 *
 * @author owner
 */
class Ajax_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function storeFeedback($feedbackText, $name, $email) {
        $query = "INSERT INTO feedback(text, name, email)
                    VALUES(:text, :name, :email)";

        $values = Array(
            ':text' => $feedbackText,
            ':name' => $name,
            ':email' => $email
        );

        return $this->execute($query, $values);
    }

    public function storeTopic($qid, $topic) {
        $query = "UPDATE questions 
                    SET topic=:topic
                    WHERE id=:qid";
        $values = Array(
            ':topic' => $topic,
            ':qid' => $qid
        );

        return $this->execute($query, $values);
    }

    public function submitQuestion($topic, $QStmt, $A, $B, $C, $D, $A, $Ans, $Exp, $Name, $Email) {
        $query = "INSERT INTO user_submissions(topic,statement,A,B,C,D,answer,explanation, name, email)
                    VALUES(:topic,:statement,:A,:B,:C,:D,:answer,:explanation, :name, :email)";

        $values = Array(
            ':topic' => $topic,
            ':statement' => $QStmt,
            ':A' => $A,
            ':B' => $B,
            ':C' => $C,
            ':D' => $D,
            ':answer' => $Ans,
            ':explanation' => $Exp,
            ':name' => $Name,
            ':email' => $Email
        );

        return $this->execute($query, $values);
    }

}
