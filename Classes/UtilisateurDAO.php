<?php

class UtilisateurDAO extends DAO {



    public function getOne(string|int|array $key): Utilisateur {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE LoginU = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
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
    $cols = ['LoginU', 'MotDePasse', 'RoleUser'];
    $params = [];
    $fields = $obj->getFields();          // appelé une seule fois
    foreach ($cols as $c) {
        $params[$c] = $fields[$c] ?? null;
    }

    // hachage du mot de passe avant l'insertion
    if ($params['MotDePasse'] !== null) {
        $params['MotDePasse'] = password_hash($params['MotDePasse'], PASSWORD_DEFAULT);
    }

    $stmt = $this->pdo->prepare(
        "INSERT INTO utilisateur (LoginU, MotDePasse, RoleUser)
         VALUES (:LoginU, :MotDePasse, :RoleUser)"
    );
    $stmt->execute($params);

    return $stmt->rowCount();             // 1 si la ligne a été insérée
}


    public function update(object $obj): int {
        $cols = ['LoginU', 'MotDePasse', 'RoleUser'];
        $fields = $obj->getFields();
        $params = [];
        foreach ($cols as $c) {
            $params[$c] = $fields[$c] ?? null;
        }

        // ne hache que si ce n'est pas déjà un hash
        if ($params['MotDePasse'] !== null
            && password_get_info($params['MotDePasse'])['algo'] === null) {
            $params['MotDePasse'] = password_hash($params['MotDePasse'], PASSWORD_DEFAULT);
        }

        $stmt = $this->pdo->prepare(
            "UPDATE utilisateur
            SET MotDePasse = :MotDePasse, RoleUser = :RoleUser
            WHERE LoginU = :LoginU"
        );
        $stmt->execute($params);

        return $stmt->rowCount();
    }

    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE LoginU=?");
        $res = $stmt->execute(array($obj->LoginU));
        return 0;
    }

   


}
