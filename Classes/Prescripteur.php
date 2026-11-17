<?php
class Prescripteur extends TableObject {

    public function getNo(): string { return $this->NoPrecripteur; }    
    public function getType(): string { return $this->TypePrescripteur; }
    public function getAddr(): string { return $this->AdressePres; }
    public function getNom(): string { return $this->nomPres; }
    public function getCode(): string { return $this->CodePres; }
    public function getLoc(): string { return $this->LocalitePres; }
    public function getTel(): string { return $this->TelephonePres; }
    


}