<?php
     
class MessageController{

    public function writeAction(){
        if(!empty($_SESSION)){
            if(!empty($_POST["write"])){
                $model = new MessageModel();
                $helper = new MessageHelper();
                $view = new View();
                $theme = $helper->filterText($_POST["theme"]);
                $text = $helper->filterText($_POST["text"]);
                $shortText = $helper->cutToShortText($text);
                $result = $model->saveMessage($theme, $shortText, $text);
                if(empty($result)){
                    $view->generate("error", array("report" => "Не вдалось надіслати повідомлення"));
                    $view->generate("write_message");
                }else{
                    $view->generate("list_messages", array("report" => "Повідомлення успішно надіслано"));
                }
            }else{
                $view = new View();
                $view->generate("write_message");
            }
        }else{
            $view = new View();
            $view->generate("error", array("report" => "Для виконання цієї дії потрібно виконати вхід"));
        }
    }
    
    public function showAction(){
        if(!empty($_SESSION)){
                $model = new MessageModel();
                $view = new View();
                $result = $model->getMessage($_GET["id_message"]);
                if(empty($result)){
                    $view->generate("error", array("report" => "Помилка в БД"));
                    $view->generate("list_messages");
                }else{
                    $view->generate("show_message", array("message" => $result));
                }
        }else{
            $view = new View();
            $view->generate("error", array("report" => "Для виконання цієї дії потрібно виконати вхід"));
        }
    }
    
    public function editAction(){
        if(!empty($_SESSION)){
            if(!empty($_POST["edit"])){
                $model = new MessageModel();
                $helper = new MessageHelper();
                $view = new View();
                $theme = $helper->filterText($_POST["theme"]);
                $text = $helper->filterText($_POST["text"]);
                $shortText = $helper->cutToShortText($text);
                $result = $model->editMessage($theme, $shortText, $text);
                if(empty($result)){
                    $view->generate("error", array("report" => "Не вдалось відредагувати повідомлення"));
                    $view->generate("edit_message");
                }else{
                    $view->generate("list_messages", array("report" => "Повідомлення успішно відредаговано"));
                }
            }else{
                $view = new View();
                $view->generate("edit_message");
            }
        }else{
            $view = new View();
            $view->generate("error", array("report" => "Для виконання цієї дії потрібно виконати вхід"));
        }
    }
    
    public function deleteAction(){
        if(!empty($_SESSION)){
            $model = new MessageModel();
            $view = new View();
            $result = $model->deleteMessage($_GET["id_message"]);
            if(empty($result)){
                $view->generate("error", array("report" => "Не вдалось видалити повідомлення"));
                $this->showAction();
            }else{
                $view->generate("list_messages", array("report" => "Повідомлення успішно видалено"));
            }
        }else{
            $view = new View();
            $view->generate("error", array("report" => "Для виконання цієї дії потрібно виконати вхід"));
        }
    }
    
    public function listAction($page = 1){
        $model = new MessageModel();
        $view = new View();    
        
        $numMessages = $model->countMessages();
        $paginator = new Paginator($page, 10, $numMessages);
        $startIndex = $paginator->getStartIndex();
        $endIndex = $paginator->getEndIndex();
        $pages = $paginator->getPages();
        
        $messages = $model->getMessages($startIndex, $endIndex);
        if(empty($messages)){
            $view->generate("error", array("report" => "Помилка в БД"));
        }else{
            $view->generate("list_messages", array(
                "messages" => $messages,
                "pages" => $pages));
        }
    }
}


