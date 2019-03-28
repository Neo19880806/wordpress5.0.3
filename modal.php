<!--
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-brand-primary font-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
                <h2 class="modal-title" id="downloadModalLabel"></h2>
                    <span>Enter your email to download the Media Kit.</span>
            </div>

            <div class="modal-body">
                <div class="modal-error alert-warning"></div>
                <form class="form">
                        <label class="sr-only" for="modalEmail">Your email</label>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="modalFirstName" name="firstName" placeholder="First Name(required)" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="modalLastName" name="lastName" placeholder="Last Name(required)" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <input type="email" id="modalEmail" name="email" placeholder="Your email(required)" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="modalOrganisation" name="organisation" placeholder="Organisation(required)" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <select class="form-control" id="modalIndustry" name = "Industry">
                                    <option disabled selected hidden value="unselected">Industry</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Vocational-Training">Vocational Training</option>
                                    <option value="Banking">Banking</option>
                                    <option value="Government">Government</option>
                                    <option value="Accommodation">Accommodation</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="English-Language-School">English Language School</option>
                                    <option value="Private-College">Private College</option>
                                    <option value="Retail">Retail</option>
                                    <option value="University">University</option>
                                    <option value="Education">Education</option>
                                    <option value="Student Welfare">Student Welfare</option>
                                    <option value="TAFE">TAFE</option>
                                    <option value="Recreation">Recreation</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Agents">Agents</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Pathway Provider">Pathway Provider</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <input type="text" id="modalPhoneNumber" name="phoneNumber" placeholder="Phone Number" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <input type="submit" id="modalSubmit" value="Go" class="btn btn-primary btn-block">
                            </div>
                        </div>
                </form>

                <div class="modal-spinner"></div>
                <div class="modal-download-btn p-t-1 text-xs-center" id="modalDownloadBtn">
                    <a href="#" class="btn btn-success btn-block" target="_blank">Download</a>
                </div>
            </div>      
        </div>
    </div>-->

<?php
//require_once(__DIR__ . "/emali_quiz.php");
$emali_quiz_content = file_get_contents(__DIR__ ."/emali-quiz.json");
$emali_quiz_json = json_decode($emali_quiz_content,true);
$emali_quiz_question_array = $emali_quiz_json["emali_quiz_question"];
$emali_quiz_option_array = $emali_quiz_json["emali_quiz_option"];
?>
<!-- Modal -->
<div id="quizModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex">
                    <div class="vc_col-sm-12">
                        <div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="start-section" class="active">
                            <input id = "start-question" type="button" value="Start"/>
                        </div>
                        <div id = "question-section" class ="question-wrapper">
                            <form id="question-form">
                                <div>
                                    <?php
//                                    global $emali_quiz_question_array;
//                                    global $emali_quiz_option_array;
                                    $question_number = 0;
                                    $question_array = $emali_quiz_question_array["emali_quiz"];
                                    foreach ($question_array as $title => $content):
                                    ?>
                                        <div class ="question-fieldset">
                                            <h2 class="question-id"><?php echo $title ?></h2>
                                            <p><?php echo $content ?></p>

                                            <div class = "option-container">
                                            <?php 
                                            $options = $emali_quiz_option_array["emali_quiz"][$title]["Option"];
                                            foreach ($options as $option=>$value): ?>
                                            <div class = "option-list">
                                                <input type="radio" name = "question" value="<?php echo $option ?>"><?php echo $value ?></input>
                                            </div>
                                            <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?> 
                                <div>
                                    <input type="hidden" id = "question-value-helper" value = "<?php echo $question_number;?>"></input>
                                    <input type="submit"></input>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div id="success-section" class = "success-result">
                            <p id = "result-description"> 
                            </p>
                            <div>
                                <input type="button" class = "exit-quiz" data-dismiss="modal" value = "Exit Quiz"/>
                                <input type="button" id = "next-quiz" class = "next-quiz" value = "Next Question"/>
                            </div>
                        </div>

                        <div id="failed-section" class = "failed-result">
                            <p id = "result-description"> 
                            </p>
                            <div>
                                <input type="button" class = "exit-quiz" data-dismiss="modal" value  = "Exit Quiz">
                                <input type="button" id = "retry-quiz" class = "retry-quiz" value = "Retry Again"/>
                            </div>
                        </div>
                        <div id="final-section" class = "final">
                            <p id = "result-description"> 
                            </p>
                            <div>
                                <input type="button" class = "exit-quiz" data-dismiss="modal" value  = "Exit Quiz">
                                <input type="button" id = "view-opportunities" class = "view" value = "View Current Opportunities"/>
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>
        </div>

    </div>
</div>