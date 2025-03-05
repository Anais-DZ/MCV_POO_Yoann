<?php

    //creation de la classe ControllerAccount
    class ControllerAccount extends GenericController{

        //ATTRIBUT
        private ?ViewAccount $viewAccount;
        

        //CONSTRUCTOR
        public function __construct(?ViewAccount $viewAccount) {
            //on ajoute les attributs de la classe GenericController sinon ne s'affiche pas dans cette page
            $this->setViewHeader(new ViewHeader());
            $this->setViewFooter(new ViewFooter());
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

            // Je vérifie qu'il existe une session connectée
            if(!isset($_SESSION["id"])) {
                //si pas de session connectée, redirection vers la page d'accueil
                header('location:./controllerHome.php');
                exit;
            }

            //si session connectée, j'affiche les différentes vue
            //! Ne pas oublier de mettre l'echo ici vu que c'est un void
            //! void = echo   string = return
            echo $this->getViewHeader()->displayView();
            echo $this->getViewAccount()->displayView();
            echo $this->getViewFooter()->displayView();
             
        }
    }


    