<?php
/**
 * db
 * :: Database configurations
 */
return [
    'host' => $_ENV['MYSQL_HOSTNAME'],
    'username' => $_ENV['MYSQL_ROOT_USERNAME'],
    'password' => $_ENV['MYSQL_ROOT_PASSWORD'],
    'database' => $_ENV['MYSQL_DATABASE']
]
?>