<?php

    //les includes
    include './GenericController.php';
    
    //création class ControllerHome
    class ControllerHome extends GenericController{

        //ATTRIBUT
        private ?ViewHome $viewHome;
        private ?ModelUser $modelUser;

        //CONSTRUCTOR
        public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?ViewHome $viewHome, ?ModelUser $modelUser) {
            //attribut de la classe GenericController sinon ne s'affiche pas dans cette page
            $this->setViewHeader($header);
            $this->setViewFooter($footer);
            $this->viewHome = $viewHome;
            $this->modelUser = $modelUser;
        }

        //GETTER SETTER
        public function getViewHome(): ?ViewHome {
                return $this->viewHome;
        }

        public function setViewHome(?ViewHome $viewHome): ControllerHome {
                $this->viewHome = $viewHome;
                return $this;
        }

        public function getModelUser(): ?ModelUser {
            return $this->modelUser;
        }

        public function setModelUser(?ModelUser $modelUser): ControllerHome {
                $this->modelUser = $modelUser;
                return $this;
        }

        //METHOD
        public function signIn():string {

            //1_ Vérifier si le formulaire est submit
            if(isset($_POST["submit"])) {

            //2_ Vérifier que les données ne soient pas vides
            //cette méthode est plus simple et plus propre que la méthode laetita
            if(empty($_POST["nickname"]) || empty($_POST["email"]) || empty($_POST["psswrd"])) {
                return 'Remplissez tous les champs.';
            }

            //3_ Vérifier le format de l'email
            if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                return "L'email n'est pas au bon format";
            }

            //4_ Nettoyer les données avec la fonction sanitize()
            $nickname = sanitize($_POST["nickname"]);
            $email = sanitize($_POST["email"]);
            $psswrd = sanitize($_POST["psswrd"]);

            //5_ hasher le mot de passe
            $psswrd = password_hash($psswrd, PASSWORD_BCRYPT);


            //6_ vérifier que l'utilisateur n'existe pas déjà dans la BDD par son mail en appelant la fonction qui est dans modelUseer
            //6.1_ donner l'email au model
            $this->getModelUser()->setEmail($email);

            //6.2_demander au model d'utiliser getByEmail()
            $data = $this->getModelUser()->getByEmail();

            //6.3_ Vérifier si les données sont vides ou non
            if(!empty($data)) {
                return "Cet email est déjà utilisé par un utilisateur.";
            }
                        
            //7_ si l'utilisateur n'est pas dans la base de données, on l'ajoute
            //7.1_ donner le pseudo et le mot de passe au model (l'email a déjà été setté plus haut au 6.1)
            $this->getModelUser()->setNickname($nickname)->setPsswrd($psswrd);
            
            //7.2_ demander au model d'utiliser add()
            $data=$this->getModelUser()->add();

            //8_ retourne message de confirmation
            return $data;
        }
        return "";
        }

        public function signUp():string {

            //variable d'affichage
            $messageConnexion="";

            //1_ Vérifier si le formulaire est submit
            if(isset($_POST["submit"])) {

                //2_ Vérifier que les données ne soient pas vides
                //cette méthode est plus simple et plus propre que la méthode laetita
                if(empty($_POST["email"]) || empty($_POST["psswrd"])) {
                    return 'Remplissez tous les champs.';
                }
        
                //3_ Vérifier le format de l'email
                if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    return "L'email n'est pas au bon format";
                }
        
                //4_ Nettoyer les données avec la fonction sanitize()
                $email = sanitize($_POST["email"]);
                $psswrd = sanitize($_POST["psswrd"]);
        
                //5_ vérifier que l'utilisateur existe dans la BDD par son mail en appelant la fonction qui est dans modelUseer
                //5.1_ donner l'email au model
                $this->getModelUser()->setEmail($email);

                //5.2_demander au model d'utiliser getByEmail()
                $data = $this->getModelUser()->getByEmail();
        
                //6.3_ Vérifier si les données sont vides ou non
                if(empty($data)) {
                    return "Cet email n'existe pas.";
                }
        
                if (!password_verify($psswrd, $data[0]["psswrd"])) {
                    return "Login ou mot de passe incorrect";
                }

                // J'enregistre l'id, le nickname et l'email dans la super-globale $_SESSION
                $_SESSION["id"] = $data[0]["id"];
                $_SESSION["nickname"] = $data[0]["nickname"];
                $_SESSION["email"] = $data[0]["email"];
                
                return $messageConnexion;
            }

            return "";
        }
        

        public function readUsers():string {

            //1_ demander au model d'utiliser getAll()
            $data = $this->getModelUser()->getAll();
            
            //variable d'affichage
            $usersList = "";

            //2_boucler sur le tableau utilisateur
            //chaque ligne sera conservé dans user (si ça peut t'aider à retenir foreach)
            foreach ($data as $user) {
                //3_ on met en forme les données
                $usersList = $usersList ."<li>{$user['nickname']} - {$user['email']}</li>";
            }
            //4_ on retourne $usersList 
            return $usersList;
        }

        public function render(): void {

            //lancement du traitement des données
            $message = $this->signIn();
            $usersList = $this->readUsers();
            $messageConnexion = $this->signUp();
    
            // Appel de la fonction displayView() et faire le rendu
            //! Ne pas oublier de mettre l'echo ici vu que c'est un void
            //! void = echo   string = return

            //getViewHeader renvoie déjà le header donc pas besoin de setHeader ici
            echo $this->getViewHeader()->displayView();

            //on peut cumuler les flèches plutot que faire deux lignes
            echo $this->getViewHome()->setMessage($message)->setUsersList($usersList)->setMessageConnexion($messageConnexion)->displayView(); 
            
            //idem que getViewHeader
            echo $this->getViewFooter()->displayView();
        }
    }

    //j'instance un nouvel objet controller, ici $home avec les attributs de ControllerHome (qui hérite aussi de ceux de GenericController)
    $home = new ControllerHome(new ViewHeader(), new ViewFooter(),new ViewHome(),new ModelUser());

    //lancer la methode render() 
    $home->render();

   
    