# Personal Network Engineering Study Platform

This project is a self-hosted PHP + MySQL study platform for networking and technical learning. It is structured for XAMPP on Windows and is designed to run at:

http://localhost/network-study/

## Stage 1: architecture, schema, and local installation

This initial release includes:

- PHP 8 application bootstrap and routing
- MySQL PDO connection layer with prepared statements
- Normalized database schema and seed data for an ENCOR-first plan
- Dashboard displaying real course statistics from MySQL
- Course list and creation form
- Lesson detail view with notes editor and study metadata
- Responsive dashboard UI
- XAMPP-ready config and install instructions

## Directory tree

```text
network-study/
├── app/
│   ├── bootstrap.php
│   ├── helpers.php
│   ├── controllers/
│   │   ├── BaseController.php
│   │   ├── DashboardController.php
│   │   ├── CourseController.php
│   │   └── LessonController.php
│   └── core/
│       ├── Database.php
│       └── View.php
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── config/
│   └── config.php
├── database/
│   ├── schema.sql
│   ├── seed.sql
│   └── sample-import.csv
├── storage/
│   └── uploads/
├── templates/
│   ├── layout.php
│   ├── dashboard.php
│   ├── courses/
│   │   ├── form.php
│   │   ├── index.php
│   │   └── show.php
│   └── lessons/
│       └── detail.php
├── .htaccess
├── index.php
├── README.md
└── LICENSE (optional)
```

## Local installation (XAMPP on Windows)

1. Copy this folder into your XAMPP `htdocs` directory.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin.
4. Create a database named `network_study`.
5. Import the SQL schema and seed data from `database/schema.sql` and `database/seed.sql`.
6. Edit `config/config.php` to match your local database credentials if needed.
7. Open `http://localhost/network-study/` in your browser.

## Database configuration

The default config is:

```php
'host' => '127.0.0.1',
'port' => 3306,
'name' => 'network_study',
'user' => 'root',
'pass' => '',
```

Update those values if your XAMPP installation uses a different MySQL user and password.

## Notes

- This architecture is designed to extend naturally to later stages: quiz, flashcards, labs, planner, and analytics.
- The sample lesson is intentionally real but minimal; the application is ready for your personal study notes and resource links.
- Uploaded files should be stored in `storage/uploads` and tracked via the `resources` table.

## Next stage

The next step is to add richer study lifecycle features: module/topic management, lesson editing forms, quiz authoring, flashcards, and labs. This stage establishes the secure foundation and working data model required for those features.
