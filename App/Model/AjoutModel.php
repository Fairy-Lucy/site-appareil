<?php
require_once "Database.php";

class AjoutModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getFabricants() {
        $sql = "SELECT DISTINCT fabricant FROM appareils_photo";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getModelesParFabricant($fabricant) {
        $sql = "SELECT id, nom_appareil AS nom 
            FROM appareils_photo 
            WHERE fabricant = :fabricant";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':fabricant' => $fabricant]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getDetailsModele($fabricant, $modele) {
        $sql = "SELECT ap.pays, ap.annee_debut, ap.annee_fin, d.contenu AS description
            FROM appareils_photo ap
            LEFT JOIN descriptions d ON ap.description_id = d.id
            WHERE ap.fabricant = :fabricant AND ap.nom_appareil = :modele
            LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':fabricant' => $fabricant, ':modele' => $modele]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function ajouterAppareil($fabricant, $nom, $pays, $debut, $fin, $commentaire, $description) {

        $modele = $fabricant . " " . $nom;

        // Vérifie si la description existe déjà
        $descriptionId = $this->getDescriptionId($modele);
        if (!$descriptionId) {
            $descriptionSql = "INSERT INTO descriptions (modele, contenu) VALUES (:modele, :contenu) RETURNING id";
            $descriptionStmt = $this->db->prepare($descriptionSql);
            $descriptionStmt->execute([':modele' => $modele, ':contenu' => $description]);
            $descriptionId = $descriptionStmt->fetchColumn();
        }

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

    private function getDescriptionId($modele) {
        $sql = "SELECT id FROM descriptions WHERE modele = :modele";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':modele' => $modele]);
        return $stmt->fetchColumn();
    }
}
