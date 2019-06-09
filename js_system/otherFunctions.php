<?php
  function getUserDetails($id) {
    $con = new PDO('mysql:dbname=fsn_mdt;host=fsn.life', 'fsn_mdt', 'hInCI73Sl6Z75Y65');
    foreach($con->query("SELECT * from users WHERE `id` = ".$id) as $usr) {
      $user = Array();
      $user['rpname'] = $usr['rpname'];
      $user['role'] = $usr['role'];
      $user['username'] = $usr['username'];
      return $user;
    }
  }

  function formatReport($str) {
    $str = str_replace('#REPL101', '<', $str);
    $str = str_replace('#REPL102', '>', $str);
    return $str;
  }
?>
