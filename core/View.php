<?php

/**
 * Description of View
 *
 * @author Fake
 */
class View{
    public function generate($content, array $data = null, $mainTemplate = "main"){
        require_once $mainTemplate;
    }
}
