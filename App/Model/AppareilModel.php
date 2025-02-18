<?php
require_once "Database.php";

class AppareilModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
    public function ajouterAppareil($fabricant, $nom, $pays, $debut, $fin, $commentaire, $description) {
        $modele = $fabricant . " " . $nom;
        $descriptionSql = "INSERT INTO descriptions (modele, contenu) VALUES (:modele, :contenu) RETURNING id";
        $descriptionStmt = $this->db->prepare($descriptionSql);
        $descriptionStmt->execute([
            ':modele' => $modele,
            ':contenu' => $description
        ]);

        $descriptionId = $descriptionStmt->fetchColumn();

        $sql = "INSERT INTO appareils_photo (fabricant, nom_appareil, pays, annee_debut, annee_fin, date_ajout, remarques, description_id) 
            VALUES (:fabricant, :nom, :pays, :debut, :fin, NOW(), :commentaire, :description_id)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':fabricant' => $fabricant,
            ':nom' => $nom,
            ':pays' => $pays,
            ':debut' => $debut,
            ':fin' => $fin,
            ':commentaire' => $commentaire,
            ':description_id' => $descriptionId
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
    public function getAppareilsParAnnee() {
        $query = "SELECT annee_debut, COUNT(*) as count FROM appareils_photo GROUP BY annee_debut ORDER BY annee_debut";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getImagesByAppareilId($id) {
        $stmt = $this->db->prepare("SELECT chemin FROM images_appareil WHERE appareil_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getDescriptionById($descriptionId) {
        $stmt = $this->db->prepare("SELECT contenu FROM descriptions WHERE id = ?");
        $stmt->execute([$descriptionId]);
        return $stmt->fetchColumn();
    }

    public function getAppareilByFabricant($fabricant)
    {
        $stmt = $this->db->prepare("SELECT * FROM appareils_photo WHERE fabricant = ? ORDER BY annee_debut DESC");
        $stmt->execute([$fabricant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppareilsParFabricant() {
        $sql = "SELECT * FROM appareils_photo ORDER BY fabricant, nom_appareil";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
