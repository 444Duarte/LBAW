<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.stars.php
 * Type:     function
 * Name:     pintStars
 * Purpose:  prints stars
 * -------------------------------------------------------------
 */
	function smarty_function_print_stars($params, &$smarty){
    $nStars = $params['nStars'];

    $i = 0;   
    for (; $i < $nStars; $i++){
      echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>' ;
    }
    for (; $i < 5; $i++){
      echo '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>' ;
    }
  }
?>