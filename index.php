<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session for authentication
session_start();

// Autoload required classes
spl_autoload_register(function ($class) {
    $paths = ["controllers", "models", "."]; // Add "models" to the paths array
    foreach ($paths as $path) {
        $file = __DIR__ . "/{$path}/{$class}.php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Utility functions
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && isset($_SESSION['role']);
}

function redirectToLogin()
{
    header("Location: index.php?controller=auth&action=login");
    exit;
}

function checkAccess($requiredRole)
{
    if (!isLoggedIn() || $_SESSION['role'] !== $requiredRole) {
        redirectToLogin();
    }
}

// Define route mappings
$routes = [
    'beneficiary' => BeneficiaryController::class,
    'communication' => CommunicationController::class,
    'donor' => DonorController::class,
    'event' => EventController::class,
    'volunteer' => VolunteerController::class,
    'auth' => AuthController::class,
    'admin' => AdminController::class,
    'payment' => PaymentController::class,
];

// Instantiate Router with route definitions
$router = new Router($routes);

// Display User Control Panel based on role
// index.php (partial)
function displayUserControlPanel()
{
    // Initialize an empty links array
    $links = [];

    // Determine the links based on the user role
    switch ($_SESSION['role'] ?? '') {
        case 'Admin':
            $links[] = [
                'url' => '?controller=beneficiary&action=listBeneficiaries',
                'label' => 'Manage Beneficiaries'
            ];
            $links[] = [
                'url' => '?controller=donor&action=listDonors',
                'label' => 'Manage Donors'
            ];
            $links[] = [
                'url' => '?controller=event&action=list',
                'label' => 'Manage Events'
            ];
            $links[] = [
                'url' => '?controller=volunteer&action=listVolunteers',
                'label' => 'Manage Volunteers'
            ];
            $links[] = [
                'url' => '?controller=admin&action=listDonations',
                'label' => 'Manage Donations'
            ];
            $links[] = [
                'url' => '?controller=payment&action=listTransactions',
                'label' => 'Manage Transactions'
            ];
            break;
        case 'Donor':
            $links[] = [
                'url' => '?controller=donor&action=viewDonations',
                'label' => 'My Donations'
            ];
            $links[] = [
                'url' => '?controller=event&action=list',
                'label' => 'View Events'
            ];
            $links[] = [
                'url' => '?controller=donor&action=viewInbox',
                'label' => 'My Inbox'
            ];
            break;
        case 'Volunteer':
            $links[] = [
                'url' => '?controller=event&action=list',
                'label' => 'View Events'
            ];
            $links[] = [
                'url' => '?controller=volunteer&action=viewInbox',
                'label' => 'My Inbox'
            ];
            $links[] = [
                'url' => '?controller=volunteer&action=viewSkills',
                'label' => 'My Skills'
            ];
            $links[] = [
                'url' => '?controller=volunteer&action=chooseSkills',
                'label' => 'Add Skills'
            ];
            break;
        default:
            redirectToLogin();
    }

    // Include the dashboard view. The $links array will be available in the view.
    include 'views/dashboard.php';
}


// Main Logic
$controller = $_GET['controller'] ?? null;
$action = $_GET['action'] ?? null;
$params = ($_SERVER['REQUEST_METHOD'] === 'POST') ? $_POST : $_GET;

try {
    // Debugging log for route parameters
    error_log("Received Parameters: " . print_r($params, true));

    if ($controller && $action) {
        // Handle sorting logic for donations
        if ($controller === 'admin' && $action === 'listDonations' && isset($params['column']) && isset($params['order'])) {
            $column = $params['column'];
            $order = $params['order'];
            $donationModel = new Donation();
            $donations = $donationModel->getSortedDonations($column, $order);
            include 'views/admin/donations.php';
        } else {
            $router->route($controller, $action, $params);
        }
    } elseif (isLoggedIn()) {
        displayUserControlPanel();
    } else {
        redirectToLogin();
    }
} catch (Exception $e) {
    // Handle exceptions gracefully
    http_response_code(500);
    echo "<h1>Internal Server Error</h1><p>" . htmlspecialchars($e->getMessage()) . "</p>";
    error_log("Exception: " . $e->getMessage());
}
