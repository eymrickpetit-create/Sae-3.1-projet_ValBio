<?php

class UtilisateurDAO extends DAO {

    public function getOne(string|int|array $key): Utilisateur {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE LoginU = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            throw new OutOfBoundsException('Utilisateur introuvable');
        }
        return new Utilisateur($row);
    }

    public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM utilisateur ORDER BY LoginU");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Utilisateur($row);
        return 0;
    }

    public function insert(object $obj): int {
        // rempli params avec les champs ou null si non definis
        $cols = ['LoginU', 'MotDePasse', 'RoleUser'];
        $params = [];
        foreach ($cols as $c) {
            $params[$c] = $obj->getFields()[$c] ?? null;
        }
       $stmt =  $this->pdo->prepare("INSERT INTO utilisateur (LoginU, MotDePasse, RoleUser)
        VALUES (:LoginU, :MotDePasse, :RoleUser)");
       $res = $stmt->execute($params);
       return 0;
    }

    public function update(object $obj): int {
       $stmt = $this->pdo->prepare("UPDATE utilisateur SET 
       MotDePasse=:MotDePasse, RoleUser=:RoleUser
       WHERE LoginU=:LoginU");
       $res = $stmt->execute($obj->getFields());
       return 0;
    }

    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE LoginU=?");
        $res = $stmt->execute(array($obj->LoginU));
        return 0;
    }


}
