<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/about.php':                   // URL (without file name) to a default screen
      require 'about.php';
      break; 
   case '/home.php':     // if you plan to also allow a URL with the file name 
      require 'home.php';
      break;              
   case '/addPub.php':
      require 'addPub.php';
      break;
   case '/detail.php':
      require 'detail.php';
      break;
   case '/logout.php':
      require 'logout.php';
      break;
   case '/profile.php':
      require 'profile.php';
      break;
   case '/addComment.php':
      require 'addComment.php';
      break;
   case '/addPubSubmit.php':
      require 'addPubSubmit.php';
      break;
   case '/library.php':
      require 'library.php';
      break;
   case '/profileAction.php':
      require 'profileAction.php';
      break;
   case '/search.php':
      require 'search.php';
      break;
   case '/config.php':
      require 'config.php';
      break;
   default:
      http_response_code(404);
      exit('Not Found');
}  
?>
