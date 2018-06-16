<div class="pagination">
    <?php
//    $self = $_SERVER['PHP_SELF'];
    $self = "";
    $total_no_of_records = $data["total_no_of_questions"];

    if ($total_no_of_records > 0) {
        $total_no_of_pages = ceil($total_no_of_records / QUESTIONS_PER_PAGE);
        $current_page = CURRENT_PAGE;
        /*
        if (isset($_GET["page_no"])) {
            $current_page = $_GET["page_no"];
        }
        */
        if ($current_page != 1) {
            $previous = $current_page - 1;
            echo "<a href='" . $self . "pg1'> First </a>&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a href='" . $self . "pg" . $previous . "'>Previous</a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        for ($i = 1; $i <= $total_no_of_pages; $i++) {
            if ($i == $current_page) {
                echo "<strong><a href='" . $self . "pg" . $i . "' style='color:red;text-decoration:none'>" . $i . "</a></strong>&nbsp;&nbsp;&nbsp;&nbsp;";
            } else {
                echo "<a href='" . $self . "pg" . $i . "'>" . $i . "</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        }
        if ($current_page != $total_no_of_pages) {
            $next = $current_page + 1;
            echo "<a href='" . $self . "pg" . $next . "'>Next</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a href='" . $self . "pg" . $total_no_of_pages . "'>Last</a>&nbsp;&nbsp;&nbsp;&nbsp;";
        }
    }
    ?>
</div>