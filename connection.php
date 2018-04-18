<?php

  $server = "localhost";
  $database = "test";
  $username = "root";
  $password = "fcbarcelona123";

  $connection = mysqli_connect($server, $username, $password, $database);
  if (mysqli_connect_errno()) {
    return "connection doesn't established";
  } else {
    return $connection;
  }