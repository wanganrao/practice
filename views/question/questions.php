<!---
To display questions
--->

<div class="container_questions">

    <hr>
    <?php
    $i = 1;
    if (count($data["questions"]) == 0) {
        echo " <pre> No questions here ! </pre>";
    } else
        foreach ($data["questions"] as $result) {
//        print_r($result);
            ?>

            <div class="mf-div-qcontainer" itemprop="about" itemscope itemtype="http://schema.org/Question">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="mf-tbl-qcontainer">
                    <tbody>

                        <tr>
                            <td valign="top" align="left" rowspan="3" class="mf-td-qno">
                                <?php echo $result["qno"] ?>.&nbsp;
                            </td>

                            <td valign="top"  class="mf-td-topic"  >
                                <div id="idDivTopic_<?php echo $result["id"] ?>" style="display:inline-block">
                                    <?php
                                    if ($result['topic'] == '') {
                                        echo '<a onclick="changeTopic(' . $result["id"] . ');" class="">Help Categorize</a>';
                                    } else {

//                                    echo '<strong>' . ucwords(str_replace('-', ' ', $result['topic'])) . '</strong>' . ' <a onclick="changeTopic(' . $result["id"] . ');" class="">Change</a>';
                                        echo '<strong>' . ucwords(str_replace('-', ' ', $result['topic'])) . '</strong>';
                                    }
                                    ?>
                                </div>
                                <div  style="display:inline-block; float:right; font-weight: bold">
                                    <?php echo $result['qtype'] . " " . $result['qtype_value']; ?>
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td valign="top" class="mf-td-qtxt" itemprop="text">
                                <p>
                                    <?php echo nl2br($result['statement']); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="mf-td-options">
                                <table width="100%" cellspacing="0" cellpadding="0" border="0" id="tblOption_<?php echo $result["id"] ?>" class="mf-tbl-options">
                                    <tbody>
                                        <tr id="idOption_A_<?php echo $result["id"] ?>" class="mf-tr-option" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                                            <td width="3%" class="mf-td-option">
                                                <b>A.</b>
                                            </td>
                                            <td width="97%" class="mf-td-option" itemprop="text">
                                                <?php echo $result['A']; ?>                                            
                                            </td>                                        
                                        </tr>
                                        <tr id="idOption_B_<?php echo $result["id"] ?>" class="mf-tr-option" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                                            <td width="3%" class="mf-td-option">
                                                <b>B.</b>
                                            </td>
                                            <td width="97%" class="mf-td-option" itemprop="text">
                                                <?php echo $result['B']; ?>
                                            </td>
                                        </tr>
                                        <tr id="idOption_C_<?php echo $result["id"] ?>" class="mf-tr-option" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                                            <td width="3%" class="mf-td-option">
                                                <b>C.</b>
                                            </td>
                                            <td width="97%" class="mf-td-option" itemprop="text">
                                                <?php echo $result['C']; ?>
                                            </td>
                                        </tr>
                                        <tr id="idOption_D_<?php echo $result["id"] ?>" class="mf-tr-option" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">
                                            <td width="3%" class="mf-td-option">
                                                <b>D.</b>
                                            </td>
                                            <td width="97%" class="mf-td-option" itemprop="text">
                                                <?php echo $result['D']; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="hidden" value="<?php echo $result['answer']; ?>" id="hdnAnswer_<?php echo $result["id"] ?>" >
                                <div id="divAnswer_<?php echo $result["id"] ?>" class="mf-div-answer mf-none">
                                    <p> Answer: Option <?php echo $result['answer']; ?>      </p>                                 
                                    <p>  <?php echo nl2br($result['explanation']); ?>      </p>                                 
                                </div>

                                <div id="divToolBar_<?php echo $result["id"] ?>" class="mf-div-toolbar">
                                    <a onclick="$('#divAnswer_<?php echo $result["id"] ?>').slideToggle('slow')" href="javascript: void 0;" class="show-answer" > Show Answer</a>

                                    <!--
                                                            <a href="/question/<?php echo $result["id"] ?>" target="_blank" class="discuss">Discuss</a>

                                    -->
                                    <?php
                                    if (isset($data["questionID"]) && $data["questionID"] != "") {
                                        //do not show the anchor on discussion page
                                    } else {
                                        echo '<a href="/question/' . $result["id"] . '" target="_blank" class="discuss">Discuss</a>';
                                    }
                                    ?>

                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <?php
            $i++;
        }
    ?>
</div>
