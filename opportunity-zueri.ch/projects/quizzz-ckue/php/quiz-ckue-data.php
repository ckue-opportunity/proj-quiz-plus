<?php

function qchris_data() {
    return array(
        'introduction' => qchris_introductionData(),
        'questions' => qchris_questionData(),
        'report' => qchris_reportData()
    );
}

function qchris_introductionData() {
    return array(
        'title' => "My First Quiz",
        'description' => "Just do it ...",
        'imageURL' => "/images/bild.jpg",
        'nextAction' => 'question.php',
        'questionID' => 'q0'
    );
}

function qchris_questionData() {
    return array(
        'q0' => qchris_q0(),
        'q1' => qchris_q1()
    );
}

function qchris_q0() {
    return array(
        'text' => "What kind of an animal is a Woodpecker?",
        'answers' => array(
            array("Reptile", 0),
            array("Mammal", 0),
            array("Bird", 1)
        ),
        'nextAction' => 'question.php',
        'questionID' => 'q1'
    );
}

function qchris_q1() {
    return array(
        'text' => "How many wings has a beetle?",
        'answers' => array(
            array(2, 0),
            array(4, 1),
            array(8, 0)
        ),
        'nextAction' => 'report.php'
    );
}

function qchris_reportData() {
    return array(
        'title' => "Congratulations",
        'text' => "That was a spiffy performance!",
        'feedback_40' => "lousy",
        'feedback_60' => "mediocre",
        'feedback_80' => "super!!!",
        'imageURL' => "bild.jpg"
    );
}

?>