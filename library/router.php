<?php

/** Check if environment is development and display errors * */
function SetReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
        ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
    }
}

/** Check for Magic Quotes and remove them * */
function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function RemoveMagicQuotes() {
    if (get_magic_quotes_gpc()) {
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them * */
function UnregisterGlobals() {

    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

//Automatically includes files containing classes that are called
function __autoload($className) {

    //fetch file
    if (file_exists(ROOT . DS . 'controllers' . DS . $className . '.php')) {
        require_once( ROOT . DS . 'controllers' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'models' . DS . $className . '.php')) {
        require_once( ROOT . DS . 'models' . DS . $className . '.php');
    } else if (file_exists(ROOT . DS . 'library' . DS . $className . '.php')) {
        require_once( ROOT . DS . 'library' . DS . $className . '.php');
    } else {

        error_log("Error: Class  $className not found.", 3, ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
        // Error: Controller Class not found
        die("Error: Class $className not found.");
    }
}

/** Main Call Function * */
function CallHook() {

    global $url;
    $exam = '';
    $paper = '';
    $paperType = '';
    $paperNo = '';
    $topic = '';
    $pageNo = 1;
    $questionID = "";
//    var_dump($url);
    if (!isset($url)) {
        $controllerName = DEFAULT_CONTROLLER;
        $action = DEFAULT_ACTION;
    } else {
        $urlArray = array();
        $urlArray = explode("/", $url);
//	$controllerName = $urlArray[0];
//      $action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_ACTION;
        switch ($urlArray[0]) {

            case 'previous-years-questions':
                $controllerName = "Questions";
                $action = 'index';
                /*
                  $exam = (isset($urlArray[0]) && $urlArray[0] != '') ? $urlArray[0] : "IAS";
                  $paper = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : "GS"; //GS or CSAT
                  $paperType = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : "PAST"; //past paper or mock paper
                  $paperNo = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : "2015"; // IAS_2015, MOCK 12
                  $pageNo = (isset($urlArray[4]) && $urlArray[4] != '') ? $urlArray[4] : "1";
                 */

                $exam = "IAS";
                $paper = "GS"; //GS or CSAT
                $paperType = "CSP"; //past paper or mock paper
                $paperNo = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : "2011"; // IAS_2015, MOCK_12
                $pageNoStr = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : "pg1";
                $pageNo = substr($pageNoStr, 2);
                define('CURRENT_PAGE', $pageNo);
                break;

            case 'practice-questions':
                $controllerName = "Questions";
                $action = 'index';

                $exam = "IAS";
                $paper = "GS"; //GS or CSAT
                $paperType = "MOCK"; //past paper or mock paper
                $paperNo = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : "1"; // IAS_2015, MOCK_12

                $pageNoStr = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : "pg1";
                $pageNo = substr($pageNoStr, 2);

                define('CURRENT_PAGE', $pageNo);
                break;

            case 'topicwise':
                $controllerName = "TopicwiseQuestions";
                $action = 'index';

                $exam = "IAS";
                $paper = "GS"; //GS or CSAT
                $paperType = "";
                if (isset($urlArray[1]) && $urlArray[1] == 'previous-years-questions') {
                    $paperType = "CSP";
                } elseif (isset($urlArray[1]) && $urlArray[1] == 'practice-questions') {
                    $paperType = "MOCK";
                }
                $topic = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : "";
                if (isset($urlArray[3]) && $urlArray[3] != '') {
                    $paperNoORpageNoStr = $urlArray[3];
                    if (preg_match('/pg/', $paperNoORpageNoStr)) {
                        $paperNo = "";
                        $pageNo = substr($paperNoORpageNoStr, 2);
                    } else {
                        $paperNo = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : "";
                        $pageNo = (isset($urlArray[4]) && $urlArray[4] != '') ? substr($urlArray[4], 2) : "1";
                    }
                }

                define('CURRENT_PAGE', $pageNo);
                break;

            case 'question':
                $controllerName = "Question";
                $action = 'index';

                $questionID = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : "";

                break;

            case 'similar':
                $controllerName = "Question";
                $action = 'similarQs';

                $questionID = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : "";

                break;

            case 'ajax':
                $controllerName = "Ajax";
                if (isset($urlArray[1]) && $urlArray[1] != '') {
                    $action = $urlArray[1];
                    break;
                }
                
                
            case 'submit-question':
                $controllerName = "About";
                $action = 'submit_question';
                break;

            case 'about':
                $controllerName = "About";
                $action = 'index';
                break;
            case 'copyright':
                $controllerName = "About";
                $action = 'copyright';
                break;

            case 'privacy-policy':
                $controllerName = "About";
                $action = 'privacy_policy';
                break;

            default:
                $controllerName = DEFAULT_CONTROLLER;
                $action = DEFAULT_ACTION;
                break;
        }
    }
//
//    $query1 = (isset($urlArray[2]) && $urlArray[2] != '') ? $urlArray[2] : null;
//    $query2 = (isset($urlArray[3]) && $urlArray[3] != '') ? $urlArray[3] : null;
    //modify controller name to fit naming convention
    $class = $controllerName . '_Controller';

    //instantiate the appropriate class
    if (class_exists($class) && (int) method_exists($class, $action)) {

        $controller = new $class;
        $params = Array(
            'exam' => $exam,
            'paper' => $paper,
            'paperType' => $paperType,
            'paperNo' => $paperNo,
            'topic' => $topic,
            'questionID' => $questionID
        );
//        var_dump($params);
        $controller->$action($params);
    } else {

        // Error: Controller Class not found
        die("1. File <b>'$controllerName.php'</b> containing class <b>'$class'</b> might be missing. <br>2. Method <b>'$action'</b> is missing in <b>'$controllerName.php'</b>");
    }
}

SetReporting();
RemoveMagicQuotes();
UnregisterGlobals();
CallHook();
