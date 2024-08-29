<?php

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

class Config {
    private static $instance = null;
    private $dbConfig = [];

    private function __construct() {
        $isLocal = getenv('APP_ENV') === 'local';

        if ($isLocal) {
            $this->dbConfig = [
                "host" => getenv('host') ?: 'localhost',
                "port" => getenv('port') ?: 5432,
                "user" => getenv('username') ?: 'localuser',
                "pass" => getenv('password') ?: 'cs4640LocalUser!',
                "database" => getenv('dbInstanceIdentifier') ?: 'example'
            ];
        } else {
            $secretName = 'prod/PourPro/postgres-1';
            $client = new SecretsManagerClient([
                'version' => 'latest',
                'region'  => 'us-east-2'
            ]);

            try {
                $result = $client->getSecretValue([
                    'SecretId' => $secretName
                ]);

                $secret = $result['SecretString'];
                $credentials = json_decode($secret, true);

                $this->dbConfig = [
                    "host" => $credentials['host'] ?? 'localhost',
                    "port" => $credentials['port'] ?? 5432,
                    "user" => $credentials['username'] ?? 'localuser',
                    "pass" => $credentials['password'] ?? 'cs4640LocalUser!',
                    "database" => $credentials['dbInstanceIdentifier'] ?? 'example'
                ];

            } catch (AwsException $e) {
                echo "Error fetching secrets: " . $e->getMessage();
                exit();
            }
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getDbConfig() {
        return $this->dbConfig;
    }
}
