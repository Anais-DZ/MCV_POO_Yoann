<?php

//creation class ViewTask
    class ViewTask {
        //comme on aura pas de constructeur ici car on sait ce qu'on aura une phrase (string), on met une chaine de caractère vide directe dans les attributs
        private ?string $message = "";
        private ?string $tasksList ="";


        //GETTER SETTER
        public function getMessage(): ?string {
            return $this->message;
        }

        public function setMessage(?string $message): ViewTask {
            $this->message = $message;
            return $this;
        }

        public function getTasksList(): ?string {
            return $this->tasksList;
        }

        public function setTasksList(?string $tasksList): ViewTask {
            $this->tasksList = $tasksList;
            return $this;
        }

        //METHOD 
        public function displayView(): string {
            return 
            "<section>
                <div class='form-body'>
                    <div class='row'>
                        <div class='form-holder'>
                            <div class='form-content'>
                                <div class='form-items'>
                                    <h3>Liste des tâches</h3>
                                    <div>
                                        <ul class='listTask'>
                                            {$this->getTasksList()}
                                        </ul>
                                        <form action='' method='post'>
                                            <div class='col-md-12'>
                                                <label for='tache'>Nouvelle tâche</label>
                                                <input id='tache' type='text' class='form-control shadow-sm p-3 mb-5 bg-white rounded' name='name_task' placeholder='Entrer votre nouvelle tâche' required>
                                            </div>
                                            <div class='col-md-12'>
                                                <label for='description'>Description de la tâche</label>
                                                <textarea id='description' class='form-control shadow-sm p-3 mb-5 bg-white rounded' name='content_task' placeholder='Décrivez la tâche' rows='2'></textarea>
                                            </div>
                                            <div class='form-button mt-3'>
                                                <input class='btn btn-primary' type='submit' name='submitTask' value='Ajouter la tâche'>
                                            </div>
                                        </form>
                                        <p>{$this->getMessage()}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>";
        }
    } 

    //boostrap avec form_body pose probleme