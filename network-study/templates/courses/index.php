<?php
$courses = $courses ?? [];
?>
<div class="page-header">
    <div>
        <p class="eyebrow">Learning plans</p>
        <h1>Courses</h1>
    </div>
    <a class="primary-button" href="<?= base_url('courses/new') ?>">Create new course</a>
</div>

<?php if (!$courses): ?>
    <div class="empty-state large">
        <h3>No courses yet</h3>
        <p>Create your first course and start building modules, topics, and lessons.</p>
        <a class="primary-button" href="<?= base_url('courses/new') ?>">Add course</a>
    </div>
<?php else: ?>
    <div class="table-card">
        <table class="data-table">
            <thead>
            <tr>
                <th>Course</th>
                <th>Category</th>
                <th>Status</th>
                <th>Progress</th>
                <th>Lessons</th>
                <th>Target</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($courses as $course): ?>
                <?php $progress = (float) ($course['progress_percent'] ?? 0); ?>
                <tr>
                    <td>
                        <div class="table-course">
                            <span class="table-badge" style="background: <?= e($course['color'] ?? '#4f46e5') ?>22; color: <?= e($course['color'] ?? '#4f46e5') ?>;">
                                <?= e($course['icon'] ?? '◉') ?>
                            </span>
                            <div>
                                <strong><?= e($course['name']) ?></strong>
                                <small><?= e($course['target_goal'] ?? 'Learning goal') ?></small>
                            </div>
                        </div>
                    </td>
                    <td><?= e($course['category'] ?? 'General') ?></td>
                    <td><span class="status-badge status-<?= e(status_badge($course['status'] ?? 'active')) ?>"><?= e(ucwords(str_replace('_', ' ', $course['status'] ?? 'active'))) ?></span></td>
                    <td>
                        <div class="mini-progress narrow"><span style="width: <?= $progress ?>%"></span></div>
                        <small><?= $progress ?>%</small>
                    </td>
                    <td><?= (int) ($course['lesson_count'] ?? 0) ?></td>
                    <td><?= e($course['target_end_date'] ?? 'Not set') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
