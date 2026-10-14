<?php
function e(string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function base_url(string $path = ''): string
{
    $base = rtrim(config('app_url', 'http://localhost/network-study'), '/');
    return $base . '/' . ltrim($path, '/');
}

function config(string $key, $default = null)
{
    static $cfg = null;

    if ($cfg === null) {
        $cfg = require APP_ROOT . '/config/config.php';
    }

    $segments = explode('.', $key);
    $value = $cfg;

    foreach ($segments as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return $value;
}

function redirect(string $path): void
{
    header('Location: ' . base_url($path));
    exit;
}

function current_url(): string
{
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') .
        '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function format_hours(float $hours): string
{
    $hours = max(0, $hours);
    $whole = (int) floor($hours);
    $minutes = (int) round(($hours - $whole) * 60);
    if ($minutes === 60) {
        $whole++;
        $minutes = 0;
    }

    return $whole . 'h ' . $minutes . 'm';
}

function status_badge(string $status): string
{
    $styles = [
        'active' => 'success',
        'paused' => 'warning',
        'completed' => 'info',
        'draft' => 'secondary',
        'pending' => 'muted',
        'in_progress' => 'primary',
    ];

    return $styles[strtolower($status)] ?? 'secondary';
}
