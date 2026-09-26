# Changelog

All notable changes to **DevForge** will be documented in this file.

## [1.0.6] - 2026-09-26

### Added
- **Automated MySQL InnoDB Log Auto-Recovery**: Built-in intelligent auto-recovery in `MysqlManager` that detects redo log incompatibilities, version mismatch errors (e.g. error 3508 / 126), and crash states, automatically quarantining problematic transient redo logs into timestamped backups and restarting the engine safely without data loss.
- **Installer Upgrade Transient Cleaner**: Inno Setup installer now automatically detects and cleans legacy transient redo log directories (`#innodb_redo`, `#ib_redo*`) and leftover lock/socket artifacts during installation and upgrades so MySQL starts cleanly out-of-the-box.
- **Intelligent Multi-Phase Service Startup**: Added pre-flight health checks and retry orchestration to capture early stderr warnings, repair corrupted transient states, and guarantee service readiness.

### Improved
- Preserves all user database catalogs, tablespaces (`.ibd`), and core InnoDB dictionaries (`ibdata1`) intact during automated recovery and installer updates.
- Hardened MySQL startup fingerprinting to recognize binary changes between releases and preemptively prepare data directories.
- Upgraded standalone installer payload and Portable Edition assemblies to v1.0.6.

## [1.0.5] - 2026-09-25

### Added
- Integrated automated GitHub Update Service with live release checking against official repository.
- Added one-click "Check for Updates" and "GitHub Repository" access in About and Settings screens.
- Added GitHub repository quick-links in default local development homepage (`http://localhost/`).
- Reverse proxy support (`mod_proxy`, `mod_proxy_http`, `mod_proxy_wstunnel`) for Node.js, Vite, and Next.js dev servers.
- Single Page Application (SPA) client-side rewrite routing for React, Vue, and Vite frontends.
- Permissive RFC validation allowing domain names with underscores (e.g. `nityam_flow.test`).

### Improved
- Cleaned and stabilized MySQL InnoDB redo log lifecycle avoiding destructive initialization loops.
- Tuned PHP 8.5 PDO MySQL driver compatibility and extension directories.
- Refined project scanner to cleanly isolate development server codebases.

### Fixed
- Fixed MySQL InnoDB "Multiple files found for the same tablespace ID" crash on multi-computer installations and updates.
- Added upgrade protection in installer to prevent merging or overwriting files in existing MySQL data directories.
- Switched installer build pipeline to automated pristine MySQL 8.4 system catalog initialization (`--initialize-insecure`).
- Added pre-flight tablespace collision detection and quarantine in `MysqlManager` to protect existing user databases.

## [1.0.4] - 2026-09-22

### Added
- Complete standalone Windows installer with Inno Setup integration.
- Multi-runtime support: PHP 8.2, PHP 8.3, and PHP 8.5.
- Node.js 20 & 22 LTS integration with bundled npm.
- MySQL 8.0 & 8.4 enterprise database support with automated service lifecycle.
- Mailpit local email server with web UI for local email testing.
- phpMyAdmin 5.2 pre-configured for instant database administration.
- Automatic Virtual Host generator with local hosts file mapping.
- Zero-config local SSL / HTTPS certificate generator for development domains.
- Windows System Tray integration with instant status notifications.

### Improved
- Asynchronous service start and stop orchestration.
- Modern Windows 10 & 11 UI with dark/light themes.
- Clean isolation of runtimes within `C:\DevForge`.

### Fixed
- Fixed port binding conflict detection on ports 80, 443, and 3306.
- Fixed temporary directory permissions for session files.
