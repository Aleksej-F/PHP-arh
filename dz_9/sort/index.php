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

function shakerSort ($array) {
   $n = count($array);
   $left = 0;
   $right = $n - 1;
   do {
   for ($i = $left; $i < $right; $i++) {
   if ($array[$i] > $array[$i + 1]) {
   list($array[$i], $array[$i + 1]) = array($array[$i + 1], $array[$i]);
   }
   }
   $right -= 1;
   for ($i = $right; $i > $left; $i--) {
   if ($array[$i] < $array[$i - 1]) {
   list($array[$i], $array[$i - 1]) = array($array[$i - 1], $array[$i]);
   }
   }
   $left += 1;
   } while ($left <= $right);
}

function quickSort($arr, $low, $high) {
   $i = $low;                
   $j = $high;
   $middle = $arr[ ( $low + $high ) / 2 ];   // middle – опорный элемент; в нашей реализации он находится посередине между low и high
   do {
       while($arr[$i] < $middle) ++$i;  // Ищем элементы для правой части
        while($arr[$j] > $middle) --$j;   // Ищем элементы для левой части
           if($i <= $j){           
// Перебрасываем элементы
           $temp = $arr[$i];
           $arr[$i] = $arr[$j];
           $arr[$j] = $temp;
// Следующая итерация
           $i++; $j--;
       }
   }
   while($i < $j);
   
   if($low < $j){
// Рекурсивно вызываем сортировку для левой части
     quickSort($arr, $low, $j);
   }

   if($i < $high){
// Рекурсивно вызываем сортировку для правой части
     quickSort($arr, $i, $high);
   }
}




function sorti($fubct, $arr) {
   
   //print_r( $arr);
   //echo  "<br>";
   $start_time=microtime(true);
   $hhh = $fubct($arr);
   //echo  "<br>";
   $end_time=microtime(true);
   $time = $end_time-$start_time;
   echo "$fubct - ($time) <br>";
};


function heapify($arr, $countArr, $i)
{
$largest = $i; // Инициализируем наибольший элемент как корень
$left = 2*$i + 1; // левый = 2*i + 1
$right = 2*$i + 2; // правый = 2*i + 2

// Если левый дочерний элемент больше корня
if ($left < $countArr && $arr[$left] > $arr[$largest])
 $largest = $left;

//Если правый дочерний элемент больше, чем самый большой элемент на данный момент
if ($right < $countArr && $arr[$right] > $arr[$largest])
 $largest = $right;

// Если самый большой элемент не корень
if ($largest != $i)
{
 $swap = $arr[$i];
 $arr[$i] = $arr[$largest];
 $arr[$largest] = $swap;

 // Рекурсивно преобразуем в двоичную кучу затронутое поддерево
 heapify($arr, $countArr, $largest);
}
}

//Основная функция, выполняющая пирамидальную сортировку
function heapSort($arr)
{
$countArr = count($arr);
// Построение кучи (перегруппируем массив)
for ($i = $countArr / 2 - 1; $i >= 0; $i--)
 heapify($arr, $countArr, $i);

//Один за другим извлекаем элементы из кучи
for ($i = $countArr-1; $i >= 0; $i--)
{
 // Перемещаем текущий корень в конец
 $temp = $arr[0];
 $arr[0] = $arr[$i];
 $arr[$i] = $temp;

 // вызываем процедуру heapify на уменьшенной куче
 heapify($arr, $i, 0);
}
}

function ShellSort($elements) {
   $k=0;
  $length = count($elements);
   $gap[0] = (int) ($length / 2);

    while($gap[$k] > 1) {
        $k++;
        $gap[$k]= (int)($gap[$k-1] / 2);
    }

    for($i = 0; $i <= $k; $i++){
        $step = $gap[$i];
        
        for($j = $step; $j < $length; $j++) {
            $temp = $elements[$j];
            $p = $j - $step;
         
            while($p >= 0 && $temp['price'] < $elements[$p]['price']) {
                $elements[$p + $step] = $elements[$p];
                $p = $p - $step;
            }
         
            $elements[$p + $step] = $temp;
        }
    }

    return $elements;
}






$n= 5000;
$arr = getArray($n); 
sorti('bubbleSort',$arr);
sorti('shakerSort', $arr);
sorti('heapSort', $arr);
sorti('ShellSort', $arr);

$start_time=microtime(true);
$hhh = quickSort($arr, 0, $n);
$end_time=microtime(true);
$time = $end_time-$start_time;
echo "quickSor - ($time) <br>";




//$dir = new DirectoryIterator(realpath($path)); 
