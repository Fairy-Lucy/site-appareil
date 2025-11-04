<?php
class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {

            $envPath = __DIR__ . '.env';

            if (!file_exists($envPath)) {
                die("Fichier .env introuvable à l'emplacement : $envPath");
            }

            $env = parse_ini_file($envPath);

            $host = $env['DB_HOST'] ?? 'localhost';
            $dbname = $env['DB_NAME'] ?? 'appareil_photo';
            $username = $env['DB_USER'] ?? 'postgres';
            $password = $env['DB_PASS'] ?? '';

            try {
                self::$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
