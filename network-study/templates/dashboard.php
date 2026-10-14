<?php
$stats = $stats ?? [];
$courses = $courses ?? [];
$tasks = $tasks ?? [];
$recentSessions = $recentSessions ?? [];
?>
<div class="page-header">
    <div>
        <p class="eyebrow">Overview</p>
        <h1>Study dashboard</h1>
    </div>
    <a class="primary-button" href="<?= base_url('lessons/1') ?>">Continue Studying</a>
</div>

<section class="stats-grid">
    <article class="stat-card">
        <span class="stat-label">Total active courses</span>
        <strong><?= (int) ($stats['total_courses'] ?? 0) ?></strong>
        <small><?= (int) ($stats['active_courses'] ?? 0) ?> active now</small>
    </article>
    <article class="stat-card">
        <span class="stat-label">Overall study progress</span>
        <strong><?= (float) ($stats['overall_progress'] ?? 0) ?>%</strong>
        <small><?= (int) ($stats['completed_lessons'] ?? 0) ?> lessons complete</small>
    </article>
    <article class="stat-card">
        <span class="stat-label">Completed / in progress</span>
        <strong><?= (int) ($stats['completed_lessons'] ?? 0) ?> / <?= (int) ($stats['in_progress_lessons'] ?? 0) ?></strong>
        <small><?= (int) ($stats['pending_lessons'] ?? 0) ?> pending</small>
    </article>
    <article class="stat-card">
        <span class="stat-label">Current study streak</span>
        <strong><?= (int) ($stats['streak'] ?? 0) ?> days</strong>
        <small><?= (float) ($stats['study_hours'] ?? 0) ?> hours logged</small>
    </article>
</section>

<section class="content-grid">
    <div class="panel wide">
        <div class="panel-header">
            <h3>Active courses</h3>
            <a href="<?= base_url('courses') ?>">View all</a>
        </div>

        <?php if (!$courses): ?>
            <div class="empty-state">
                <p>No courses yet. Create your first learning plan.</p>
            </div>
        <?php else: ?>
            <div class="course-grid">
                <?php foreach ($courses as $course): ?>
                    <?php $progress = (float) ($course['progress_percent'] ?? 0); ?>
                    <article class="course-card" style="--course-color: <?= e($course['color'] ?? '#4f46e5') ?>;">
                        <div class="course-header">
                            <span class="course-badge" style="background: <?= e($course['color'] ?? '#4f46e5') ?>33; color: <?= e($course['color'] ?? '#4f46e5') ?>;">
                                <i><?= e($course['icon'] ?? '◉') ?></i>
                            </span>
                            <span class="status-badge status-<?= e(status_badge($course['status'] ?? 'active')) ?>"><?= e(ucwords(str_replace('_', ' ', $course['status'] ?? 'active'))) ?></span>
                        </div>
                        <h4><?= e($course['name']) ?></h4>
                        <p><?= e($course['category'] ?? 'General') ?></p>
                        <div class="mini-progress"><span style="width: <?= $progress ?>%"></span></div>
                        <div class="meta-row">
                            <small><?= $progress ?>% complete</small>
                            <small><?= (int) ($course['lesson_count'] ?? 0) ?> lessons</small>
                        </div>
                        <a href="<?= base_url('courses/' . (int) $course['id']) ?>">Open course</a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h3>Upcoming study tasks</h3>
            <a href="#">Planner</a>
        </div>
        <?php if (!$tasks): ?>
            <div class="empty-state tiny">
                <p>No upcoming tasks.</p>
            </div>
        <?php else: ?>
            <ul class="task-list">
                <?php foreach ($tasks as $task): ?>
                    <li>
                        <div>
                            <strong><?= e($task['title'] ?? 'Study task') ?></strong>
                            <small><?= e($task['course_name'] ?? 'Course') ?> · <?= e($task['lesson_title'] ?? 'General') ?></small>
                        </div>
                        <span><?= e($task['due_date'] ?? 'Soon') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>

<section class="content-grid lower-grid">
    <div class="panel">
        <div class="panel-header">
            <h3>Recently studied</h3>
        </div>
        <ul class="plain-list">
            <?php if (!$recentSessions): ?>
                <li class="empty-state tiny"><p>No recent study sessions yet.</p></li>
            <?php else: ?>
                <?php foreach ($recentSessions as $session): ?>
                    <li>
                        <strong><?= e($session['lesson_title'] ?? 'Lesson') ?></strong>
                        <small><?= e($session['course_name'] ?? 'Course') ?> · <?= e($session['session_date'] ?? date('Y-m-d')) ?></small>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h3>Topics needing revision</h3>
        </div>
        <ul class="plain-list">
            <li><strong>OSPF route summarization</strong><small>Needs practice</small></li>
            <li><strong>IP SLA and tracking</strong><small>Weak area</small></li>
            <li><strong>VLAN trunking and DTP</strong><small>Review lab notes</small></li>
        </ul>
    </div>
</section>
