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

function bubbleSort($array) {
   for($i=0; $i<count($array); $i++){
      $count = count($array);
             for($j=$i+1; $j<$count; $j++){
                 if($array[$i]>$array[$j]){
                     $temp = $array[$j];
                     $array[$j] = $array[$i];
                     $array[$i] = $temp;
                 }
            }         
         }
         return $array;
      
}

function LinearSearch ($myArray, $num) {
   $count = count($myArray);
   $n = 0;
   for ($i=0; $i < $count; $i++) {
      $n++;
      if ($myArray[$i] == $num) return [$i, $n];
      elseif ($myArray[$i] > $num) return [null, $n];
   }
   return [null, $n];
}

function binarySearch ($myArray, $num) {
   $n = 0;
   //определяем границы массива
   $left = 0;
   $right = count($myArray) - 1;
   
   while ($left <= $right) {
   $n++;
   //находим центральный элемент с округлением индекса в меньшую сторону
    $middle = floor(($right + $left)/2);
   //если центральный элемент и есть искомый   
    if ($myArray[$middle] == $num) {
       return [$middle, $n];
    }
   
    elseif ($myArray[$middle] > $num) {
   //сдвигаем границы массива до диапазона от left до middle-1
     $right = $middle - 1;
    }
    elseif ($myArray[$middle] < $num) {
     $left = $middle + 1;
   }
}
return [null, $n];
}

function InterpolationSearch($myArray, $num)
{$n=0;
$start = 0;
$last = count($myArray) - 1;

while (($start <= $last) && ($num >= $myArray[$start]) 
&& ($num <= $myArray[$last])) {
   $n++;
 $pos = floor($start + (
   (($last - $start) / ($myArray[$last] - $myArray[$start]))
   * ($num - $myArray[$start])
  ));
 if ($myArray[$pos] == $num) {
  return [$pos, $n];
 }

 if ($myArray[$pos] < $num) {
  $start = $pos + 1;
 }

 else {
  $last = $pos - 1;
 }
}
return [null, $n];
}


   

function sorti($fubct, $arr, $num) {
   $start_time=microtime(true);
   $hhh = $fubct($arr, $num);
   $end_time=microtime(true);
   $time = $end_time - $start_time;
   //echo "$fubct - ($time) <br>";
   echo "$fubct: num - ($hhh[0]), count - ($hhh[1]) <br>";
   //print_r($hhh);
   echo "<br>";
};



$n= 100;
$arr = getArray($n); 
$arr  = bubbleSort($arr);
print_r($arr);

echo " ($arr) <br>";

sorti('LinearSearch', $arr, 10);
sorti('binarySearch', $arr, 10);
sorti('InterpolationSearch', $arr, 10);



