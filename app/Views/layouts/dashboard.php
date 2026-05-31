<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?> - NTURUBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 20px;
            overflow-y: auto;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }

        .sidebar-brand h4 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .sidebar-brand p {
            margin: 0;
            font-size: 12px;
            opacity: 0.8;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .nav-icon {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .topbar-title h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary);
        }

        .stat-card.success {
            border-left-color: var(--success);
        }

        .stat-card.danger {
            border-left-color: var(--danger);
        }

        .stat-card.warning {
            border-left-color: var(--warning);
        }

        .stat-card.info {
            border-left-color: var(--info);
        }

        .stat-icon {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            padding: 20px;
        }

        .card-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                padding: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">🎓</div>
                <div class="sidebar-brand">
                    <h4>NTURUBA</h4>
                    <p><?php echo htmlspecialchars($userRole); ?></p>
                </div>
            </div>

            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/dashboard/" class="nav-link active">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/students/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-users"></i></span>
                        <span>Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/teachers/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-chalkboard-user"></i></span>
                        <span>Teachers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/classes/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-door-open"></i></span>
                        <span>Classes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/exams/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-file-alt"></i></span>
                        <span>Exams</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/finance/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-money-bill"></i></span>
                        <span>Finance</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/library/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-book"></i></span>
                        <span>Library</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/inventory/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                        <span>Inventory</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Intergrated-school-mngmnt-sysm/public/hr/" class="nav-link">
                        <span class="nav-icon"><i class="fas fa-users-cog"></i></span>
                        <span>HR & Payroll</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <div class="topbar">
                <div class="topbar-title">
                    <h1><?php echo htmlspecialchars($title); ?></h1>
                </div>
                <div class="topbar-right">
                    <div class="user-menu">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($userName, 0, 1)); ?>
                        </div>
                        <div>
                            <p style="margin: 0; font-size: 14px; color: #333;"><?php echo htmlspecialchars($userName); ?></p>
                            <a href="/Intergrated-school-mngmnt-sysm/public/auth/logout" style="font-size: 12px; color: #667eea; text-decoration: none;">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content">
                <?php echo $content ?? ''; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
