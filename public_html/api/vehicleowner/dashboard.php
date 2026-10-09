<?php
/**
 * GET -> account details ('me': name, email, role) plus dashboard KPIs, the most recent active repair, items needing action,
 *        latest invoices and upcoming appointments for the logged-in owner.
 */
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/owner-data.php';

$user = require_api_role('VehicleOwner');
require_method(['GET']);

try {
    $data = owner_dashboard($pdo, $user['id']);
    // Account details for the topbar avatar popover (assets/js/shared/autocare-core.js)
    $data['me'] = ['name' => $user['name'], 'email' => $user['email'], 'role' => $user['role']];
    json_ok($data);
} catch (PDOException $e) {
    json_server_error($e);
}
