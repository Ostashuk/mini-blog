<?php

/**
 * Description of UserController
 *
 * @author Fake
 */
class UserController extends Controller{
    
    public function loginAction(){
        if(empty($_SESSION)){
            
            if(isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
                
                $model = new UserModel();
                $helper = new UserHepler();
                $view = new View();
                
                $login = $_COOKIE["user"];
                $password = $_COOKIE["pass"];
                
                $user = $model->getUser($login, $password);
                if(empty($user)){
                    $view->generate("login_user");
                }else{
                    $helper->startSession($user["nickname"], $user["id_user"]);
                    $view->generate("logged_user");
                }
                
            }elseif(!empty($_POST)){
                
                $model = new UserModel();
                $helper = new UserHelper();
                $view = new View();
                
                $login = $_POST["email"];
                $password = $_POST["password"];
                
                if($helper->isValidEmail($login) && isValidPass($password)){
                    
                    $password = $helper->encryptPassword($password);
                    $user = $model->getUser($login, $password);
                    if(empty($user)){
                        $view->generate("login_user", array("report" => "Невірний логін або пароль"));
                    }else{
                        $helper->startSession($user["nickname"], $user["id_user"]);
                        $helper->setCookie($login, $password);
                        $view->generate("logged_user");
                    }
                    
                }else{
                    $errors = $helper->getErrors();
                    $view->generate("login_user", array("report" => $errors));
                }
                
            }else{
                $view = new View();
                $view->generate("login_user");
            }
        }else{
            $view = new View();
            $view->generate("logged_user");
        }
        
    }
    
    public function logoutAction(){
        if(!empty($_SESSION)){
            $view = new View();
            $helper = new UserHelper();
            
            $helper->unsetCookie();
            $helper->endSession();
        
            $view->generate("login_user");
        }else{
            $view = new View();
            $view->generate("login_user", array("report" => "Для виконання цієї дії потрібно виконати вхід"));
        }
    }
    
    public function registerAction(){
        
        if(empty($_SESSION)){
            
            $model = new UserModel();
            $helper = new UserHelper();
            $view = new View();
            
            $login = $_POST["email"];
            $password = $_POST["password"];
            $nickname = $_POST["nickname"];
            
            if($helper->isValidEmail($login) & $helper->isValidPassword($password) & $helper->isValidNickname($nickname)){
                $result = $model->addUser($login, $password, $nickname);
                if(empty($result)){
                    $view->generate("registration_user", array("report" => "Помилка БД"));
                }else{
                    $this->loginAction();
                    $view->generate("list_messages");
                }
            }else{
                $errors = $helper->getError();
                $view->generate("registration_user", array("report" => $errors));
            }
            
        }else{
            $view->generate("logged_user");
        }
        
    }
    
}

