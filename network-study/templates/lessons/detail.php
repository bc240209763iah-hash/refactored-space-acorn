<?php
$lesson = $lesson ?? [];
$note = $note ?? null;
$progress = $progress ?? ['progress_percent' => 0, 'status' => 'pending'];
$course = $course ?? null;
?>
<div class="lesson-layout">
    <aside class="lesson-sidebar">
        <div class="panel small-panel">
            <p class="eyebrow">Course</p>
            <h3><?= e($course['name'] ?? 'Course') ?></h3>
        </div>
        <div class="panel small-panel">
            <p class="eyebrow">Lesson status</p>
            <div class="mini-progress"><span style="width: <?= (int) ($progress['progress_percent'] ?? 0) ?>%"></span></div>
            <small><?= (int) ($progress['progress_percent'] ?? 0) ?>% complete</small>
        </div>
        <div class="panel small-panel">
            <p class="eyebrow">Study resources</p>
            <ul class="resource-list">
                <li>Video: <?= e($lesson['video_title'] ?? 'Not linked yet') ?></li>
                <li>Book: <?= e($lesson['book_pages'] ?? 'Not set') ?></li>
                <li>Lab: To be documented</li>
            </ul>
        </div>
    </aside>

    <article class="lesson-main panel">
        <div class="page-header compact">
            <div>
                <p class="eyebrow">Lesson</p>
                <h1><?= e($lesson['title'] ?? 'Untitled lesson') ?></h1>
            </div>
            <div class="lesson-actions">
                <button class="ghost-button" type="button" data-theme-toggle>Theme</button>
                <button class="ghost-button" type="button" data-font-size>Font +</button>
            </div>
        </div>

        <div class="lesson-meta">
            <span><?= e($lesson['status'] ?? 'pending') ?></span>
            <span><?= (int) ($lesson['estimated_minutes'] ?? 0) ?> min</span>
            <span>Book pages: <?= e($lesson['book_pages'] ?? 'N/A') ?></span>
        </div>

        <div class="lesson-body">
            <section>
                <h3>Concept</h3>
                <p><?= nl2br(e($lesson['content'] ?? 'Write your lesson concept here...')) ?></p>
            </section>

            <section>
                <h3>How it works</h3>
                <pre><code>interface GigabitEthernet0/1
 ip address 10.10.10.2 255.255.255.0
 no shutdown</code></pre>
            </section>

            <section>
                <h3>Verification commands</h3>
                <pre><code>show ip route
show interfaces status
ping 10.10.10.1</code></pre>
            </section>

            <section>
                <h3>Lab</h3>
                <ul>
                    <li>Verify interface status and IP reachability.</li>
                    <li>Confirm routing table matches expected topology.</li>
                    <li>Document any missing neighbor state.</li>
                </ul>
            </section>
        </div>

        <form class="notes-form" method="post" action="<?= base_url('lessons/' . (int) ($lesson['id'] ?? 0) . '/save-note') ?>">
            <div class="form-header-row">
                <h3>Personal notes</h3>
                <span id="save-status" class="save-status">Not saved yet</span>
            </div>
            <label>
                <span>Note title</span>
                <input type="text" name="note_title" value="<?= e($note['note_title'] ?? 'Lesson notes') ?>">
            </label>
            <textarea name="note_body" rows="10" placeholder="Write your explanations, examples, commands, and pitfalls."><?= e($note['note_body'] ?? '') ?></textarea>
            <div class="form-actions">
                <button class="primary-button" type="submit">Save notes</button>
            </div>
        </form>
    </article>
</div>
