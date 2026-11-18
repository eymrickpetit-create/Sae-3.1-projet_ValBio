<?php

class PrescripteurDAO extends DAO {



    public function getOne(string|int|array $key): Prescripteur {
        $stmt = $this->pdo->prepare("SELECT * FROM prescripteur WHERE NoPrecripteur = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Prescripteur($row);
    }

    public function getOneByPhone(string|int|array $key): Prescripteur {
        $stmt = $this->pdo->prepare("SELECT * FROM prescripteur WHERE TelephonePres = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
        throw new OutOfBoundsException("Aucun prescripteur trouvé.");
        }
        
        return new Prescripteur($row);
    }

    public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM prescripteur ORDER BY NoPrecripteur");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Prescripteur($row);
        return $res;
    }

    public function insert(object $obj): int {
        // rempli params avec les champs ou null si non definis
        $cols = ['TypePrescripteur', 'AdressePres', 'NomPres', 'CodePres', 'LocalitePres', 'TelephonePres'];
        $params = [];

        
        foreach ($cols as $c) {
            $params[$c] = $obj->getFields()[$c] ?? null;
        }

       $stmt =  $this->pdo->prepare("INSERT INTO prescripteur (TypePrescripteur, AdressePres, NomPres, CodePres, LocalitePres, TelephonePres)
        VALUES (:TypePrescripteur, :AdressePres, :NomPres, :CodePres, :LocalitePres, :TelephonePres)");
       $stmt->execute($params);
       return  0;
    }

    public function update(object $obj): int {
       $stmt = $this->pdo->prepare("UPDATE prescripteur SET 
       TypePrescripteur=:TypePrescripteur, AdressePres=:AdressePres, NomPres=:NomPres, CodePres=:CodePres, LocalitePres=:LocalitePres, TelephonePres=:TelephonePres
       WHERE NoPrecripteur=:NoPrecripteur");
       $res = $stmt->execute($obj->getFields());
       return 0;
    }

    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM prescripteur WHERE NoPrecripteur=?");
        $res = $stmt->execute(array($obj->NoPrecripteur));
        return 0;
    }


}
