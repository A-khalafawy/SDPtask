<?php
// Ensure the session is only started if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check the user's role and deny access if it does not match the required role.
 *
 * @param string $requiredRole The role required to access the resource.
 */
function checkRole($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        http_response_code(403); // Forbidden
        echo "Access denied: Insufficient permissions.";
        exit;
    }
}