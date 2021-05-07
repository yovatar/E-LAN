<?php

function getConfig()
{
    return  [
        "database" => [
            "driver" => 'mysql',
            "hostname"=>'localhost',
            "port"=>3306,
            "charset" => 'utf8',
            "name" => 'databaseName',
            "username"=>'user',
            "password"=>'Pa$$w0rd'
        ]
    ];
}
