<?php

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

class Config {
    private static $instance = null;
    private $dbConfig = [];

    private function __construct() {
        // Determine if we are running in AWS EC2 or locally
        $isLocal = getenv('APP_ENV') === 'local';

        if ($isLocal) {
            // Load local environment variables
            $this->dbConfig = [
                "host" => getenv('DB_HOST') ?: 'localhost',
                "port" => getenv('DB_PORT') ?: 5432,
                "user" => getenv('DB_USER') ?: 'localuser',
                "pass" => getenv('DB_PASS') ?: 'cs4640LocalUser!',
                "database" => getenv('DB_NAME') ?: 'example'
            ];
        } else {
            // Fetch secrets from AWS Secrets Manager
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
                    "host" => $credentials['DB_HOST'] ?? 'localhost',
                    "port" => $credentials['DB_PORT'] ?? 5432,
                    "user" => $credentials['DB_USER'] ?? 'localuser',
                    "pass" => $credentials['DB_PASS'] ?? 'cs4640LocalUser!',
                    "database" => $credentials['DB_NAME'] ?? 'example'
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
