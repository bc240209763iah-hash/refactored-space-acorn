<?php
class CourseController extends BaseController
{
    public function index(): void
    {
        $courses = Database::fetchAll(
            'SELECT c.*, 
                    (SELECT COUNT(*) FROM modules m WHERE m.course_id = c.id) as module_count,
                    (SELECT COUNT(*) FROM lessons l JOIN topics t ON t.id = l.topic_id JOIN modules m2 ON m2.id = t.module_id WHERE m2.course_id = c.id) as lesson_count,
                    (SELECT COALESCE(SUM(lp.progress_percent),0) FROM lesson_progress lp JOIN lessons l2 ON l2.id = lp.lesson_id JOIN topics t2 ON t2.id = l2.topic_id JOIN modules m3 ON m3.id = t2.module_id WHERE m3.course_id = c.id) / NULLIF((SELECT COUNT(*) FROM lessons l3 JOIN topics t3 ON t3.id = l3.topic_id JOIN modules m4 ON m4.id = t3.module_id WHERE m4.course_id = c.id), 0) * 100 AS progress_percent
             FROM courses c
             ORDER BY c.updated_at DESC'
        );

        foreach ($courses as &$course) {
            $course['progress_percent'] = round((float) ($course['progress_percent'] ?? 0), 1);
        }
        unset($course);

        $this->render('courses/index', ['courses' => $courses]);
    }

    public function createForm(): void
    {
        $this->render('courses/form', ['course' => null]);
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $category = trim($_POST['category'] ?? 'General');
        $status = trim($_POST['status'] ?? 'active');
        $target = trim($_POST['target_goal'] ?? '');
        $priority = trim($_POST['priority'] ?? 'medium');
        $color = trim($_POST['color'] ?? '#4f46e5');
        $icon = trim($_POST['icon'] ?? 'book-open');
        $estimatedHours = (float) ($_POST['estimated_hours'] ?? 0);
        $dailyTarget = (float) ($_POST['daily_target_hours'] ?? 1);

        if ($name === '') {
            $this->render('courses/form', ['error' => 'Course name is required.']);
            return;
        }

        Database::execute(
            'INSERT INTO courses (name, description, category, target_goal, status, priority, color, icon, estimated_hours, daily_target_hours, created_at, updated_at)
             VALUES (:name, :description, :category, :target_goal, :status, :priority, :color, :icon, :estimated_hours, :daily_target_hours, NOW(), NOW())',
            [
                'name' => $name,
                'description' => $description,
                'category' => $category,
                'target_goal' => $target,
                'status' => $status,
                'priority' => $priority,
                'color' => $color,
                'icon' => $icon,
                'estimated_hours' => $estimatedHours,
                'daily_target_hours' => $dailyTarget,
            ]
        );

        redirect('courses');
    }

    public function show(int $id): void
    {
        $course = Database::fetchOne('SELECT * FROM courses WHERE id = :id', ['id' => $id]);
        if (!$course) {
            http_response_code(404);
            echo 'Course not found';
            return;
        }

        $modules = Database::fetchAll(
            'SELECT * FROM modules WHERE course_id = :course_id ORDER BY sort_order ASC, created_at ASC',
            ['course_id' => $id]
        );

        $topicMap = [];
        foreach ($modules as $module) {
            $topics = Database::fetchAll(
                'SELECT * FROM topics WHERE module_id = :module_id ORDER BY sort_order ASC, created_at ASC',
                ['module_id' => $module['id']]
            );
            $topicMap[$module['id']] = $topics;
        }

        $lessonMap = [];
        foreach ($topicMap as $moduleId => $topics) {
            foreach ($topics as $topic) {
                $lessons = Database::fetchAll(
                    'SELECT * FROM lessons WHERE topic_id = :topic_id ORDER BY sort_order ASC, created_at ASC',
                    ['topic_id' => $topic['id']]
                );
                $lessonMap[$topic['id']] = $lessons;
            }
        }

        $this->render('courses/show', [
            'course' => $course,
            'modules' => $modules,
            'topicMap' => $topicMap,
            'lessonMap' => $lessonMap,
        ]);
    }
}
