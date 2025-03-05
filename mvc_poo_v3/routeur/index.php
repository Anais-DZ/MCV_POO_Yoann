<?php

//activer la session
session_start();

//Include
include './env.php';
include './utils/utils.php';
include './view/viewHeader.php';
include './view/viewFooter.php';
include './controller/GenericController.php';



//1_ Récupérer l'url entrée par l'utilisateur
// il faut parthé REQUEST_URI
$url = parse_url($_SERVER['REQUEST_URI']);

// c'était juste pour voir le tableau
// print_r ($url);

// echo "<br>".$_SERVER['REQUEST_URI'];


//2_ Analyser l'intérieur de l'url pour récupérer le path (path = la partie de l'url se trouvant après le nom de domaine)
$path = isset($url['path']) ? $url['path'] :'/';


//3_ Comparer le path obtenu avec les routes mises en place
switch($path) {

    case '/mvc_poo_v3/routeur/':

        //Include des fichiers spécifiques à la route
        include './model/modelUser.php';
        include './view/viewHome.php';
        include './controllerHome.php';

        $home = new ControllerHome(new ViewHome(), new ModelUser());

        $home->render();

        break;


        case '/mvc_poo_v3/routeur/moncompte':
        //include
        include './view/viewAccount.php';
        include './controllerAccount.php';

        $account = new ControllerAccount(new ViewAccount());

        $account->render();
        break;


        case '/mvc_poo_v3/routeur/mescategories':
        //include
        include './Model/modelCategory.php';
        include './View/viewCategory.php';
        include './controllerCategory.php';

        $category = new ControllerCategory(new ViewCategory(), new ModelCategory());

        $category->render();
        break;


        case '/mvc_poo_v3/routeur/maliste':
        //include
        include './view/viewTask.php';
        include './model/modelTask.php';
        include './controllerTask.php';

        //j'instance un nouvel objet controller, ici $tache avec les attributs de ControllerTask (qui hérite aussi de ceux de GenericController)
        $tache = new ControllerTask(new ViewTask(),new ModelTask());

        //lancer la methode render() 
        $tache->render();

        //page erreur 404   
        default:
        echo'<h1>404 NOT FOUND<h1>';
        break; 
}