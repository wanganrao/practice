<?php

class Index_Controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($params) {

        // Load page template file
        $this->Load_View('index');

        // load CSS file
        $this->view->Set_CSS(DS.'public' . DS . 'css' . DS . 'style.css');
        $this->view->Set_JS(DS.'public' . DS . 'js' . DS . 'js.js');
        // Set page title
        $this->view->Set_Site_Title(SITE_TITLE);
        $this->Assign('meta_description', "UPSC MCQ practice paper");
            $this->Assign('page_title', "Welcome ! Here you can practice UPSC IAS Prelims questions.");

        // HEADER
        $header = new View();
        $header->Assign('app_title', "MCQ Forum");
        $this->Assign('header', $header->Render('header', false));

        // FOOTER
        $footer = new View();
        $this->Assign('footer', $footer->Render('footer', false));
        
                $this->Assign('right_panel','');

        // content string
        $content = "";

        $homeContentView = new View();
        $content.= $homeContentView->Render("home" . DS . "home", false);

        //assign to the main content of index view
        $this->Assign('content', $content);

    }

}
