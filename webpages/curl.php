<?php
/*
  Author: Brandyn Koehler
  Date: July 2, 2024
  License: MIT
*/

// Variables
$maxHeader = 0;
$maxValue = 0;
$maxPost = 0;
$column1 = 15;
$column2 = 40;
$requestHeaders = apache_request_headers();

// Calculate max header length and value length
foreach ($requestHeaders as $Header => $Value) {
    if ( $maxHeader < strlen($Header)) {
        $maxHeader = strlen($Header);
    }

    if ( $maxValue < strlen($Value)) {
        $maxValue = strlen($Value);
    }
}

if ($maxHeader < strlen("Request Headers")) {
    $maxHeader = strlen("Request Headers");
}

// function to make N hyphens for formatting
function makeHyphens($length) {
    return str_repeat('-', $length);
}

// Project title
print "
            \033[0;34m_
\033[0;31m__   __\033[0;32m_ __\033[0;34m| |__    \033[0;0m View Request Headers
\033[0;31m\ \ / /\033[0;32m  __|\033[0;34m _  \   \033[0;0m https://github.com/b-rito/view-request-headers
\033[0;31m \ V /\033[0;32m| |  \033[0;34m| | | |
\033[0;31m  \_/ \033[0;32m|_|  \033[0;34m|_| |_|\033[0;0m\n\n
";

//////////////////////////////////////////////////////////
// Hostname
// Outline
printf("\033[0;90m+ %s + %s +\033[0;0m\n", makeHyphens($column1), makeHyphens($column2));

// Date time
printf("\033[0;90m|\033[0;0m");
printf("\033[0;32m %-{$column1}s \033[0;0m", "Date");
printf("\033[0;90m=\033[0;0m");
printf("\033[0;93m %-{$column2}s \033[0;0m",  date(DATE_RFC2822));
printf("\033[0;90m|\033[0;0m");
printf("\n");

// Hostname information
printf("\033[0;90m|\033[0;0m");
printf("\033[0;32m %-{$column1}s \033[0;0m", "Hostname");
printf("\033[0;90m=\033[0;0m");
printf("\033[0;93m %-{$column2}s \033[0;0m", gethostname());
printf("\033[0;90m|\033[0;0m");
printf("\n");

// Request Method information
printf("\033[0;90m|\033[0;0m");
printf("\033[0;32m %-{$column1}s \033[0;0m", "Request Method");
printf("\033[0;90m=\033[0;0m");
printf("\033[0;93m %-{$column2}s \033[0;0m", $_SERVER['REQUEST_METHOD']);
printf("\033[0;90m|\033[0;0m");
printf("\n");

// Request URI information
printf("\033[0;90m|\033[0;0m");
printf("\033[0;32m %-{$column1}s \033[0;0m", "Request URI");
printf("\033[0;90m=\033[0;0m");
printf("\033[0;93m %-{$column2}s \033[0;0m", $_SERVER['REQUEST_URI']);
printf("\033[0;90m|\033[0;0m");
printf("\n");

// Outline
printf("\033[0;90m+ %s + %s +\033[0;0m\n", makeHyphens($column1), makeHyphens($column2));

//////////////////////////////////////////////////////////
// Request Headers
// Outline
printf("\033[0;90m+ %s + %s +\033[0;0m\n", makeHyphens($maxHeader), makeHyphens($maxValue));

// Title
printf("\033[0;90m|\033[0;0m");
printf("\033[0;0m %-{$maxHeader}s \033[0;0m", "Request Headers");
printf("\033[0;90m|\033[0;0m");
printf("\033[0;0m %-{$maxValue}s \033[0;0m", "Request Values");
printf("\033[0;90m|\033[0;0m");
printf("\n");

// Outline
printf("\033[0;90m+ %s + %s +\033[0;0m\n", makeHyphens($maxHeader), makeHyphens($maxValue));

// Output all Request Header-Values received
foreach ($requestHeaders as $Header => $Value) {
    printf("\033[0;90m\033[0;32m %-{$maxHeader}s  ", $Header);
    printf("\033[0;90m:\033[0;93m %-{$maxValue}s ", $Value);
    printf("\033[0;90m\n");
}

// Outline
printf("\033[0;90m+ %s + %s +\033[0;0m\n", makeHyphens($maxHeader), makeHyphens($maxValue));

////////////////////////////////////////////////////////////
// POST data
// Variable for max POST size formatting, same length as Requests
$maxPost = $maxHeader + $maxValue + 3;

// Determine if POST is Form based or RAW and output
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (empty($_POST)) {
        $postData = file_get_contents('php://input');
            printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
            printf("\033[0;90m|\033[0;0m");
            printf("\033[0;0m %-{$maxPost}s \033[0;0m", "POST Form");
            printf("\033[0;90m|\033[0;0m\n");
            printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
            printf("\033[0;0m  %-{$maxPost}s \033[0;0m\n", $postData);
            printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
    } else {
        printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
        printf("\033[0;90m|\033[0;0m");
        printf("\033[0;0m %-{$maxPost}s \033[0;0m", "POST Form");
        printf("\033[0;90m|\033[0;0m\n");
        printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
        print_r( $_POST);
        printf("\033[0;90m+ %s +\033[0;0m\n", makeHyphens($maxPost));
    }
}
?>