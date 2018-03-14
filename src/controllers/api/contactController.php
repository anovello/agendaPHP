<?php

include_once('controllerBase.php');
include_once(BASE_URI.'src/models/contactModel.php');

class Contact extends Base
{

    public function get()
    {
        if (!$this->islogged()->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }
        
        
        if (!isset($_GET['id']))
        {
            return json_encode([
                'status' => false,
                'message' => 'Id Obrigatório'    
            ]);
        }

        $contact = new ContactModel();
        $contact->user_id = $_SESSION['user']->id;
        $contact->id = $_GET['id'];

        $res = $contact->get();

        if ($res !== false)
        {
            return json_encode([
                'status' => true,
                'contact' => $res
            ]);
        } else {
            return json_encode([
                'status' => true,
                'message' => 'Contato não encontrado.'
            ]);
        }
        

    }

    public function getAll()
    {
        if (!$this->islogged()->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }

        $page = 1;
        $search = '';
        
        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }

        if (isset($_GET['search']))
        {
            $search = $_GET['search'];
        }

        $contact = new ContactModel();
        $contact->user_id = $_SESSION['user']->id;
        return json_encode($contact->getAll($page, $search));

    }

    public function getMail()
    {
        if (!$this->islogged()->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }

        if (isset($_GET['email']) && filter_var($_GET['email'], FILTER_VALIDATE_EMAIL))
        {
            $contact = new ContactModel();
            $contact->user_id = $_SESSION['user']->id;
            $id = false;

            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
            }

            if ($contact->getEmail($_GET['email'], $id))
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

    public function create()
    {
        if (!$this->islogged()->status)
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

        $contact = new ContactModel();
        $contact->user_id = $_SESSION['user']->id;

        // Validações
        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $contact->email = $_POST['email'];
        } else {
            $data['message'][] = 'E-mail inválido.';
            $error = true;
        }

        if (isset($_POST['name']) && trim($_POST['name']) !== '')
        {
            $contact->name = $_POST['name'];
        } else {
            $data['message'][] = 'Nome inválido.';
            $error = true;
        }

        if (isset($_POST['phone']) && trim($_POST['phone']) !== '')
        {
            $contact->phone = $_POST['phone'];
        } else {
            $data['message'][] = 'Telefone inválido.';
            $error = true;
        }
        // Fim validacões.

        if ($error)
        {
            $data['status'] = false;
            return json_encode($data);
        } else {

            if ( $contact->create() )
            {
                $data['status'] = true;
                $data['contact'] = $contact->toObject();

                return json_encode($data);
            } else {
                $data['status'] = false;
                $data['message'][] = 'Falha ao conectar no banco, verifique sua conexão.';

                return json_encode($data);
            }
        }        
    }

    public function update()
    {
        if (!$this->islogged()->status)
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

        $contact = new ContactModel();
        $contact->user_id = $_SESSION['user']->id;
        
        // Validações
        if (isset($_POST['id']) && trim($_POST['id']) !== '')
        {
            $contact->id = $_POST['id'];
        } else {
            $data['message'][] = 'Id inválido.';
            $error = true;
        }

        if ($contact->get() ===  false)
        {
            $data['message'][] = 'Usuário não autorizado.';
            $error = true;
        }

        if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $contact->email = $_POST['email'];
        } else {
            $data['message'][] = 'E-mail inválido.';
            $error = true;
        }

        if (isset($_POST['name']) && trim($_POST['name']) !== '')
        {
            $contact->name = $_POST['name'];
        } else {
            $data['message'][] = 'Nome inválido.';
            $error = true;
        }

        if (isset($_POST['phone']) && trim($_POST['phone']) !== '')
        {
            $contact->phone = $_POST['phone'];
        } else {
            $data['message'][] = 'Telefone inválido.';
            $error = true;
        }
        // Fim validacões.

        if ($error)
        {
            $data['status'] = false;
            return json_encode($data);
        } else {
            
            if ( $contact->update() )
            {
                $data['status'] = true;
                $data['contact'] = $contact->toObject();

                return json_encode($data);
            } else {
                $data['status'] = false;
                $data['message'][] = 'Falha ao conectar no banco, verifique sua conexão.';

                return json_encode($data);
            }
        }        
    }

    public function delete()
    {
        if (!$this->islogged()->status)
        {
            return json_encode([
                'status' => false,
                'logged' => false    
            ]);
        }

        $contact = new ContactModel();
        $contact->user_id = $_SESSION['user']->id;
        
        // Validações
        if (isset($_POST['id']) && trim($_POST['id']) !== '')
        {
            $contact->id = $_POST['id'];
        } else {

            return json_encode([
                'status' => false,
                'message' => 'Id Obrigatório.'
            ]);
        }

        if ($contact->get() ===  false)
        {
            return json_encode([
                'status' => false,
                'message' => 'Usuário não autorizado.'
            ]);
        }
        // Fim validacões.
        
        if ( $contact->delete() )
        {
            return json_encode([
                'status' => true,
                'message' => 'Contato excluído com sucesso.'    
            ]);
        } else {
            return json_encode([
                'status' => false,
                'message' => 'Falha ao excluír o contato.'    
            ]);;
        }        
    }    
}