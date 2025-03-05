<?php

    //creation de la classe ViewHeader
    class ViewAccount {
        
        //cette vue n'a pas besoin d'attribut

        
        //METHOD 
        public function displayView(): string {
            return 
                "<main>
                    <div class='form-body'>
                        <div class='row'>
                            <div class='form-holder'>
                                <div class='form-content'>
                                    <div class='form-items'>
                                        <h2>Mon compte</h2>
                                        <ul>
                                            <li>Mon pseudo : {$_SESSION['nickname']}</li>
                                            <li>Mon email : {$_SESSION['email']}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>";
        }
    }

 