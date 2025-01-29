<?php
require_once "Database.php";

class AppareilModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function ajouterAppareil($nom, $pays, $debut, $fin, $commentaire) {
        $sql = "INSERT INTO appareils_photo (nom_appareil, pays, annee_debut, annee_fin, remarques, date_ajout) 
                VALUES (:nom, :pays, :debut, :fin, :commentaire, NOW())";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom' => $nom,
            ':pays' => $pays,
            ':debut' => $debut,
            ':fin' => $fin,
            ':commentaire' => $commentaire
        ]);
    }

    public function getAllCountries() {
        $query = "SELECT DISTINCT pays FROM appareils_photo ORDER BY pays";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppareilsByCountry($pays) {
        $stmt = $this->db->prepare("SELECT * FROM appareils_photo WHERE pays = ? ORDER BY annee_debut DESC");
        $stmt->execute([$pays]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
