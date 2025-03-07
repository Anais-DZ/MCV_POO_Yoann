<!-- VUE DE LA PAGE D'ACCUEIL -->

<?php

    //creation class ViewHome
    class ViewHome {
        //nous n'aurons pas de constructeur ici car nous savons que nous aurons une phrase (string), donc nous mettons directement une chaine de caractère vide dans les attributs
        private ?string $message = "";
        private ?string $playersList ="";


        //GETTER SETTER
        public function getMessage(): ?string {
            return $this->message;
        }

        public function setMessage(?string $message): ViewHome {
            $this->message = $message;
            return $this;
        }

        public function getPlayersList(): ?string {
            return $this->playersList;
        }

        public function setPlayersList(?string $playersList): ViewHome {
            $this->playersList = $playersList;
            return $this;
        }



        //METHOD

        //Fonction pour afficher l'html
        public function displayView(): string {
            return "
            
            <section>
                <form action='' method='post'>
                    <div>
                        <label for='pseudo'>pseudo</label>
                        <input id='pseudo' type='text' name='pseudo' placeholder='Entrez le pseudo' required autocomplete='off'>
                    </div>
                    <div>
                        <label for='email'>email</label>
                        <input id='email' type='text' name='email' placeholder='Entrez l'email' required autocomplete='off'>
                    </div>
                    <div>
                        <label for='score'>score</label>
                        <input id='score' type='number' name='score' placeholder='Entrez le score' required autocomplete='off'>
                    </div>
                    <div>
                        <label for='psswrd'>Votre mot de passe</label>
                        <input id='psswrd' type='password' name='psswrd' placeholder='Entrez le mot de passe' required autocomplete='off'>
                    </div>
                    <div>
                        <input class='btn btn-primary' type='submit' name='submit' value='Inscription'>
                    </div>
                </form>
                <p>{$this->getMessage()}</p>
                <h2>Liste des utilisateurs</h2>
                        <ul>
                            {$this->getPlayersList()}
                        </ul>
            </section>";
        }
    }