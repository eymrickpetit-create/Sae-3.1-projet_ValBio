<?php
class Patient extends TableObject {

public function getIdentifiantPa(): int
{
    return $this->identifiantPa;
}

public function getNoSS(): string
{
    return $this->NoSS;
}

public function getNomPa(): string
{
    return $this->NomPa;
}

public function getPrenomPa(): string
{
    return $this->PrenomPa;
}

public function getSexePa(): string
{
    return $this->SexePa;
}

public function getNomUsagePa(): ?string
{
    return $this->NomUsagePa;
}

public function getAdressePa(): string
{
    return $this->AdressePa;
}

public function getCodePa(): string
{
    return $this->CodePa;
}

public function getLocalitePa(): string
{
    return $this->LocalitePa;
}

public function getTelephonePa(): string
{
    return $this->TelephonePa;
}

public function getDateNaissPa(): string
{
    return $this->DateNaissPa;
}

public function getProfessionPa(): string
{
    return $this->ProfessionPa;
}

public function getValidDroitPa(): string
{
    return $this->ValidDroitPa;
}

public function getResteChargePrctPa(): float
{
    return $this->ResteChargePrctPa;
}

public static function creer (string $noSS,string $nomPa, string $prenomPa, string $sexePa, ?string $nomUsagePa,string $adressePa, string $codePa, string $localitePa, string $telephonePa, string $dateNaissPa, string $professionPa, string $validDroitPa, string $resteChargePrctPa) {
     $donnees = [
        'NoSS' => $NoSS,
        'NomPa' => $NomPa,
        'PrenomPa' => $PrenomPa,
        'SexePa' => $SexePa,
        'NomUsagePa' => $NomUsagePa,
        'AdressePa' => $AdressePa,
        'CodePa' => $CodePa,
        'LocalitePa' => $LocalitePa,
        'TelephonePa' => $TelephonePa,
        'DateNaissPa' => $DateNaissPa,
        'ValidDroitPa' => $ValidDroitPa,
        'ResteChargePrctPa' => $ResteChargePrctPa
     ];
     
     return new self($donnees);
}
}
