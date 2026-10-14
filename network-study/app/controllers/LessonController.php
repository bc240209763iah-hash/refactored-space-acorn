<?php
class LessonController extends BaseController
{
    public function show(int $id): void
    {
        $lesson = Database::fetchOne('SELECT * FROM lessons WHERE id = :id', ['id' => $id]);
        if (!$lesson) {
            http_response_code(404);
            echo 'Lesson not found';
            return;
        }

        $note = Database::fetchOne('SELECT * FROM lesson_notes WHERE lesson_id = :lesson_id ORDER BY updated_at DESC LIMIT 1', ['lesson_id' => $id]);
        $progress = Database::fetchOne('SELECT * FROM lesson_progress WHERE lesson_id = :lesson_id', ['lesson_id' => $id]) ?? [
            'progress_percent' => 0,
            'status' => 'pending',
        ];

        $course = Database::fetchOne(
            'SELECT c.* FROM courses c JOIN modules m ON m.course_id = c.id JOIN topics t ON t.module_id = m.id WHERE t.id = :topic_id LIMIT 1',
            ['topic_id' => $lesson['topic_id']]
        );

        $this->render('lessons/detail', [
            'lesson' => $lesson,
            'note' => $note,
            'progress' => $progress,
            'course' => $course,
        ]);
    }

    public function saveNote(int $id): void
    {
        $noteBody = trim($_POST['note_body'] ?? '');
        $title = trim($_POST['note_title'] ?? 'Lesson notes');

        $existing = Database::fetchOne('SELECT * FROM lesson_notes WHERE lesson_id = :lesson_id LIMIT 1', ['lesson_id' => $id]);

        if ($existing) {
            Database::execute(
                'UPDATE lesson_notes SET note_title = :note_title, note_body = :note_body, updated_at = NOW() WHERE id = :id',
                [
                    'note_title' => $title,
                    'note_body' => $noteBody,
                    'id' => $existing['id'],
                ]
            );
        } else {
            Database::execute(
                'INSERT INTO lesson_notes (lesson_id, note_title, note_body, created_at, updated_at) VALUES (:lesson_id, :note_title, :note_body, NOW(), NOW())',
                [
                    'lesson_id' => $id,
                    'note_title' => $title,
                    'note_body' => $noteBody,
                ]
            );
        }

        header('Location: ' . base_url('lessons/' . $id));
        exit;
    }
}
