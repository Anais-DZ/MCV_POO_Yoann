<?php

//creation class ViewHome
    class ViewHome {
        //comme on aura pas de constructeur ici car on sait ce qu"on aura une phrase (string), on met une chaine de caractère vide directe dans les attributs
        private ?string $message = "";
        private ?string $usersList ="";
        private ?string $messageConnexion ="";


        //GETTER SETTER
        public function getMessage(): ?string {
            return $this->message;
        }

        public function setMessage(?string $message): ViewHome {
            $this->message = $message;
            return $this;
        }

        public function getUsersList(): ?string {
            return $this->usersList;
        }

        public function setUsersList(?string $usersList): ViewHome {
            $this->usersList = $usersList;
            return $this;
        }

        public function getMessageConnexion(): ?string {
            return $this->messageConnexion;
        }

        public function setMessageConnexion(?string $messageConnexion): ViewHome {
            $this->messageConnexion = $messageConnexion;
            return $this;
        }

        //METHOD 
        public function displayView(): string {
            return 
                '<section>
                    <div class="form-body">
                        <div class="row">
                            <div class="form-holder">
                                <div class="form-content">
                                    <div class="form-items">
                                        <h3>Inscription</h3>
                                        <div>
                                            <form action="" method="post">
                                                <div class="col-md-12">
                                                    <label for="nickname">Votre pseudo</label>
                                                    <input id="nickname" type="text" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="nickname" placeholder="Entrez votre pseudo" required autocomplete="off">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="email">Votre email</label>
                                                    <input id="email" type="text" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="email" placeholder="Entrez votre email" required autocomplete="off">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="psswrd">Votre mot de passe</label>
                                                    <input id="psswrd" type="password" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="psswrd" placeholder="Entrez votre mot de passe" required autocomplete="off">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="psswrd2">Confirmez votre mot de passe</label>
                                                    <input id="psswrd2" type="password" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="psswrd_confirmation" placeholder="Entrez à nouveau votre mot de passe" required autocomplete="off">
                                                </div>
                                                <div class="form-button mt-3">
                                                    <input class="btn btn-primary" type="submit" name="submit" value="Inscription">
                                                </div>
                                            </form>
                                            <p>'.$this->getMessage().'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="form-body">
                        <div class="row">
                            <div class="form-holder">
                                <div class="form-content">
                                    <div class="form-items">
                                        <h3>Connexion</h3>
                                        <div>
                                            <form action="" method="post">
                                                <div class="col-md-12">
                                                    <label for="mail_connexion">Votre adresse mail</label>
                                                    <input id="mail_connexion" type="email" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="emailConnexion" placeholder="Entrez votre email" required autocomplete= "off">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="psswrd_connexion">Votre mot de passe</label>
                                                    <input id="psswrd_connexion" type="password" class="form-control shadow-sm p-3 mb-5 bg-white rounded" name="psswrdConnexion" placeholder="Entrez votre mot de passe" required required autocomplete= "off">
                                                </div>
                                                <div class="form-button mt-3">
                                                    <input class="btn btn-primary" type="submit" name="submitConnexion" value="Se connecter">
                                                </div>
                                            </form>
                                            <p>'.$this->getMessageConnexion().'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2>Liste des utilisateurs</h2>
                        <ul>
                            '.$this->getUsersList().'
                        </ul>
                    </div>
                </section>';      
        }
    }

    // par convention, on écrit {$this->getMessage()} et non $this->message