<?php

class About_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($params) {
        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS . 'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS . 'public' . DS . 'js' . DS . 'js.js');
        $this->view->Set_JS('https://www.google.com/recaptcha/api.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        $this->Assign('meta_description', 'Provide your feedback.');
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
        $this->Assign('page_title', "");


        // content string
        $content = "";

        $aboutPage = new View();
        $content.= $aboutPage->Render("pages" . DS . "about-us", false);


        $feedbackView = new View();
        $content.= $feedbackView->Render("forms" . DS . "feedback", false);

        $homePaperView = new View();
        $this->Assign('right_panel', $homePaperView->Render("home" . DS . "home", false));


        //assign to the main content of index view
        $this->Assign('content', $content);
    }

    
    public function copyright($params) {
        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS . 'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS . 'public' . DS . 'js' . DS . 'js.js');
        $this->view->Set_JS('https://www.google.com/recaptcha/api.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        $this->Assign('meta_description', 'Copyright');
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
        $this->Assign('page_title', "");


        // content string
        $content = "";

        $aboutPage = new View();
        $content.= $aboutPage->Render("pages" . DS . "copyright", false);


        $homePaperView = new View();
        $this->Assign('right_panel', $homePaperView->Render("home" . DS . "home", false));


        //assign to the main content of index view
        $this->Assign('content', $content);
    }

    public function privacy_policy($params) {
        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS . 'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS . 'public' . DS . 'js' . DS . 'js.js');
        $this->view->Set_JS('https://www.google.com/recaptcha/api.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        $this->Assign('meta_description', 'Terms of use and privacy polcy');
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
        $this->Assign('page_title', "");


        // content string
        $content = "";

        $aboutPage = new View();
        $content.= $aboutPage->Render("pages" . DS . "privacy-policy", false);


        $homePaperView = new View();
        $this->Assign('right_panel', $homePaperView->Render("home" . DS . "home", false));


        //assign to the main content of index view
        $this->Assign('content', $content);
    }

    public function submit_question($params) {
        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS . 'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS . 'public' . DS . 'js' . DS . 'js.js');
        $this->view->Set_JS('https://www.google.com/recaptcha/api.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        $this->Assign('meta_description', 'Submit a question');
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
        $this->Assign('page_title', "");


        // content string
        $content = "";

        $aboutPage = new View();
        $content.= $aboutPage->Render("forms" . DS . "submit-question", false);


        $homePaperView = new View();
        $this->Assign('right_panel', $homePaperView->Render("home" . DS . "home", false));


        //assign to the main content of index view
        $this->Assign('content', $content);
    }

}
