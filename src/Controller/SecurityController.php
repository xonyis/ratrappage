<?php
namespace App\Controller;

use App\Repository\UserRepository;
use Mns\Buggy\Core\AbstractController;

class SecurityController extends AbstractController
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login()
    {

        if(!empty($_SESSION['user']))
        {
            $_SESSION['admin'] ? header('Location: /admin/dashboard') : header('Location: /user/dashboard'); die;
        }

        if(!empty($_POST)) {
            $username = htmlspecialchars(trim($_POST['username'] ?? ''));
            $password = htmlspecialchars(trim($_POST['password'] ?? ''));
            
            $user = $this->userRepository->findByEmail($username);
            
            if($user && $password === $user->getPassword()) {
                $_SESSION['user'] = [
                    'id' => $user->getId(),
                    'username' => $user->getFirstname(),
                ];

                if($user->getIsadmin()) {
                    header('Location: /admin/dashboard');
                    $_SESSION['admin'] = $user->getIsAdmin();
                    
                }
                else
                {
                    header('Location: /user/dashboard');
                    
                }
                exit;
            }

            $error = 'Invalid username or password';
        }

        return $this->render('security/login.html.php', [
            'title' => 'Login',
            'error' => $error ?? null,
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['admin']);
        session_destroy();
        header('Location: /login');
        exit;
    }
}