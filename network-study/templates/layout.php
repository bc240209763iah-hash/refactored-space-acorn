<?php
$pageTitle = $pageTitle ?? 'Network Study';
$active = $active ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">
            <span class="brand-mark">NS</span>
            <div>
                <strong>Network Study</strong>
                <small>Learning platform</small>
            </div>
        </div>

        <nav class="nav">
            <a class="nav-item <?= $active === 'dashboard' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Dashboard</a>
            <a class="nav-item <?= $active === 'courses' ? 'active' : '' ?>" href="<?= base_url('courses') ?>">Courses</a>
            <a class="nav-item <?= $active === 'lessons' ? 'active' : '' ?>" href="<?= base_url('lessons/1') ?>">Lessons</a>
            <a class="nav-item <?= $active === 'quizzes' ? 'active' : '' ?>" href="#">Quizzes</a>
            <a class="nav-item <?= $active === 'flashcards' ? 'active' : '' ?>" href="#">Flashcards</a>
            <a class="nav-item <?= $active === 'labs' ? 'active' : '' ?>" href="#">Labs</a>
            <a class="nav-item <?= $active === 'planner' ? 'active' : '' ?>" href="#">Planner</a>
        </nav>

        <div class="sidebar-card">
            <p class="eyebrow">Current focus</p>
            <h4>CCNP ENCOR 350-401</h4>
            <div class="mini-progress">
                <span style="width: 64%"></span>
            </div>
            <small>64% planned complete</small>
        </div>
    </aside>

    <main class="content">
        <header class="topbar">
            <form class="searchbox" action="<?= base_url('/') ?>" method="get">
                <span>⌕</span>
                <input type="text" name="q" value="<?= e($_GET['q'] ?? '') ?>" placeholder="Search courses, notes, labs...">
            </form>
            <div class="topbar-actions">
                <button class="ghost-button">Calendar</button>
                <a class="primary-button" href="<?= base_url('courses/new') ?>">New Course</a>
            </div>
        </header>

        <?php require APP_ROOT . '/templates/' . $template . '.php'; ?>
    </main>
</div>

<script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>
</html>
