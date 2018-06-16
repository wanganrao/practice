<?php

/*
 * Fetch Questions
 */

class TopicwiseQuestions_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($params) {
        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS . 'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS . 'public' . DS . 'js' . DS . 'js.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        $this->Assign('meta_description', implode(" ", $params) . ' question paper');
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
            $this->Assign('page_title', "UPSC IAS Prelims Topicwise Questions : " . ucwords(str_replace('-', ' ', $params['topic'])) );


        // content string
        $content = "";
//        var_dump($params);
        $rightPanelView = new View();
        $this->Assign('right_panel', $rightPanelView->Render("home" . DS . "home", false));
        if ($params['paperType'] == "CSP") {

        $topBox = new View();
                    $topBox->Assign("topic", $params['topic']);

        $content.= $topBox->Render("topics" . DS . "topics_year", false);
        }
        if ($params['paperType'] == "") {
            $qContentView = new View();
            $content.= $qContentView->Render("home" . DS . "home", false);
        } elseif ($params['topic'] == "") {//show list of topics
            $qContentView = new View();
            $content.= $qContentView->Render("home" . DS . "home", false);
        } elseif ($params['paperNo'] == "") {//show topic ques for all papers
            $qModel = new TopicwiseQuestions_Model();
            $qContentView = new View();
            $qContentView->Assign("paperNo", $params['paperNo']);
            $qContentView->Assign("paperType", $params['paperType']);
            $qContentView->Assign("questions", $qModel->getAllQuestionsForTopic($params));
            $content.= $qContentView->Render("question" . DS . "questions", false);

            $pgContentView = new View();
            $pgContentView->Assign("total_no_of_questions", $qModel->getTotalCountQuestionsForTopic($params));
            $content.= $pgContentView->Render("pagination" . DS . "pagination", false);
        } else {
            $qModel = new TopicwiseQuestions_Model();
            $qContentView = new View();
            $qContentView->Assign("paperNo", $params['paperNo']);
            $qContentView->Assign("paperType", $params['paperType']);
            $qContentView->Assign("questions", $qModel->getQuestionsForTopicOfPaper($params));
            $content.= $qContentView->Render("question" . DS . "questions", false);

            $pgContentView = new View();
            $pgContentView->Assign("total_no_of_questions", $qModel->getTotalCountQuestionsForTopicOfPaper($params));
            $content.= $pgContentView->Render("pagination" . DS . "pagination", false);
        }
        /*
          // questions
          $qModel = new Questions_Model();
          $qContentView = new View();
          $qContentView->Assign("paperNo", $params['paperNo']);
          $qContentView->Assign("paperType", $params['paperType']);

          $qContentView->Assign("questions", $qModel->getQuestions($params));
          $content.= $qContentView->Render("question" . DS . "questions", false);

          $homePaperView = new View();
          $this->Assign('right_panel',$homePaperView->Render("home" . DS . "home", false));

          //pagination
          //        $pgModel = new Pagination_Model();
          $pgContentView = new View();
          $pgContentView->Assign("total_no_of_questions",$qModel->getTotalQuestions($params));
          $content.= $pgContentView->Render("pagination" . DS . "pagination", false);
         */
        //assign to the main content of index view
        $this->Assign('content', $content);
    }

}
