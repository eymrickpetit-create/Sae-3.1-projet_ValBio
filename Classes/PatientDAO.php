<?php

class PatientDAO extends DAO {

    public function getOne(string|int|array $key): Patient {
        $stmt = $this->pdo->prepare("SELECT * FROM patient WHERE identifiantPa = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Patient($row);
    }

    public function getOneByNoSS(string|int|array $key): Patient {
        $stmt = $this->pdo->prepare("SELECT * FROM patient WHERE NoSS = ?");
        $stmt->execute(array($key));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            throw new OutOfBoundsException("Aucun patient trouvé.");
        }

        return new Patient($row);
    }

    public function getAll(): array {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM patient ORDER BY identifiantPa");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $res[] = new Patient($row);
        }
        return $res;
    }

    public function insert(object $obj): int {
        $cols = [
            'NoSS', 'NomPa', 'PrenomPa', 'SexePa', 'NomUsagePa',
            'AdressePa', 'CodePa', 'LocalitePa', 'TelephonePa',
            'DateNaissPa', 'ProfessionPa', 'ValidDroitPa', 'ResteChargePrctPa'
        ];
        $params = [];

        foreach ($cols as $c) {
            $params[$c] = $obj->getFields()[$c] ?? null;
        }

        $stmt = $this->pdo->prepare("INSERT INTO patient (
            NoSS, NomPa, PrenomPa, SexePa, NomUsagePa,
            AdressePa, CodePa, LocalitePa, TelephonePa,
            DateNaissPa, ProfessionPa, ValidDroitPa, ResteChargePrctPa
        ) VALUES (
            :NoSS, :NomPa, :PrenomPa, :SexePa, :NomUsagePa,
            :AdressePa, :CodePa, :LocalitePa, :TelephonePa,
            :DateNaissPa, :ProfessionPa, :ValidDroitPa, :ResteChargePrctPa
        )");
        $stmt->execute($params);
        return 0;
    }

    public function update(object $obj): int {
        $stmt = $this->pdo->prepare("UPDATE patient SET
            NoSS=:NoSS, NomPa=:NomPa, PrenomPa=:PrenomPa, SexePa=:SexePa, NomUsagePa=:NomUsagePa,
            AdressePa=:AdressePa, CodePa=:CodePa, LocalitePa=:LocalitePa, TelephonePa=:TelephonePa,
            DateNaissPa=:DateNaissPa, ProfessionPa=:ProfessionPa, ValidDroitPa=:ValidDroitPa,
            ResteChargePrctPa=:ResteChargePrctPa
            WHERE identifiantPa=:identifiantPa");
        $res = $stmt->execute($obj->getFields());
        return 0;
    }

    public function delete(object $obj): int {
        $stmt = $this->pdo->prepare("DELETE FROM patient WHERE identifiantPa=?");
        $res = $stmt->execute(array($obj->identifiantPa));
        return 0;
    }
}