<?php
    //MODEL POUR LA TABLE JOUEURS
    class ModelPlayer {

        //ATTRIBUTS
        private ?int $id;
        private ?string $pseudo;
        private ?string $email;
        private ?int $score;
        private ?string $password;
        private ?PDO $bdd;

        //CONSTRUCTOR
        public function __construct(?string $pseudo, ?string $email, ?int $score, ?string $password, ?PDO $bdd) {
            $this->pseudo = $pseudo;
            $this->email = $email;
            $this->score = $score;
            $this->password = $password;
            $this->bdd = connect();
        }

        //GETTER SETTER
        public function getId(): ?int {
            return $this->id;
        }

        public function setId(?int $id): ModelPlayer {
            $this->id = $id;
            return $this;
        }

        public function getPseudo(): ?string {
            return $this->pseudo;
        }

        public function setPseudo(?string $pseudo): ModelPlayer {
            $this->pseudo = $pseudo;
            return $this;
        }

        public function getEmail(): ?string {
            return $this->email;
        }

        public function setEmail(?string $email): ModelPlayer {
            $this->email = $email;
            return $this;
        }

        public function getScore(): ?int {
            return $this->score;
        }

        public function setScore(?int $score): ModelPlayer {
            $this->score = $score;
            return $this;
        }

        public function getPassword(): ?string {
            return $this->password;
        }

        public function setPassword(?string $password): ModelPlayer {
            $this->password = $password;
            return $this;
        }

        public function getBdd(): ?PDO {
            return $this->bdd;
        }

        public function setBdd(?PDO $bdd): ModelPlayer {
            $this->bdd = $bdd;
            return $this;
        }

    
    }