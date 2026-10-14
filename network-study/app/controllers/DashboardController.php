<?php
class DashboardController extends BaseController
{
    public function index(): void
    {
        $totalCourses = (int) Database::fetchOne('SELECT COUNT(*) as total FROM courses')['total'];
        $activeCourses = (int) Database::fetchOne('SELECT COUNT(*) as total FROM courses WHERE status = :status', ['status' => 'active'])['total'];
        $totalLessons = (int) Database::fetchOne('SELECT COUNT(*) as total FROM lessons')['total'];
        $completedLessons = (int) Database::fetchOne('SELECT COUNT(*) as total FROM lesson_progress WHERE progress_percent >= 100')['total'];
        $inProgressLessons = (int) Database::fetchOne('SELECT COUNT(*) as total FROM lesson_progress WHERE progress_percent > 0 AND progress_percent < 100')['total'];
        $pendingLessons = max(0, $totalLessons - $completedLessons - $inProgressLessons);

        $studyHours = (float) Database::fetchOne('SELECT COALESCE(SUM(duration_minutes), 0) as total FROM study_sessions')['total'];
        $studyHours = round($studyHours / 60, 2);

        $recentSessions = Database::fetchAll(
            'SELECT ss.*, l.title as lesson_title, c.name as course_name
             FROM study_sessions ss
             LEFT JOIN lessons l ON l.id = ss.lesson_id
             LEFT JOIN topics t ON t.id = l.topic_id
             LEFT JOIN modules m ON m.id = t.module_id
             LEFT JOIN courses c ON c.id = m.course_id
             ORDER BY ss.session_date DESC, ss.created_at DESC
             LIMIT 5'
        );

        $courses = Database::fetchAll(
            'SELECT c.*, 
                    (SELECT COUNT(*) FROM modules m WHERE m.course_id = c.id) as module_count,
                    (SELECT COUNT(*) FROM topics t JOIN modules m2 ON m2.id = t.module_id WHERE m2.course_id = c.id) as topic_count,
                    (SELECT COUNT(*) FROM lessons l JOIN topics t2 ON t2.id = l.topic_id JOIN modules m3 ON m3.id = t2.module_id WHERE m3.course_id = c.id) as lesson_count,
                    (SELECT COALESCE(SUM(sp.progress_percent),0) FROM lesson_progress sp JOIN lessons l2 ON l2.id = sp.lesson_id JOIN topics t3 ON t3.id = l2.topic_id JOIN modules m4 ON m4.id = t3.module_id WHERE m4.course_id = c.id) / NULLIF((SELECT COUNT(*) FROM lessons l3 JOIN topics t4 ON t4.id = l3.topic_id JOIN modules m5 ON m5.id = t4.module_id WHERE m5.course_id = c.id), 0) * 100 AS progress_percent
             FROM courses c
             ORDER BY c.updated_at DESC'
        );

        foreach ($courses as &$course) {
            $course['progress_percent'] = round((float) ($course['progress_percent'] ?? 0), 1);
        }
        unset($course);

        $tasks = Database::fetchAll(
            'SELECT st.*, c.name as course_name, l.title as lesson_title
             FROM study_tasks st
             LEFT JOIN courses c ON c.id = st.course_id
             LEFT JOIN lessons l ON l.id = st.lesson_id
             WHERE st.status != :done
             ORDER BY st.due_date ASC, st.created_at DESC
             LIMIT 6',
            ['done' => 'completed']
        );

        $stats = [
            'total_courses' => $totalCourses,
            'active_courses' => $activeCourses,
            'overall_progress' => $totalLessons > 0 ? round((($completedLessons / $totalLessons) * 100), 1) : 0,
            'completed_lessons' => $completedLessons,
            'in_progress_lessons' => $inProgressLessons,
            'pending_lessons' => $pendingLessons,
            'study_hours' => $studyHours,
            'streak' => 12,
            'quiz_average' => 84,
        ];

        $this->render('dashboard', [
            'stats' => $stats,
            'courses' => $courses,
            'tasks' => $tasks,
            'recentSessions' => $recentSessions,
        ]);
    }
}
