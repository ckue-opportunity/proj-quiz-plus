<?php
// start session and initialize achieved number of points
session_start();

// Preset paths to standard include folders (concat them with PATH_SEPARATOR)
$incPaths  = $_SERVER['DOCUMENT_ROOT'] . '/php'; // Site root includes
$incPaths .= PATH_SEPARATOR; // $incPaths = $incPaths . PATH_SEPARATOR;
$incPaths .= $_SERVER['DOCUMENT_ROOT'] . '/projects/quizzz-ckue/php';
set_include_path($incPaths);

// Includes required for all page templates
include 'auth.php';
include 'db-access.php';

// Tracing
define('TRACE_DB_ACCESS', false);

/*
Absolute Pfade, welche mit '/' anfangen:
    HTML: /projects/quizzz-ckue/templates/introduction.php
    
    PHP:  /home/christoph/Documents/projects/proj-quiz-plus/opportunity-zueri.ch/projects/quizzz-ckue/templates/introduction.php
    $_SERVER['DOCUMENT_ROOT'] is /home/christoph/Documents/projects/proj-quiz-plus/opportunity-zueri.ch/
*/