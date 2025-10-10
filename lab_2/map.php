<?php

function kvadrat ($n){
    return $n*$n;
}

$numbers = [1,2,3,4,5,6,7];
$kvadrat_numbers = array_map('kvadrat', $numbers);
print_r($kvadrat_numbers);
?>