<?php
//CONTROLER DE LA PAGE D'ACCUEIL

    //Je fais les includes nécessaires
        include 'env.php';
        include './utils/utils.php';
        include './model/model_player.php';
        include './model/model_manager.php';
        include './view/view_accueil.php';
        include './view/header.php';
        include './view/footer.php';


        class ControllerHome {

            //ATTRIBUT
            private ?ViewHeader $header;
            private ?ViewFooter $footer;
            private ?ViewHome $viewHome;
            private ?ModelPlayer $modelPlayer;
            private ?ManagerPlayer $managerPlayer;
    
            //CONSTRUCTOR
            public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?ViewHome $viewHome, ?ModelPlayer $modelPlayer, ?ManagerPlayer $managerPlayer) {
                //attribut de la classe GenericController sinon ne s'affiche pas dans cette page
                $this->ViewHeader=$header;
                $this->ViewFooter=$footer;
                $this->viewHome = $viewHome;
                $this->modelPlayer = $modelPlayer;
                $this->managerPlayer = $managerPlayer;
            }
    
            //GETTER SETTER
            
            public function getViewHeader(): ?ViewHeader {
                return $this->header;
            }

            public function setViewHeader(?ViewHeader $header): ControllerHome {
                    $this->header = $header;
                    return $this;
            }

            public function getViewFooter(): ?ViewFooter {
                return $this->footer;
            }

            public function setViewFooter(?ViewFooter $footer): ControllerHome {
                    $this->footer = $footer;
                    return $this;
            }

            public function getViewHome(): ?ViewHome {
                    return $this->viewHome;
            }
    
            public function setViewHome(?ViewHome $viewHome): ControllerHome {
                    $this->viewHome = $viewHome;
                    return $this;
            }
    
            public function getModelPlayer(): ?ModelPlayer {
                return $this->modelPlayer;
            }
    
            public function setModelPlayer(?ModelPlayer $modelPlayer): ControllerHome {
                    $this->modelPlayer = $modelPlayer;
                    return $this;
            }
    
            public function getManagerPlayer(): ?ManagerPlayer {
                return $this->managerPlayer;
            }
    
            public function setManagerPlayer(?ManagerPlayer $managerPlayer): ControllerHome {
                    $this->managerPlayer = $$managerPlayer;
                    return $this;
            }
    
            //METHOD
            public function EnregistrerJoueur():string {
    
                //1_ Vérifier si le formulaire est submit
                if(isset($_POST["submit"])) {
    
                //2_ Vérifier que les données ne soient pas vides
                //cette méthode est plus simple et plus propre que la méthode laetita
                if(empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["score"]) || empty($_POST["psswrd"])) {
                    return 'Remplissez tous les champs.';
                }
    
                //3_ Vérifier le format de l'email
                if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    return "L'email n'est pas au bon format";
                }
    
                //4_ Nettoyer les données avec la fonction sanitize()
                $pseudo = sanitize($_POST["pseudo"]);
                $email = sanitize($_POST["email"]);
                $score = sanitize($_POST["score"]);
                $password = sanitize($_POST["psswrd"]);
    
                //5_ hasher le mot de passe
                $password = password_hash($password, PASSWORD_BCRYPT);
    
    
                //6_ vérifier que l'utilisateur n'existe pas déjà dans la BDD par son mail en appelant la fonction qui est dans modelUseer
                //6.1_ donner l'email au model
                $this->getManagerPlayer()->setEmail($email);
    
                //6.2_demander au model d'utiliser getByEmail()
                $data = $this->getManagerPlayer()->getPlayersByEmail();
    
                //6.3_ Vérifier si les données sont vides ou non
                if(!empty($data)) {
                    return "Cet email est déjà utilisé par un utilisateur.";
                }
                            
                //7_ si l'utilisateur n'est pas dans la base de données, on l'ajoute
                //7.1_ donner le pseudo et le mot de passe au model (l'email a déjà été setté plus haut au 6.1)
                $this->getManagerPlayer()->setPseudo($pseudo)->setScore($score)->setPassword($password);
                
                //7.2_ demander au model d'utiliser add()
                $data=$this->getManagerPlayer()->addPlayer();
    
                //8_ retourne message de confirmation
                return $data;
            }
            return "";
            }

            public function readPlayers():string {

                //1_ demander au model d'utiliser getAll()
                $data = $this->getManagerPlayer()->getPlayers();
                
                //variable d'affichage
                $playersList = "";
    
                //2_boucler sur le tableau utilisateur
                //chaque ligne sera conservé dans user (si ça peut t'aider à retenir foreach)
                foreach ($data as $player) {
                    //3_ on met en forme les données
                    $playersList = $playersList ."<li>{$player['nickname']} - {$player['email']}</li>";
                }
                //4_ on retourne $playersList 
                return $playersList;
            }
    
    
            public function render(): void {
    
                //lancement du traitement des données
                $message = $this->EnregistrerJoueur();
                $playersList = $this->readPlayers();
        
                // Appel de la fonction displayView() et faire le rendu
                //! Ne pas oublier de mettre l'echo ici vu que c'est un void
                //! void = echo   string = return
    
                //getViewHeader renvoie déjà le header donc pas besoin de setHeader ici
                echo $this->getViewHeader()->displayView();
    
                //on peut cumuler les flèches plutot que faire deux lignes
                echo $this->getViewHome()->setMessage($message)->setPlayersList($playersList)->displayView(); 
                
                //idem que getViewHeader
                echo $this->getViewFooter()->displayView();
            }
        }
    
        //j'instance un nouvel objet, ici $player
        $player = new ControllerHome(new ViewHeader(), new ViewFooter(),new ViewHome(),new ModelPlayer(), new ManagerPlayer);
    
        //lancer la methode render() 
        $player->render();
    
       
        
        
?>