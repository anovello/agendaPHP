<?php

include_once(BASE_URI.'src/models/userModel.php');
session_start();

class User
{
    public function login()
    {
        $error = false;
        $data = ['message' => []];

        // Validações
        if (!isset($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
        {
            $data['message'][] = 'E-mail inválido.';
            $error = true;  
        } 

        if (!isset($_GET['password']) || trim($_GET['password']) === '')
        {
            $data['message'][] = 'Password inválido.';
            $error = true;
        }
        
        $user = new UserModel();
        $user->email = $_GET['email'];
        $user->password = trim($_GET['password']);

        $res = $user->login();

        if ($res !== false)
        {
            $_SESSION['user'] = $res;
            $data['status'] = true;
            $data['user'] = $user;
            
            return json_encode($data);
        } else {
            $data['message'][] = 'Login ou senha Inválidos.';
            $data['status'] = false;

            return json_encode($data);
        }
        
        
    }

    public function getMail()
    {
        if (isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
        {
           $user = new UserModel();

           if ($user->getEmail($_GET['email']))
           {
                return json_encode([
                    'status' => true,
                    'email' => true
                ]);
           } else {
                return json_encode([
                    'status' => true,
                    'email' => false
                ]);
           }
            
        } else {
            return json_encode([
                'status' => false,
                'message' => 'E-mail obrigatório.'
            ]);
        }
    }

    function islogged()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']->name !== '')
        {
            return json_encode(['status' => true]);
        } else {
            return json_encode(['status' => false]);
        }
    }

    public function create()
    {
        $error = false;
        $data = [
            'message' => []    
        ];
        $user = new UserModel();

        // Validações
        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            if ($user->getEmail($_POST['email']))
            {
                $data['message'][] = 'E-mail já cadastrado.';
                $error = true;
            } else {
                $user->email = $_POST['email'];
            }
            
        } else {
            $data['message'][] = 'E-mail inválido.';
            $error = true;
        }

        if (isset($_POST['name']) && trim($_POST['name']) !== '')
        {
            $user->name = $_POST['name'];
        } else {
            $data['message'][] = 'Nome inválido.';
            $error = true;
        }

        if (isset($_POST['password']) && trim($_POST['password']) !== '')
        {
            $user->password = $_POST['password'];
        } else {
            $data['message'][] = 'Password inválido.';
            $error = true;
        }

        if (!isset($_POST['password-conf']) || $_POST['password-conf'] !== $_POST['password'])
        {
            $data['message'][] = 'Senha e confirmar senha inválidos.';
            $error = true;
        }
        // Fim validacões.

        if ($error)
        {
            $data['status'] = false;
            return json_encode($data);
        } else {

            if ( $user->create() )
            {
                $data['status'] = true;
                $data['user'] = $user->toObject();

                return json_encode($data);
            } else {
                $data['status'] = false;
                $data['message'][] = 'Falha ao conectar no banco, verifique sua conexão.';

                return json_encode($data);
            }
        }        
    }

    public function logout()
    {
        session_destroy();
        return json_encode(['status' => true]);
    }

    public function get()
    {
        if (!json_decode($this->islogged())->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }

        $user = new UserModel();
        $user->id = $_SESSION['user']->id;

        if ($user->get() !== false)
        {
            return json_encode([
                'status' => true,
                'user' => $user->toObject()
            ]);
        } else {
            return json_encode([
                'status' => false,
                'user' => []
            ]);
        }
    }

    public function update()
    {
        if (!json_decode($this->islogged())->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }

        $error = false;
        $data = [
            'message' => []    
        ];

        $user = new UserModel();
        $user->id = $_SESSION['user']->id;

        // Validações
        if (isset($_POST['name']) && trim($_POST['name']) !== '')
        {
            $user->name = $_POST['name'];
        } else {
            $data['message'][] = 'Nome inválido.';
            $error = true;
        }

        if (isset($_POST['password']) && trim($_POST['password']) !== '')
        {
            $user->password = $_POST['password'];
        } else {
            $data['message'][] = 'Password inválido.';
            $error = true;
        }

        if (!isset($_POST['password-conf']) || $_POST['password-conf'] !== $_POST['password'])
        {
            $data['message'][] = 'Senha e confirmar senha inválidos.';
            $error = true;
        }
        // Fim validacões.
        
        if ($error)
        {
            $data['status'] = false;
            return json_encode($data);
        } else {

            if ( $user->update() )
            {
                $data['status'] = true;
                return json_encode($data);
            } else {
                $data['status'] = false;
                $data['message'][] = 'Falha ao conectar no banco, verifique sua conexão.';

                return json_encode($data);
            }
        }        
    }
}