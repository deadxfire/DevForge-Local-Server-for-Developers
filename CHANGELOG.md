# Changelog

All notable changes to **DevForge** will be documented in this file.

## [2.0.0] - 2026-09-26

### Major Release & Critical Fixes
- **WPF UI Thread Deadlock Resolution**: Resolved a critical startup race condition where synchronous awaiting (`Task.WhenAll(...).GetAwaiter().GetResult()`) of `ConfigService.InitializeAsync()` and `SettingsService.LoadSettingsAsync()` deadlocked on the WPF UI thread due to internal `SemaphoreSlim` contention. Offloaded initialization to `Task.Run()` so the dashboard interface and tray icon initialize instantly and smoothly without freezing or lingering in background headless state.
- **MySQL 8.4 Component Reference Cache Clean Startup**: Configured `loose_component_reference_cache = OFF` and `mysqlx = 0` across dynamic configuration generators, template files, and portable configurations. This eliminates the benign MySQL startup stderr warning (`mysqld: Can't open shared library component_reference_cache.dll errno: 126`) and ensures pure zero-warning engine startups.
- **MySQL Collision Isolation Hardening**: Hardened database collision quarantine test suites and runtime algorithms to ensure existing projects and colliding databases (such as `phpmyadmin`) are safely and automatically isolated into `data\mysql_quarantine` without data loss.
- **Production-Ready Quality Assurance**: Verified all 280 test fixtures pass with zero regressions; validated single-file assembly bundling and Authenticode digital signatures across all binaries.

### Improved
- Bumped application, core assembly, and metadata versions uniformly to `2.0.0`.
- Updated Portable Edition binary package and standalone setup installer payload.

## [1.0.8] - 2026-09-26

### Fixed
- **Windows 11 Application Control / Smart App Control Policy Resolution (0x800711C7)**: Converted the DevForge core application packaging to a fully self-contained Single-File bundle with in-memory assembly loading. This completely eliminates loose unverified DLLs (`DevForge.Services.dll`, `DevForge.Core.dll`, `DevForge.Infrastructure.dll`) on disk that trigger Windows Smart App Control (SAC) and WDAC blocks.
- **Authenticode Code Signing**: Added automated Authenticode digital signing with SHA-256 and trusted timestamping to both `DevForge.App.exe` and `DevForge-Setup.exe` to establish binary trust and prevent SmartScreen / security policy warnings.
- **WPF Application Dispatcher Synchronization**: Synchronized startup initialization and enforced `ShutdownMode.OnExplicitShutdown`, eliminating premature process terminations and ensuring the main dashboard window and system tray icon stay open reliably.
- **Installer Legacy Cleanup & Zone Identifier Unblocking**: Added automated post-install cleanup of legacy loose `.dll` files from prior versions and execution of `Unblock-File` across application binaries to strip Mark-of-the-Web (`Zone.Identifier`) flags.

### Improved
- Streamlined Portable Edition layout: eliminated hundreds of loose runtime DLLs, consolidating the executable into a single, clean binary.
- Updated Portable Edition binaries and standalone setup package to v1.0.8.

## [1.0.7] - 2026-09-26

### Fixed
- **External Quarantine Isolation**: Relocated the database and redo log quarantine directories completely outside the MySQL datadir (`data\mysql_quarantine`). This prevents MySQL InnoDB's catalog scanner from detecting quarantined `.ibd` files and permanently resolves the fatal `Multiple files found for the same tablespace ID` collision error.
- **Legacy Quarantine Eviction**: The installer and service manager now proactively sweep and evict any legacy `_quarantined_*` directories and `#innodb_redo.bak*` folders left inside the active datadir from previous updates.
- **Enhanced Startup Verification & Error Capture**: Increased startup health verification with iterative TCP port responsiveness checks up to 2500ms and deep diagnostic capture combining both stderr and `mysql_error.log` output.
- **Universal Orphan Catalog Resolution**: Automated resolution prioritizes active developer projects and safely isolates colliding orphaned catalogs.

### Improved
- Cleaned transient InnoDB redo, temp, and doublewrite files from distribution staging packages so target machines initialize cleanly on first launch.
- Upgraded standalone installer payload and Portable Edition assemblies to v1.0.7.

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
