<?php

class Database {
    private $dbConnector;
    private $config;

    public function __construct(Config $config) {
        $this->config = $config;

        $host = $this->config->getDbConfig()['host'];
        $user = $this->config->getDbConfig()['user'];
        $database = $this->config->getDbConfig()['database'];
        $password = $this->config->getDbConfig()['pass'];
        $port = $this->config->getDbConfig()['port'];

        $this->dbConnector = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");
    }

    public function query($query, ...$params) {
        $res = pg_query_params($this->dbConnector, $query, $params);

        if ($res === false) {
            echo pg_last_error($this->dbConnector);
            return false;
        }

        return pg_fetch_all($res);
    }
}
