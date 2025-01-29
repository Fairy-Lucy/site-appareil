<?php
require_once __DIR__ . "/Database.php";

class AppareilModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function ajouterAppareil($nom, $pays, $debut, $fin, $commentaire) {
        $sql = "INSERT INTO appareils_photo (nom_appareil, pays, annee_debut, annee_fin, remarques, date_ajout) 
                VALUES (:nom, :pays, :debut, :fin, :commentaire, NOW())";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':pays' => $pays,
            ':debut' => $debut,
            ':fin' => $fin,
            ':commentaire' => $commentaire
        ]);
    }
}
?>
