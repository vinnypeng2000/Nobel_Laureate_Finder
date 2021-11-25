<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
      require 'simpleform.php';
      break; 
   case '/simpleform.php':     // if you plan to also allow a URL with the file name 
      require 'simpleform.php';
      break;              
   case '/helloworld.php':
      require 'helloworld.php';
      break;
   default:
      http_response_code(404);
      exit('Not Found');
}  
?>

<?php echo "Hello World @^_^@" ?>




