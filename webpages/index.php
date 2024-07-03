<?php
$hostname = $_SERVER['HTTP_HOST'];
printf("Site is online!\n");
printf("curl me for request headers: https://$hostname/headers\n");
?>