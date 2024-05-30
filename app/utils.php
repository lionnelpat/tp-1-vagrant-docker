<?php 

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  function dd($value){
    echo "<pre>";
    var_dump(($value));
    echo "<pre>";
    die();
  }

