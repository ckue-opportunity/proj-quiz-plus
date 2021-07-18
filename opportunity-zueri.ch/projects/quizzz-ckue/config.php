<?php
// start session and initialize achieved number of points
session_start();

// Preset paths to standard include folders (concat them with PATH_SEPARATOR)
$incPaths  = $_SERVER['DOCUMENT_ROOT'] . '/php';
$incPaths .= PATH_SEPARATOR;
$incPaths .= $_SERVER['DOCUMENT_ROOT'] . '/projects/quizzz-ckue/php';
set_include_path($incPaths);

// Includes required for all page templates
include 'auth.php';
include 'db-access.php';

// Tracing
define('TRACE_DB_ACCESS', false);