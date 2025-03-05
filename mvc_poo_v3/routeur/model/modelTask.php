<?php

//création de la class MModelTask
    class ModelTask {

        //ATTRIBUTS
        private ?int $idTask;
        private ?string $nameTask;
        private ?string $contentTask;        
        private ?PDO $bdd;

        //CONSTRUCTOR
        public function __construct() {
            $this->bdd = connect();
        }

        //GETTER SETTER
        public function getIdTask(): ?int {
            return $this->idTask;
        }

        public function setIdTask(?int $idTask): ModelTask {
            $this->idTask = $idTask;
            return $this;
        }

        public function getNameTask(): ?string {
            return $this->nameTask;
        }

        public function setNameTask(?string $nameTask): ModelTask {
            $this->nameTask = $nameTask;
            return $this;
        }

        public function getContentTask(): ?string {
            return $this->contentTask;
        }

        public function setContentTask(?string $contentTask): ModelTask {
            $this->contentTask = $contentTask;
            return $this;
        }

        public function getBdd(): ?PDO {
            return $this->bdd;
        }

        public function setBdd(?PDO $bdd): ModelTask {
            $this->bdd = $bdd;
            return $this;
        }

        //METHOD

        //fonction qui ajoute un user dans la bb
        public function add():string {
            try {

                //envoi de la requête sql avec la methode prepare() ($bdd est remplacé par $this->getBdd())
                $req = $this->getBdd()->prepare("INSERT INTO tasks(name_task, content_task) VALUES (?, ?)");

                //Récupération des données depuis l'objet
                //il faut faire les get ici car bindParam ne les prend pas en compte
                $nameTask= $this->getNameTask();
                $contentTask= $this->getContentTask();

                //binding des paramètres pour les remplacer les "?"
                $req->bindParam(1, $nameTask, PDO::PARAM_STR);
                $req->bindParam(2, $contentTask, PDO::PARAM_STR);

                //exécuter la requête avec execute()
                $req->execute();

                //message de confirmation
                return "L'enregistrement de la tâche : $nameTask, a été effectué avec succès.";

            } catch(EXCEPTION $error) {
                //en cas de problème, je récupère le message d'erreur et je l'affiche
                return $error->getMessage();
            }
        }

        public function getAll(): string | array {
            try {

                //préparer la requête SELECT, toujours avec $this->getBdd()
                $req = $this->getBdd()->prepare('SELECT id_task, name_task, content_task FROM tasks');
    
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

        public function getByName(): string | array {
            try {

                //il faut faire les get ici car bindParam ne les prend pas en compte
                $nameTask= $this->getNameTask();

                //préparer la requête
                $req = $this->getBdd()->prepare("SELECT id_task, name_task, content_task FROM tasks WHERE name_task = ? LIMIT 1 ");

                //Binding de param
                $req->bindParam(1, $nameTask, PDO::PARAM_STR);

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