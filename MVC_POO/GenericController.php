<?php

    // Je démarre ma $_SESSION pour pouvoir y accéder
    session_start();

    //include
    include './env.php';
    include './utils/utils.php';
    include './model/modelUser.php';
    include './model/modelTask.php';
    include './view/viewHeader.php';
    include './view/viewFooter.php';
    include './view/viewHome.php';
    include './view/viewAccount.php';
    include './view/viewTask.php';

    //creation de la classe GenericController
    class GenericController {

        //ATTRIBUT
        private ?ViewHeader $header;
        private ?ViewFooter $footer;

        //CONSTRUCTOR
        public function __construct(?ViewHeader $header, ?ViewFooter $footer) {
            $this->header = $header;
            $this->footer = $footer;
        }

        //GETTER SETTER 
        public function getViewHeader(): ?ViewHeader {
            return $this->header;
        }

        public function setViewHeader(?ViewHeader $header): GenericController {
                $this->header = $header;
                return $this;
        } 

        public function getViewFooter(): ?viewFooter {
                return $this->footer;
        }

        public function setViewFooter(?viewFooter $footer): GenericController {
                $this->footer = $footer;
                return $this;
        }
    }