<?php
        class ModelCategory{
                //ATTRIBUT
                private ?int $id;
                private ?string $name;
                private ?PDO $bdd;
                
                //CONSTRUCTEUR
                public function __construct(){
                        $this->bdd = connect();
                }

                //GETTER ET SETTER
                public function getId(): ?int { return $this->id; }
                public function setId(?int $id): self { $this->id = $id; return $this; }

                public function getName(): ?string { return $this->name; }
                public function setName(?string $name): self { $this->name = $name; return $this; }

                public function getBdd(): ?PDO { return $this->bdd; }
                public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }

                //METHOD
                public function add():string{

                        try{
                                //Recupérer les donnée à enregistrer
                                $name = $this->getName();

                                //Préparer la requête
                                $req=$this->getBdd()->prepare('INSERT INTO category(`name_category`) VALUES (?)');

                                //Binding de Param
                                $req->bindParam(1,$name,PDO::PARAM_STR);

                                //Exécution de la requête
                                $req->execute();

                                //Retourne le message de confirmation
                                return "La catégorie $name a été enregistrée avec succès.";

                        }catch(EXCEPTION $error){
                                return $error->getMessage();
                        }
                }

                public function getAll():array | string{
                        try{
                                //Preparer la requête
                                $req=$this->getBdd()->prepare('SELECT id, `name_category` FROM category');

                                //J'exécute la requête
                                $req->execute();

                                //Je récupère la réponse de la BDD
                                $data = $req->fetchAll(PDO::FETCH_ASSOC);

                        //Je renvoie les données
                        return $data;
                                }catch(EXCEPTION $error){
                        return $error->getMessage();
                        }
                }

                public function getByName():array | string{
                        try{
                                //Récupérer le nom de la catégorie
                                $name = $this->getName();

                                //Preparer la requête
                                $req=$this->getBdd()->prepare('SELECT id, `name_category` FROM category WHERE `name_category` = ?');

                                //Binding de Param
                                $req->bindParam(1,$name,PDO::PARAM_STR);

                                //J'exécute la requête
                                $req->execute();

                                //Je récupère la réponse de la BDD
                                $data = $req->fetchAll(PDO::FETCH_ASSOC);

                                //Je renvoie les données
                                return $data;

                        }catch(EXCEPTION $error){
                                return $error->getMessage();
                        }
                }
        }