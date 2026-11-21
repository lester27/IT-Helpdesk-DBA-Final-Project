<?php
/**
 * includes/helpers.php — small shared utilities
 * OWNER: Lester. Add helpers here instead of copy-pasting into pages.
 */

// Change if the project folder in htdocs has a different name.
// e.g. http://localhost/IT-Helpdesk-DBA-Final-Project
define('BASE_URL', '/IT-Helpdesk-And-Ticketing-System');

// Allowed values — must match the CHECK constraints in database/01_schema.sql
const ROLES             = ['Employee', 'Technician', 'Admin'];
const TICKET_STATUSES   = ['Open', 'In Progress', 'Resolved'];
const EQUIPMENT_STATUSES = ['In Stock', 'Assigned', 'Under Repair', 'Retired'];

const NEXT_STATUS_MAP = [
    'Open' => 'In Progress',
    'In Progress' => 'Resolved',
];

/** Escape output for HTML. Use on EVERY value printed from the DB or user input. */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/** Flash messages: set before redirect, shown once by header.php */
function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message]; // type = Bootstrap alert: success, danger, warning, info
}

function get_flashes(): array
{
    $f = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $f;
}

/** CSRF protection for every POST form. */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function verify_csrf(): void
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(400);
        die('Invalid CSRF token.');
    }
}

/** Bootstrap badge class for a ticket status. */
function status_badge(string $status): string
{
    return match ($status) {
        'Open'        => 'text-bg-secondary',
        'In Progress' => 'text-bg-primary',
        'Resolved'    => 'text-bg-success',
        default       => 'text-bg-light',
    };
}

/** Bootstrap badge class for an SLA state from v_ticket_sla. */
function sla_badge(string $state): string
{
    return match ($state) {
        'On Track' => 'text-bg-success',
        'At Risk'  => 'text-bg-warning',
        'Breached' => 'text-bg-danger',
        'Met'      => 'text-bg-info',
        default    => 'text-bg-light',
    };
}

