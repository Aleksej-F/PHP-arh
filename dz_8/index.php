<meta charset="utf-8">
<form enctype="multipart/form-data" action="index.php" method="post">

<?php
// function catalog($directori) {
//    $dir = new DirectoryIterator($directori);
//    //Цикл по содержанию директории
//    foreach ($dir as $item) {
     
//       if($item->isFile()){
//          echo  "файл ". $item . "<br>";
//       } else {
//          echo  $item . "<br>";
//       }
//    }
   
// };

function catalog1($directori) {
   $dir = new RecursiveDirectoryIterator($directori);
   $dirCat = new RecursiveIteratorIterator($dir);
    
   foreach($dirCat as $item) {
      
      if($item->isFile()){
         echo  "файл ". $item . "<br>";
      } else {
         echo  "каталог " . $item . "<br>";
      }
   }
  
};

 catalog1("../1");





//$dir = new DirectoryIterator(realpath($path)); 
