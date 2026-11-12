<?php
class Utilisateur extends TableObject {
    public function getLogin(): string { return $this->LoginU; }

     public function getMotDePasseHash(): string { return $this->MotDePasse; }

    public function getRole(): string { return $this->RoleUser; }

    public function verifierMotDePasse(string $clair): bool {
        return password_verify($clair, $this->MotDePasse);
    }

    public static function creer(string $login, string $clair, string $role): self {
        return new self([
            'LoginU'     => $login,
            'MotDePasse' => password_hash($clair, PASSWORD_DEFAULT),
            'RoleUser'   => role,
        ]);
    }


}