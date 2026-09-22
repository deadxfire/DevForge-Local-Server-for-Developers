<?php
/**
 * DevForge - Local Development Server Homepage
 * Auto-generated default page for http://localhost
 */
$phpVersion = phpversion();
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Apache 2.4';
$loadedExtensions = get_loaded_extensions();
natcasesort($loadedExtensions);

// Scan for local project folders in C:\DevForge\projects
$projects = [];
$dir = __DIR__;
if (is_dir($dir)) {
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..' || !is_dir($dir . '/' . $item)) continue;
        $projects[] = $item;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevForge - Local Development Server</title>
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg: #F9FAFB;
            --card-bg: #FFFFFF;
            --text-main: #111827;
            --text-muted: #6B7280;
            --border: #E5E7EB;
            --badge-bg: #EEF2FF;
            --badge-text: #4338CA;
            --success: #10B981;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; }
        body { background: var(--bg); color: var(--text-main); line-height: 1.6; padding: 40px 20px; }
        .container { max-width: 960px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 40px; }
        .badge-devforge { display: inline-block; background: var(--badge-bg); color: var(--badge-text); font-weight: 600; font-size: 12px; padding: 4px 12px; border-radius: 9999px; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        h1 { font-size: 36px; font-weight: 800; color: var(--text-main); letter-spacing: -0.02em; margin-bottom: 8px; }
        h1 span { color: var(--primary); }
        .subtitle { color: var(--text-muted); font-size: 16px; max-width: 600px; margin: 0 auto; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 32px; }
        .card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .card-title { font-size: 16px; font-weight: 700; margin-bottom: 12px; display: flex; align-items: center; justify-content: space-between; }
        .stat-list { list-style: none; }
        .stat-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #F3F4F6; font-size: 14px; }
        .stat-item:last-child { border-bottom: none; }
        .stat-label { color: var(--text-muted); }
        .stat-value { font-weight: 600; font-family: Consolas, monospace; }
        .btn-link { display: inline-flex; align-items: center; justify-content: center; width: 100%; padding: 10px 16px; margin-top: 12px; background: var(--primary); color: #FFF; text-decoration: none; border-radius: 8px; font-size: 14px; font-weight: 600; transition: background 0.15s; }
        .btn-link:hover { background: var(--primary-hover); }
        .btn-link.secondary { background: #F3F4F6; color: var(--text-main); border: 1px solid var(--border); }
        .btn-link.secondary:hover { background: #E5E7EB; }
        .projects-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; padding: 24px; margin-bottom: 32px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .project-list { list-style: none; margin-top: 12px; display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }
        .project-item a { display: block; padding: 12px; border: 1px solid var(--border); border-radius: 8px; text-decoration: none; color: var(--text-main); font-weight: 600; font-size: 14px; background: #FAFAFA; transition: all 0.15s; }
        .project-item a:hover { border-color: var(--primary); background: #EEF2FF; color: var(--primary); }
        .empty-projects { color: var(--text-muted); font-size: 14px; font-style: italic; padding: 12px 0; }
        .footer { text-align: center; color: var(--text-muted); font-size: 13px; margin-top: 40px; border-top: 1px solid var(--border); padding-top: 24px; }
        code { background: #F3F4F6; padding: 2px 6px; border-radius: 4px; font-family: Consolas, monospace; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <span class="badge-devforge">Standalone Local Server</span>
            <h1>Welcome to <span>DevForge</span></h1>
            <p class="subtitle">Your individual, high-performance local web development suite is running smoothly.</p>
        </header>

        <div class="grid">
            <div class="card">
                <div class="card-title">
                    <span>Environment Specs</span>
                    <span style="color: var(--success);">&#9679; Active</span>
                </div>
                <ul class="stat-list">
                    <li class="stat-item"><span class="stat-label">PHP Version</span><span class="stat-value"><?= htmlspecialchars($phpVersion) ?></span></li>
                    <li class="stat-item"><span class="stat-label">Web Server</span><span class="stat-value"><?= htmlspecialchars($serverSoftware) ?></span></li>
                    <li class="stat-item"><span class="stat-label">Document Root</span><span class="stat-value"><?= htmlspecialchars(__DIR__) ?></span></li>
                    <li class="stat-item"><span class="stat-label">Loaded Modules</span><span class="stat-value"><?= count($loadedExtensions) ?> extensions</span></li>
                </ul>
            </div>

            <div class="card">
                <div class="card-title">
                    <span>Database (MySQL)</span>
                    <span style="color: var(--success);">&#9679; Port 3306</span>
                </div>
                <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 12px;">Manage MySQL databases, users, and tables with phpMyAdmin.</p>
                <a href="http://phpmyadmin.test" target="_blank" class="btn-link">Open phpMyAdmin &rarr;</a>
            </div>

            <div class="card">
                <div class="card-title">
                    <span>Mailpit (SMTP)</span>
                    <span style="color: var(--success);">&#9679; Port 8025</span>
                </div>
                <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 12px;">Capture and inspect outgoing test emails in real time.</p>
                <a href="http://localhost:8025/" target="_blank" class="btn-link secondary">Open Mail Inbox &rarr;</a>
            </div>
        </div>

        <div class="projects-card">
            <div class="card-title">
                <span>Local Projects</span>
                <span style="font-size: 13px; color: var(--text-muted); font-weight: normal;">Directory: <code>C:\DevForge\projects</code></span>
            </div>
            <?php if (!empty($projects)): ?>
                <ul class="project-list">
                    <?php foreach ($projects as $project): ?>
                        <li class="project-item">
                            <a href="http://<?= htmlspecialchars($project) ?>.test" target="_blank">
                                &bull; <?= htmlspecialchars($project) ?>.test
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="empty-projects">No project subdirectories found yet. Create a folder in <code>C:\DevForge\projects\&lt;project_name&gt;</code> to automatically route to <code>http://&lt;project_name&gt;.test</code>.</p>
            <?php endif; ?>
        </div>

        <footer class="footer">
            DevForge Local Development Environment &bull; Built with love by Arindam Makar
        </footer>
    </div>
</body>
</html>
