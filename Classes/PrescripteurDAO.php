<?php

class PrescripteurDAO extends DAO {



    public function getOne(string|int|array $key): Prescripteur {
        $stmt = $this->pdo->prepare("SELECT * FROM prescripteur WHERE NoPrecripteur = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Prescripteur($row);
    }

    public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM prescripteur ORDER BY NoPrecripteur");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Prescripteur($row);
        return rowCount();
    }

    public function insert(object $obj): int {
        // rempli params avec les champs ou null si non definis
        $cols = ['NoPrecripteur', 'TypePrescripteur', 'AdressePres', 'nomPres', 'CodePres', 'LocalitePres', 'TelephonePres'];
        $params = [];
        foreach ($cols as $c) {
            $params[$c] = $obj->getFields()[$c] ?? null;
        }
       $stmt =  $this->pdo->prepare("INSERT INTO prescripteur (NoPrecripteur, TypePrescripteur, AdressePres, nomPres, CodePres, LocalitePres, TelephonePres)
        VALUES (:NoPrecripteur, :TypePrescripteur, :AdressePres, :nomPres, :CodePres, :LocalitePres, :TelephonePres)");
       $res = $stmt->execute($params);
       return rowCount();
    }

    public function update(object $obj): int {
       $stmt = $this->pdo->prepare("UPDATE prescripteur SET 
       TypePrescripteur=:TypePrescripteur, AdressePres=:AdressePres, nomPres=:nomPres, CodePres=:CodePres, LocalitePres=:LocalitePres, TelephonePres=:TelephonePres
       WHERE NoPrecripteur=:NoPrecripteur");
       $res = $stmt->execute($obj->getFields());
       return $owCount();
    }

    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM prescripteur WHERE NoPrecripteur=?");
        $res = $stmt->execute(array($obj->NoPrecripteur));
        return rowCount();
    }


}
