<?php

// __________Checking 1-19999
$txtmp = "Key12345";

function getTime($time = false)
{
    return $time === false ? microtime(true) : round(microtime(true) - $time, 3);
}

function binSearch($fileName, $reqKey) {
  $file=new SplFileObject($fileName);

  $left = 0;
  $right = sizeof(file($fileName)) - 1;

  while ($left <= $right) { 
    $position = floor(($left + $right) / 2); 
    $file->seek($position);

    $elem = explode("\t", $file->current());
    $strnatcmp = strnatcmp($elem[0],$reqKey);
    if ($strnatcmp>0) {
      $right = $position-1;
    }elseif($strnatcmp<0) {
      $left = $position+1;
    }else {
      return $elem[1];
    }
  }
  return 'undef';
}

define("FILENAME","test\genX.txt");
define ("VAL",$txtmp);

$time = getTime();
$result = binSearch(FILENAME,VAL);
$time = getTime($time);

echo "Искомое - <br>".$result."<br>"."Время -<br>".$time." сек.<br>";

?>