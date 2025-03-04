<?php

    //les includes
    include './GenericController.php';
    

    //creation de la classe ControllerAccount
    class ControllerAccount extends GenericController{

        //ATTRIBUT
        private ?ViewAccount $viewAccount;
        

        //CONSTRUCTOR
        public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?ViewAccount $viewAccount) {
            //attribut de la classe GenericController sinon ne s'affiche pas dans cette page
            $this->setViewHeader($header);
            $this->setViewFooter($footer);
            $this->viewAccount = $viewAccount;
        }

        //GETTER SETTER
        public function getViewAccount(): ?ViewAccount {
            return $this->viewAccount;
        }

        public function setViewAccount(?ViewAccount $viewAccount): ControllerAccount {
            $this->viewAccount = $viewAccount;
            return $this;
        }


        //METHOD 
        

        public function render(): void {

            // Je vérifie qu'il existe une session
            if(isset($_SESSION["id"]) && !empty($_SESSION["id"])) {

            //Je remplis les variables d'affichage (nickname, email) avec le contenu de la Session
            $nickname = $_SESSION["nickname"];
            $email = $_SESSION["email"];
        
            }
    
            // Appel de la fonction displayView() et faire le rendu

            //getViewHeader renvoie déjà le header donc pas besoin de setHeader ici
            echo $this->getViewHeader()->displayView();

            //on peut cumuler les flèches plutot que faire deux lignes
            echo $this->getViewAccount()->setNickname($nickname)->displayView();
            echo $this->getViewAccount()->setEmail($email)->displayView();

            //idem que getViewHeader
            echo $this->getViewFooter()->displayView();
            
            //! Ne pas oublier de mettre l'echo ici vu que c'est un void
            //! void = echo   string = return
        }
    }

    