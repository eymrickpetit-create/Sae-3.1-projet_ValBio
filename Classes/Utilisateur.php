<?php
class Utilisateur extends TableObject {

public function verifyPassword(string $pwd): bool {
    return password_verify($pwd, $this->MotDePasse);
}


}