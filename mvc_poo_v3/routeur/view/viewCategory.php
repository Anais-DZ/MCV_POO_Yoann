<?php

    class ViewCategory {

        //Attribut
        private ?string $message= '';
        private ?string $categoryList= '';

        public function getMessage() {
                    return $this->message;
        }

        public function setMessage($message): self {
                    $this->message = $message;
                    return $this;
        }

        public function getCategoryList() {
                    return $this->categoryList;
        }

        public function setCategoryList($categoryList): self {
                    $this->categoryList = $categoryList;
                    return $this;
        }
        

        public function displayView()  {

            return 
                "<main>
                    <div class='form-body'>
                        <div class='row'>
                            <div class='form-holder'>
                                <div class='form-content'>
                                    <div class='form-items'>
                                        <h3>Ajouter une catégorie</h3>
                                        <form action='' method='post'>
                                            <div class='col-md-12'>
                                                <label for='category'>Nouvelle catégorie</label>
                                                <input id='category' type='text' class='form-control shadow-sm p-3 mb-5 bg-white rounded' name='nameCategory' placeholder='Entrer votre nouvelle catégorie' required>
                                            </div>
                                            <div class='form-button mt-3'>
                                                <input class='btn btn-primary' type='submit' name='submitCategory' value='Ajouter une catégorie'>
                                            </div>
                                        </form>
                                        <p>{$this->getMessage()}</p>
                                    </div>
                                </div>
                            </div>
                            <h1>Liste des Catégories</h1>
                                <ul>{$this->getCategoryList()}</ul>
                        </div>
                    </div>
                </main>";
        }
    }