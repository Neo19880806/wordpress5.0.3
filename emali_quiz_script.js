/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var f = jQuery.noConflict();
f(document).ready(function ($) {
    $('#quizModal').on('show.bs.modal', function () {
        var emali_quiz_test =  $.emali_quiz('#quizModal');
    });   
});
    
(function( $, window, document, undefined ){
    
    
    $(function(){
    var downloadElement = $('#quizModal > .modal-dialog >.modal-content >.modal-body').parent().clone().html();
    // reset the downloadModal form on modal close
        $('#quizModal').on('hidden.bs.modal', function () {
                $('#quizModal > .modal-dialog >.modal-content >.modal-body').replaceWith(downloadElement);
        });
    });

    $.emali_quiz = function(element){
        var $element = $(element);
        var plugin = this;
        
        //Start our Quiz
         var startButton =  $('#start-question',$element);
         startButton.on('click',function(){ 
             //display question section and first fieldset
             $(".modal-dialog #question-section").addClass("active");
             $(".modal-dialog #start-section").removeClass("active");
             var first_question = $('.question-fieldset',"#quizModal").first();
             first_question.addClass("active");
             
             var totalCount = $('.question-fieldset',$element).length;
             $(".modal-dialog #question-value-helper").attr("fieldsetCount",totalCount);
             $(".modal-dialog #question-value-helper").attr("fieldsetPosition",0);
         });
        
        //Add click event for radio buttons.
        var active_fieldset = $('.question-fieldset',"#quizModal");
        var radioButtonParentDiv = $('.option-list',active_fieldset);
        radioButtonParentDiv.each(function(){
            $(this).on("click",function(){
            {
                $('input[type=radio]',$(this)).attr("checked","true");
                $(this).css("backgroundColor","red");
                var submitButton = $('form#question-form',$element);
                //it will trigger submit event
                submitButton.submit();
            }
        });
        });
        

         //Submit Quiz
         var submitButton = $('form#question-form',$element);
         submitButton.on('submit',function(e){ 
            e.preventDefault();
            var active_fieldset = $('.question-fieldset.active',"#quizModal");
            var action = "emali_quiz_answer";
            var url = emali_quiz_vars.emali_quiz_ajax_url;
            var quiz_title= "emali_quiz";
            var question_id = $('.question-id',active_fieldset).text();
            var checkRadio = $('input[name=question]:checked',active_fieldset)
            if(checkRadio.length < 1){
                alert("Please choose your answer!");
                return false;
            }
            var question_value = checkRadio.val();
            
            jQuery.ajax({
              type : "post",
              dataType : "text",
              url : url,
              data : {
                action: action,
                quiz_title:quiz_title,
                question_id:question_id,
                question_value:question_value
              },
              success: function(response) {
                  $(".modal-dialog #question-section","#quizModal").removeClass("active");
                  var jsonResponse = JSON.parse(response);
                  var result = jsonResponse["result"];
                  var hint = jsonResponse["hint"];
                  if(result .localeCompare ("success") == 0){
                      var next_question = $('.question-fieldset.active',"#quizModal").next(".question-fieldset");
                      if(next_question.length > 0){
                        $('#success-section',"#quizModal").addClass('active');
                        $('#success-section > p#result-description',"#quizModal").text(hint);
                      }
                      else
                      {
                          $(".modal-dialog #final-section").addClass("active");
                      }
                  }else{
                      $('#failed-section',"#quizModal").addClass('active');
                      $('#failed-section > p#result-description',"#quizModal").text(hint);
                  }
                  
              },
              error:function(xhr, ajaxOptions, thrownError){
                   alert("something was wrong,please try again later");
              }
            });
            return false;
         });
         
         //To do next question
         var nextQuizButton = $(".next-quiz",$element);
         nextQuizButton.on("click",function(){
             //Display Question Section, Hide Success Section
             $('#success-section',"#quizModal").removeClass('active');
             var current_question = $('.question-fieldset.active',"#quizModal");
             var next_question = $('.question-fieldset.active',"#quizModal").next(".question-fieldset");
             //Hide current question;Display next question or Display Final Section
             current_question.removeClass("active");
             if(next_question.length > 0){
                $(".modal-dialog #question-section").addClass("active");
                next_question.addClass("active");
             }else{
                 $(".modal-dialog #final-section").addClass("active");
             }
         });
         
         function getRandomArbitrary(min, max) {
            return Math.random() * (max - min) + min;
        }

         //Reset Question
         var tryAgainButton = $("#retry-quiz",$element);
         tryAgainButton.on("click",function(){
             $(".modal-dialog #question-section").addClass("active");
             $(".modal-dialog #failed-section").removeClass("active");
            
            var active_fieldset = $('.question-fieldset.active',"#quizModal");
            var options = $('input[name=question]',active_fieldset);
            var optionsLength = options.length;
            var order = Math.floor(getRandomArbitrary(0,optionsLength - 1));
            
            $('input[name=question]:checked',active_fieldset).parent(".option-list").css("order",order);
            $('input[name=question]:checked',active_fieldset).parent(".option-list").css("backgroundColor","");
            
            $('input[name=question]:checked',active_fieldset).attr("checked", false);
         });
    }
})(jQuery, window, document);