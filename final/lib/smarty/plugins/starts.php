<?php
	function smarty_function_printStars($nStars){
    $i = 0;   
    for (; $i < $nStars; $i++){
      echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>' ;
    }
    for (; $i < 5; $i++){
      echo '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>' ;
    }
  }
?>