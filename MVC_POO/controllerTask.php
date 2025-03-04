<?php

//les includes
include './GenericController.php';

    //cretation de la classe ControllerTask
    class ControllerTask extends GenericController { 
        //ATTRIBUT
        private ?ViewTask $viewTask;
        private ?ModelTask $modelTask;

        //CONSTRUCTOR
        public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?ViewTask $viewTask, ?ModelTask $modelTask) {
            //attribut de la classe GenericController sinon ne s'affiche pas dans cette page
            $this->setViewHeader($header);
            $this->setViewFooter($footer);
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
                if(empty($_POST["name_task"]) || empty($_POST["content_task"])) {
                    return "Veuillez remplir tous les champs !";
                }

                //Nettoyer les données avec la fonction sanitize()
                $nameTask = sanitize($_POST["name_task"]);
                $contentTask = sanitize($_POST["content_task"]);

                //7_ j'ajoute la tâche et sa description dans la base de données
                $this->getModelTask()->setNameTask($nameTask)->setContentTask($contentTask);


                //je demande au model d'utiliser add()
                $data = $this->getModelTask()->add();

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

    //j'instance un nouvel objet controller, ici $tache avec les attributs de ControllerTask (qui hérite aussi de ceux de GenericController)
    $tache = new ControllerTask(new ViewHeader(), new ViewFooter(),new ViewTask(),new ModelTask());

    //lancer la methode render() 
    $tache->render();
