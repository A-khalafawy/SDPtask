<?php
require_once 'models/User.php';
require_once 'UserFactory.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            $contactInfo = $_POST['contact_info'] ?? null;

            try {
                // Use UserFactory to create the user
                UserFactory::createUser($username, $password, $role, ['contact_info' => $contactInfo]);

                // Redirect to login after successful registration
                header('Location: index.php?controller=auth&action=login');
                exit;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Show registration form
        include 'views/auth/register.php';
    }
    
    

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit;
            } else {
                echo "Invalid credentials.";
            }
        } else {
            require 'views/auth/login.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}
?>
