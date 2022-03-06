<meta charset="utf-8">
<form enctype="multipart/form-data" action="index.php" method="post">

<?php

function getArray($n) {
   $arr = [];
   for ($i=0; $i<$n; $i++){
      array_push($arr, rand(1, $n));
   };
   return $arr;
}


$n= 500;
$arr = getArray($n); 
$get = 10;
$m = 0;
while (in_array($get, $arr)){
   $m++;
   $key = array_search($get, $arr); //определение номера элемента массива
   array_splice($arr, $key, 1); // удаление элемента из массива
}
echo "удалено - $m элементов";



