<?php
/**
 * GET -> account details ('me': name, email, role) plus KPIs and job status breakdown for the logged-in mechanic.
 */
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/mechanic-data.php';

$user = require_api_role('Mechanic');
require_method(['GET']);

try {
    $data = mechanic_dashboard($pdo, $user['id']);
    // Account details for the topbar avatar popover (assets/js/shared/autocare-core.js)
    $data['me'] = ['name' => $user['name'], 'email' => $user['email'], 'role' => $user['role']];
    json_ok($data);
} catch (PDOException $e) {
    json_server_error($e);
}
