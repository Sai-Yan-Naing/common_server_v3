<?php
 if( ! isset($_COOKIE['admin']) )
 {
     header("location: /login");
 }