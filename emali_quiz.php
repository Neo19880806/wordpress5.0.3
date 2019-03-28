<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function emali_ajax_quiz_enque() {
  // Enqueue script
  wp_register_script('emali_quiz_script', get_stylesheet_directory_uri() . '/emali_quiz_script.js', array('jquery'), null, false);
  wp_enqueue_script('emali_quiz_script');
  wp_enqueue_style('emali-quiz-style', get_stylesheet_directory_uri() . '/emali_quiz_style.css');
  

  wp_localize_script( 'emali_quiz_script', 'emali_quiz_vars', array(
        'emali_quiz_ajax_url' => admin_url( 'admin-ajax.php' ),
      )
  );
}
add_action('wp_enqueue_scripts', 'emali_ajax_quiz_enque', 100);

function emali_quiz_ajax_question() {

  $title = $_POST['quiz_title'];
  
  
  if(!empty($title)) {
      echo $emali_quiz_question_array($title);
  } else {
    echo "0";
  }
  die();
}

add_action('wp_ajax_emali_quiz_question', 'emali_quiz_ajax_question');
add_action('wp_ajax_nopriv_emali_quiz_question', 'emali_quiz_ajax_question');

//$emali_quiz_question_array = array(
//        "emali_quiz"=>array(
//        "Question 1"=>"A colleague is trying to complete an administration task assigned to them by the Director, while a child is actively seeking their attention by tugging on their clothes and making loud distracting noises. Do you",
//        "Question 2"=>"A colleague has invited you to join the social club event next week, it will be a fun team building event on a Saturday morning, do you:",
//        "Question 3"=>"The marketing team has asked you to send them photos for Facebook for “National Hug a friend Day” You initially had said yes, but your shift finishes in 10 minutes and you now can’t see how you would have time to complete this task – do you:",
//        "Question 4"=>"It has been a long week, it is currently Friday at 4.00pm. The children have asked you to play with them in the sandpit for the last part of the day, you really don’t have the energy - do you:"
//        )
//);
//
//$emali_quiz_option_array =  array(
//    "emali_quiz"=>array(
//        "Question 1"=>array(
//        "Option"=>array(
//            "1"=>"Look at your team member and think 'I am so glad that is not me!",
//            "2"=>"Ask your collogue if they would like some assistance with the admin task.",
//            "3"=>"Actively engage with the child and seek to remove them form the situation."
//            )
//            ),
//        "Question 2"=>array(
//        "Option"=>array(
//            "1"=>"Tell them you are busy and you don’t like to attend activities with work people after hours.",
//            "2"=>"Tell them you would love to join them!",
//            "3"=>"Tell them you will check your calendar for the day, but you know that you won't."
//            )
//            ),
//        "Question 3"=>array(
//        "Option"=>array(
//            "1"=>"Ask a fellow team member to assist you with the photo opportunity and get it done just in time.",
//            "2"=>"Ignore the request as you were busy all day and the Marketing team should understand this was not your priority.",
//            "3"=>"Explain to the Marketing team that you were unable to complete the task just before you leave for the day."
//            )
//            ),
//        "Question 4"=>array(
//        "Option"=>array(
//            "1"=>"Take the children out to the sandpit and let them play while you supervise – they are getting what they want and you get to have a minutes rest. Win/win",
//            "2"=>"Tell the children that there will be no mote time in the sandpit today and encourage them to read a book indoors.",
//            "3"=>"Happily go and play with the children in the sandpit encouraging them to build a castle with you, you know this type of play is great for developing the children’s fine motor skills and you know you can rest over the weekend!"
//            )
//            ),
//        )
//);
//
//$emali_quiz_answer_array =  array(
//    "emali_quiz"=>array(
//        "Question 1"=>array(
//            "1"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "2"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "3"=>'{"result":"success","hint":"Yes! Teamwork is a very important part of our Emali culture, and we like to support our co-workers whenever we can!"}'
//            ),
//        "Question 2"=>array(
//            "1"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "2"=>'{"result":"success","hint":"Yes! FUN is an important value at Emali and we like to build strong relationships and have FUN with our co-workers."}',
//            "3"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}'
//            ),
//        "Question 3"=>array(
//            "1"=>'{"result":"success","hint":"Yes! Being reliable is essential at Emali, we all work as a team to get our work complete for the day, being reliable is an easy way to show respect to other team members – which is also an Emali value!"}',
//            "2"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "3"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}'
//            ),
//        "Question 4"=>array(
//            "1"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "2"=>'{"result":"fail","hint":"not quite in the Emali spirit, would you like to re-try this question?"}',
//            "3"=>'{"result":"success","hint":"Yes! Being engaging is one of the most important parts of working with children, and as one of our values it is very important to us!"}'
//            ),
//        )
//);

$emali_quiz_content = file_get_contents(__DIR__ ."/emali-quiz.json");
$emali_quiz_json = json_decode($emali_quiz_content,true);
$emali_quiz_answer_array = $emali_quiz_json["emali_quiz_answer"];

function emali_quiz_ajax_answer() {

  $title = $_POST['quiz_title'];
  $id = $_POST['question_id'];
  $value = $_POST['question_value'];
  
  
  if(!empty($title)) {
      global $emali_quiz_answer_array;
      $answers = $emali_quiz_answer_array[$title];
      $answer = $answers[$id];
      $result = $answer[$value];
      echo $result;
  } else {

  }
  die();
}

add_action('wp_ajax_emali_quiz_answer', 'emali_quiz_ajax_answer');
add_action('wp_ajax_nopriv_emali_quiz_answer', 'emali_quiz_ajax_answer');