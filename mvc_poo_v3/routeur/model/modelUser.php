<?php

//création de la class ModelUser
    class ModelUser {

        //ATTRIBUTS
        private ?int $id;
        private ?string $nickname;
        private ?string $email;
        private ?string $psswrd;
        private ?PDO $bdd;

        //CONSTRUCTOR
        public function __construct() {
            $this->bdd = connect();
        }

        //GETTER SETTER
        public function getId(): ?int {
            return $this->id;
        }

        public function setId(?int $id): ModelUser {
            $this->id = $id;
            return $this;
        }

        public function getNickname(): ?string {
            return $this->nickname;
        }

        public function setNickname(?string $nickname): ModelUser {
            $this->nickname = $nickname;
            return $this;
        }

        public function getEmail(): ?string {
            return $this->email;
        }

        public function setEmail(?string $email): ModelUser {
            $this->email = $email;
            return $this;
        }

        public function getPsswrd(): ?string {
            return $this->psswrd;
        }

        public function setPsswrd(?string $psswrd): ModelUser {
            $this->psswrd = $psswrd;
            return $this;
        }

        public function getBdd(): ?PDO {
            return $this->bdd;
        }

        public function setBdd(?PDO $bdd): ModelUser {
            $this->bdd = $bdd;
            return $this;
        }

        //METHOD

        //fonction qui ajoute un user dans la bb
        public function add():string {
            try {

                //envoi de la requête sql avec la methode prepare() ($bdd est remplacé par $this->getBdd())
                $req = $this->getBdd()->prepare("INSERT INTO users(nickname, email, psswrd) VALUES (?, ?, ?)");

                //Récupération des données depuis l'objet
                //il faut faire les get ici car bindParam ne les prend pas en compte
                $nickname= $this->getNickname();
                $email= $this->getEmail();
                $psswrd= $this->getPsswrd();


                //binding des paramètres pour les remplacer les "?"
                $req->bindParam(1, $nickname, PDO::PARAM_STR);
                $req->bindParam(2, $email, PDO::PARAM_STR);
                $req->bindParam(3, $psswrd, PDO::PARAM_STR);

                //exécuter la requête avec execute()
                $req->execute();

                //message de confirmation
                return "L'enregistrement de $nickname (email : $email) a été effectué avec succès.";

            } catch(EXCEPTION $error) {
                //en cas de problème, je récupère le message d'erreur et je l'affiche
                return $error->getMessage();
            }
        }

        public function getAll(): string | array {
            try {

                //préparer la requête SELECT, toujours avec $this->getBdd()
                $req = $this->getBdd()->prepare('SELECT id, nickname, email, psswrd FROM users');
    
                //exécute la requête
                $req->execute();
    
                //récupère les données de la BDD de la requête
                $data = $req->fetchAll(PDO::FETCH_ASSOC);
                
                //retourne le tableau
                return $data;
    
            }catch(EXCEPTION $error) {
                return $error->getMessage();
            }
        }

        public function getByEmail(): string | array {
            try {

                //il faut faire les get ici car bindParam ne les prend pas en compte
                $email= $this->getEmail();

                //préparer la requête
                $req = $this->getBdd()->prepare("SELECT id, nickname, email, psswrd FROM users WHERE email = ? LIMIT 1 ");

                //Binding de param
                $req->bindParam(1, $email, PDO::PARAM_STR);

                //exécute la requête
                $req->execute();

                //récupère les données de la BDD de la requête
                $data = $req->fetchAll(PDO::FETCH_ASSOC);

                //retourne le tableau
                return $data;
        
            } catch(EXCEPTION $error) {
                return $error->getMessage();
            }
        }
    }
