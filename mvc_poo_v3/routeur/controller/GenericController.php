<?php

    //pas d'include vu que tout est dans index.php

    //creation de la classe GenericController
    class GenericController {

        //ATTRIBUT
        private ?ViewHeader $header;
        private ?ViewFooter $footer;

        //CONSTRUCTOR
        public function __construct() {
            $this->header = new ViewHeader();
            $this->footer = new ViewFooter();
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