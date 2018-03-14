<?php
    include_once('headers.php');
    
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = $_SERVER['REMOTE_ADDR'].$_SERVER['REQUEST_URI'];

    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $array_uri = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($array_uri);
        $uri = $array_uri;
    } else {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
    }
    
    if ($uri['1'] === 'api')
    {
        switch ($uri['2']) {
            case 'user':
                include_once('src/controllers/api/userController.php');
                break;

            case 'contact':
                include_once('src/controllers/api/contactController.php');
                break;
                
            default:
                echo json_encode(['status' => false, 'message' => 'Controller não encontrada.']);
                break;
        }

        $cont = ucfirst($uri['2']);
        
        $controller = new $cont;
        $action = explode('?', isset($uri['3']) && $uri['3'] !== '' ? $uri['3'] : 'index');
        
        //User
        if ( ($uri['2'] === 'user') && (
                    $action[0] === 'login' || 
                    $action[0] === 'getMail' ||
                    $action[0] === 'create' ||
                    $action[0] === 'islogged' ||
                    $action[0] === 'logout' ||
                    $action[0] === 'get' ||
                    $action[0] === 'update'
                ) 
            )
        {
            switch ($action[0]) {
                case 'login':
                    echo $controller->login();
                    break;
    
                case 'getMail':
                    echo $controller->getMail();
                    break;
                
                case 'create':
                    echo $controller->create();
                    break;
                    
                case 'islogged':
                    echo $controller->islogged();
                    break;
                    
                case 'logout':
                    echo $controller->logout();
                    break;
                    
                case 'get':
                    echo $controller->get();
                    break;
                    
                case 'update':
                    echo $controller->update();
                    break;
            }
            // echo $controller->$action[0]();
            // exit();
        }
        
        //Contato
        if ( ($uri['2'] === 'contact') && (
                    $action[0] === 'get' || 
                    $action[0] === 'getAll' || 
                    $action[0] === 'getMail' ||
                    $action[0] === 'create' ||
                    $action[0] === 'update' ||
                    $action[0] === 'delete'
                ) 
            )
        {
            echo $controller->$action[0]();
            exit();
        }

    } else {
        switch ($uri['1']) {
            case 'login':
                include_once('src/controllers/login.php');
                $login = new Login();
                echo $login->index();
                break;
            case 'home':
                include_once('src/controllers/home.php');
                $home = new Home();
                echo $home->index();
                break;
            case 'account':
                include_once('src/controllers/account.php');
                $account = new Account();
                echo $account->index();
                break;
            default:
                include_once('src/controllers/login.php');
                $login = new Login();
                echo $login->index();
                break;
        }
    }

    