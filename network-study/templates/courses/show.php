<?php
$course = $course ?? [];
$modules = $modules ?? [];
$topicMap = $topicMap ?? [];
$lessonMap = $lessonMap ?? [];
?>
<div class="page-header">
    <div>
        <p class="eyebrow">Course detail</p>
        <h1><?= e($course['name'] ?? 'Course') ?></h1>
    </div>
    <a class="primary-button" href="<?= base_url('courses') ?>">Back to courses</a>
</div>

<div class="course-hero">
    <div>
        <span class="status-badge status-<?= e(status_badge($course['status'] ?? 'active')) ?>"><?= e(ucwords(str_replace('_', ' ', $course['status'] ?? 'active'))) ?></span>
        <p><?= e($course['description'] ?? 'No description yet.') ?></p>
    </div>
</div>

<?php if (!$modules): ?>
    <div class="empty-state large">
        <h3>No modules yet</h3>
        <p>Start your study plan by creating modules, topics, and lessons for this course.</p>
    </div>
<?php else: ?>
    <?php foreach ($modules as $module): ?>
        <section class="module-card">
            <div class="module-header">
                <h3><?= e($module['title']) ?></h3>
                <span><?= (int) ($module['sort_order'] ?? 0) ?></span>
            </div>

            <?php $topics = $topicMap[$module['id']] ?? []; ?>
            <?php if (!$topics): ?>
                <p class="muted">No topics created in this module yet.</p>
            <?php else: ?>
                <?php foreach ($topics as $topic): ?>
                    <div class="topic-block">
                        <h4><?= e($topic['title']) ?></h4>
                        <ul class="lesson-list">
                            <?php $lessons = $lessonMap[$topic['id']] ?? []; ?>
                            <?php if (!$lessons): ?>
                                <li class="muted">No lessons for this topic yet.</li>
                            <?php else: ?>
                                <?php foreach ($lessons as $lesson): ?>
                                    <li>
                                        <a href="<?= base_url('lessons/' . (int) $lesson['id']) ?>"><?= e($lesson['title']) ?></a>
                                        <small><?= e($lesson['status'] ?? 'pending') ?></small>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    <?php endforeach; ?>
<?php endif; ?>
