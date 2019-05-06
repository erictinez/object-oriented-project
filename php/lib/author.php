<?php
// setup require_onces, namespaces (make sure to include both autoloaders
// use the new keyword to call the constructor in the class and add all required parameters
//  var_dump() the result from the step above
require_once(dirname( __DIR__) . "/vendor/autoload.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");
use Emartinez451\ObjectOrientedProject\Author;
$authorId = new Author("f805a6fb-83c8-4690-bcb2-19b170cfc8f8", "kimura.com", "0abf9d115769410ab1d55e0acec5f8b0", "kimura19@gmail.com", "erictinez", '$argon2i$v=19$m=1024,t=384,p=2$T1B6Ymdqa3FJdmZqaDdqYg$hhyC1jf2WjbgfD8Jp6GZE9Tg3IpsYpXKm2VWYOJq8LA');
var_dump($authorId);