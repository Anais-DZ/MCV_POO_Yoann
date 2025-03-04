<?php

    //creation de la classe ViewHeader
    class ViewAccount {
        

        //METHOD 
        public function displayView(): string {
            return 
                "<main>
                    <h2>Mon compte</h2>
                    <ul>
                        <li>{$this->getNickname()}</li>
                        <li>{$this->getEmail()}</li>
                    </ul>
                </main>";
        }
    }

 