<?php


    //cretation de la classe ControllerTask
    class ControllerTask extends GenericController { 
        //ATTRIBUT
        private ?ViewTask $viewTask;
        private ?ModelTask $modelTask;

        //CONSTRUCTOR
        public function __construct(?ViewTask $viewTask, ?ModelTask $modelTask) {
            //on ajoute les attributs de la classe GenericController sinon ne s'affiche pas dans cette page
            $this->setViewHeader(new ViewHeader());
            $this->setViewFooter(new ViewFooter());
            $this->viewTask = $viewTask;
            $this->modelTask = $modelTask;
        }

        //GETTER SETTER
        public function getViewTask(): ?ViewTask {
                return $this->viewTask;
        }

        public function setViewTask(?ViewTask $viewTask): ControllerTask {
                $this->viewTask = $viewTask;
                return $this;
        }

        public function getModelTask(): ?ModelTask {
            return $this->modelTask;
        }

        public function setModelTask(?ModelTask $modelTask): ControllerTask {
                $this->modelTask = $modelTask;
                return $this;
        }

        //METHOD
        public function addTask():string {

            //Vérifier si le formulaire est submit
            if(isset($_POST["submitTask"])) {

                //Vérifier que les données ne soient pas vides
                if(empty($_POST["name_task"])) {
                    return "Veuillez remplir la nouvelle tâche !";
                }

                //Nettoyer les données avec la fonction sanitize()
                $nameTask = sanitize($_POST["name_task"]);
                $contentTask = sanitize($_POST["content_task"]);

                //6_ vérifier que l'utilisateur n'existe pas déjà dans la BDD par son mail en appelant la fonction qui est dans modelUseer
                //6.1_ donner le nom et la description au model
                $this->getModelTask()->setNameTask($nameTask);
                $this->getModelTask()->setContentTask($contentTask);


                //! voir comment mettre en place ceci car la tache s'enregistre plusieurs fis quand on actualise la page
                //6.2_demander au model d'utiliser getByName()
                $data = $this->getModelTask()->getByName();

                //6.3_ Vérifier si les données sont vides ou non
                if(!empty($data)) {
                    return "Cette tâche existe déjà.";
                }


                //je demande au model d'utiliser add() pour ajouter la tache
                $data = $this->getModelTask()->add();

                //je retourne le message de confirmation
                return $data;

        }
        return "";
        }

        public function readTask():string {

            //1_ demander au model d'utiliser getAll()
            $data = $this->getModelTask()->getAll();
            
            //variable d'affichage
            $tasksList = "";

            //2_boucler sur le tableau utilisateur
            //chaque ligne sera conservé dans user (si ça peut t'aider à retenir foreach)
            foreach ($data as $task) {
                $tasksList = $tasksList."<li>{$task['name_task']} : {$task['content_task']}</li>";
            }
            //4_ on retourne $usersList 
            return $tasksList;
        }

        public function render(): void {

            //lancement du traitement des données
            $message = $this->addTask();
            $tasksList = $this->readTask();
    
            // Appel de la fonction displayView() et faire le rendu
            //! Ne pas oublier de mettre l'echo ici vu que c'est un void
            //! void = echo   string = return

            //getViewHeader renvoie déjà le header donc pas besoin de setHeader ici
            echo $this->getViewHeader()->displayView();

            //on peut cumuler les flèches plutot que faire deux lignes
            echo $this->getViewTask()->setMessage($message)->setTasksList($tasksList)->displayView(); 
            
            //idem que getViewHeader
            echo $this->getViewFooter()->displayView();
        }
    }

    
