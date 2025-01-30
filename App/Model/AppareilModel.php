<?php
require_once "Database.php";

class AppareilModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
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
    public function getTotalAppareils() {
        $query = "SELECT COUNT(*) FROM appareils_photo";
        return $this->db->query($query)->fetchColumn();
    }

    public function getAppareilsParPays() {
        $query = "SELECT pays, COUNT(*) as count FROM appareils_photo GROUP BY pays";
        return $this->db->query($query)->fetchAll(PDO::FETCH_KEY_PAIR);
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

    public function getAnneePlusAncienne() {
        $query = "SELECT MIN(annee_debut) FROM appareils_photo";
        return $this->db->query($query)->fetchColumn();
    }

    public function getAppareilById($id) {
        $stmt = $this->db->prepare("SELECT * FROM appareils_photo WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAnneePlusRecente() {
        $query = "SELECT MAX(annee_fin) FROM appareils_photo";
        return $this->db->query($query)->fetchColumn();
    }
}
