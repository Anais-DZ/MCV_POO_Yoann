<?php

class ControllerCategory extends GenericController{
    //ATTRIBUTS
    private ?ModelCategory $modelCategory;
    private ?ViewCategory $viewCategory;

    //CONSTRUCTEUR
    public function __construct(?ViewCategory $viewCategory, ?ModelCategory $modelCategory){
        $this->setViewHeader(new ViewHeader());
        $this->setViewFooter(new ViewFooter());
        $this->viewCategory = $viewCategory;
        $this->modelCategory = $modelCategory;
    }

    //GETTER ET SETTER
    public function getModelCategory(): ?ModelCategory { return $this->modelCategory; }
    public function setModelCategory(?ModelCategory $modelCategory): self { $this->modelCategory = $modelCategory; return $this; }

    public function getViewCategory(): ?ViewCategory { return $this->viewCategory; }
    public function setViewCategory(?ViewCategory $viewCategory): self { $this->viewCategory = $viewCategory; return $this; }

    //METHOD
    public function addCategory():string{
        //1) Vérifier qu'on reçoit le formulaire
        if(isset($_POST['submitCategory'])){
            //2) Vérifier le champs vide
            if(empty($_POST['nameCategory'])){
                return "Veuillez donner un nom de catégorie.";
            }

            //3) Vérifier le format (pas à faire puisqu'on attend juste une string)

            //4) Nettoyer les données
            $name = sanitize($_POST['name']);

            //5) Vérifier si la categorie existe déjà en bdd
            //5.1) Donner le nom au Model
            $this->getModelCategory()->setName($name);

            //5.2) Je demande de chercher le nom en Bdd
            $data = $this->getModelCategory()->getByName();

            //5.3) Je vérifie si la réponse est vide ou non
            if(!empty($data)){
                return 'Cette catégorie existe déjà.';
            }

            //6) Ajouter la categorie
            $data = $this->getModelCategory()->add();

            //7) Retourner le message de confirmation
            return $data;
        }

        return '';
    }

    public function readCategories():string{
        //1) Récupérer la liste des catégories
        $data = $this->getModelCategory()->getAll();

        //2) Mettre ne forme les donnée grâce à une boucle
        $categoryList = '';

        foreach($data as $category){
            $categoryList = $categoryList."<li>{$category['nameCategory']}</li>";
        }

        //3) retourne les données formatées
        return $categoryList;
    }

    public function render():void{
        //TRAITEMENT DES DONNES
        $message = $this->addCategory();
        $categoryList = $this->readCategories();

        //ON DONNE LES DONNEES A LA VIEW
        $this->getViewCategory()->setMessage($message)->setCategoryList($categoryList);

        //ON FAIT L'AFFICHAGE FINALE
        echo $this->getViewHeader()->displayView();
        echo $this->getViewCategory()->displayView();
        echo $this->getViewFooter()->displayView();
    }
}
