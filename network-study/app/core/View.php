<?php
class View
{
    public static function render(string $template, array $data = [], bool $includeLayout = true): void
    {
        $templateFile = APP_ROOT . '/templates/' . ltrim($template, '/') . '.php';

        if (!file_exists($templateFile)) {
            throw new RuntimeException('Template not found: ' . $templateFile);
        }

        extract($data, EXTR_SKIP);

        if ($includeLayout) {
            require APP_ROOT . '/templates/layout.php';
            return;
        }

        require $templateFile;
    }
}
