<?php
/*
 * Fetch Questions
 */

class Ajax_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function feedback($params) {
        $feedbackText = $_POST['FeedbackText'];
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        
        $aModel = new Ajax_Model();
        $aModel-> storeFeedback($feedbackText,$name,$email);
    }

    public function saveTopic($params){
        $qid = $_POST['QID'];
        $topic = $_POST['Topic'];
        
        $aModel = new Ajax_Model();
        $aModel-> storeTopic($qid,$topic);
    }
    
    public function submitQuestion($params){
        $topic = $_POST['Topic'];
        $QStmt = $_POST['QStmt'];
        $A = $_POST['A'];
        $B = $_POST['B'];
        $C = $_POST['C'];
        $D = $_POST['D'];
        $Ans = $_POST['Ans'];
        $Exp = $_POST['Exp'];
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        
        $aModel = new Ajax_Model();
        $aModel-> submitQuestion($topic,$QStmt,$A,$B,$C,$D,$A,$Ans,$Exp,$Name,$Email);
    }
}
