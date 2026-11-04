<?php

class PrescripteurDAO extends DAO {



public function getOne(string|int|array $key): Prescripteur {
    $stmt = $this->pdo->prepare("SELECT * FROM prescripteur WHERE NoPrecripteur = ?");
    $stmt->execute(array($key));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return new Fournisseur($row);
}

public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM fournisseur ORDER BY code_frs");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row)
            $res[] = new Fournisseur($row);
        return $res;
    }

}
