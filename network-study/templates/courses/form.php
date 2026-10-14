<?php
$error = $error ?? null;
?>
<div class="page-header">
    <div>
        <p class="eyebrow">New learning plan</p>
        <h1>Create a course</h1>
    </div>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<form class="form-card" method="post" action="<?= base_url('courses/create') ?>">
    <div class="form-grid">
        <label>
            <span>Course name</span>
            <input type="text" name="name" required>
        </label>
        <label>
            <span>Category</span>
            <select name="category">
                <option>Networking</option>
                <option>Security</option>
                <option>Linux</option>
                <option>Python</option>
                <option>CCNA</option>
                <option>CCNP</option>
            </select>
        </label>
        <label>
            <span>Priority</span>
            <select name="priority">
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>
        </label>
        <label>
            <span>Status</span>
            <select name="status">
                <option value="active" selected>Active</option>
                <option value="paused">Paused</option>
                <option value="completed">Completed</option>
            </select>
        </label>
        <label class="full-width">
            <span>Description</span>
            <textarea name="description" rows="4" placeholder="Describe the learning goals, target skills, and exam outcome."></textarea>
        </label>
        <label>
            <span>Target goal / exam</span>
            <input type="text" name="target_goal" placeholder="CCNP ENCOR 350-401">
        </label>
        <label>
            <span>Estimated hours</span>
            <input type="number" name="estimated_hours" step="0.5" value="40">
        </label>
        <label>
            <span>Daily target hours</span>
            <input type="number" name="daily_target_hours" step="0.5" value="1.5">
        </label>
        <label>
            <span>Color</span>
            <input type="color" name="color" value="#4f46e5">
        </label>
        <label>
            <span>Icon</span>
            <input type="text" name="icon" value="book-open">
        </label>
    </div>

    <div class="form-actions">
        <a class="ghost-button" href="<?= base_url('courses') ?>">Cancel</a>
        <button class="primary-button" type="submit">Save course</button>
    </div>
</form>
