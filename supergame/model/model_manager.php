<?php

    //je fais l'include de ce qu'a besoin ManagerPlayer pour fonctionner
    include '../env.php';
    include './model_joueurs.php';

    //pas d'attribut pour ManagerPlayer


    //contruction class ManagerPlayer
    class ManagerPlayer extends ModelPlayer {



        //METHOD
        //fonction qui ajoute un joueur dans la bdd
        public function addPlayer():string {
            try {

                //envoi de la requête sql avec la methode prepare()
                $req = $this->getBdd()->prepare("INSERT INTO players (pseudo, email, score, psswrd) VALUES (?, ?, ?, ?)");

                //Récupération des données depuis l'objet
                //il faut faire les get ici car bindParam ne les prend pas en compte
                $pseudo= $this->getPseudo();
                $email= $this->getEmail();
                $score= $this->getScore();
                $password= $this->getPassword();


                //binding des paramètres pour remplacer les "?"
                $req->bindParam(1, $pseudo, PDO::PARAM_STR);
                $req->bindParam(2, $email, PDO::PARAM_STR);
                $req->bindParam(3, $score, PDO::PARAM_INT);
                $req->bindParam(4, $password, PDO::PARAM_STR);

                //exécuter la requête avec execute()
                $req->execute();

                //message de confirmation
                return "L'enregistrement du joueur: $pseudo (email : $email) a été effectué avec succès.";

            } catch(EXCEPTION $error) {
                //en cas de problème, je récupère le message d'erreur et je l'affiche
                return $error->getMessage();
            }
        }

        //fonction qui récupère la liste de tous les joueurs
        public function getPlayers(): string | array {
            try {

                //préparer la requête SELECT, toujours avec $this->getBdd()
                $req = $this->getBdd()->prepare('SELECT id, pseudo, email, score, psswrd FROM players');
    
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

        //fonction qui récupère les données d'un seul joueur grâce à son mail
        public function getPlayersByEmail(): string | array {
            try {

                //il faut faire les get ici car bindParam ne les prend pas en compte
                $email= $this->getEmail();

                //préparer la requête
                $req = $this->getBdd()->prepare("SELECT id, pseudo, email, score, psswrd FROM players WHERE email = ? LIMIT 1 ");

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