
<?php
include "../config/db.php";


if (isset($_POST['backup'])) {
    $tables = array();
    $result = $conn->query("SHOW TABLES");
    
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
    
    $backup = '';
    
    foreach ($tables as $table) {
        $result = $conn->query("SELECT * FROM $table");
        $numColumns = $result->field_count;
        
        $backup .= "DROP TABLE IF EXISTS $table;\n";
        
        $createTable = $conn->query("SHOW CREATE TABLE $table");
        $row = $createTable->fetch_array();
        $backup .= $row[1] . ";\n\n";
        
        while ($row = $result->fetch_array()) {
            $backup .= "INSERT INTO $table VALUES(";
            for ($i = 0; $i < $numColumns; $i++) {
                $backup .= isset($row[$i]) ? "'" . $conn->real_escape_string($row[$i]) . "'" : 'NULL';
                if ($i < $numColumns - 1) {
                    $backup .= ", ";
                }
            }
            $backup .= ");\n";
        }
        $backup .= "\n";
    }
    
    // Save backup file
    $backupDir = 'backups/';
    if (!file_exists($backupDir)) {
        mkdir($backupDir, 0755, true);
    }
    
    $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
    $filepath = $backupDir . $filename;
    file_put_contents($filepath, $backup);
    
    $message = "Backup created successfully: " . $filename;
}

// Download backup
if (isset($_GET['download'])) {
    $file = 'backups/' . basename($_GET['download']);
    if (file_exists($file)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}

// Delete backup
if (isset($_GET['delete'])) {
    $file = 'backups/' . basename($_GET['delete']);
    if (file_exists($file)) {
        unlink($file);
        header('Location: index.php?page=backup');
        exit;
    }
}

// Get list of backups
$backups = array();
if (is_dir('backups/')) {
    $files = scandir('backups/', SCANDIR_SORT_DESCENDING);
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'sql') {
            $filepath = 'backups/' . $file;
            $backups[] = array(
                'name' => $file,
                'size' => filesize($filepath),
                'date' => date('Y-m-d H:i:s', filemtime($filepath))
            );
        }
    }
}

function formatBytes($bytes) {
    if ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } else {
        return $bytes . ' B';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Backup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
        .backup-section {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead {
            background-color: #4CAF50;
            color: white;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-download {
            background-color: #2196F3;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-download:hover {
            background-color: #0b7dda;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-delete:hover {
            background-color: #da190b;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Database Backup Manager</h1>
        
        <?php if (isset($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <div class="backup-section">
            <h2>Create New Backup</h2>
            <p>Click the button below to create a backup of your database.</p>
            <form method="POST">
                <button type="submit" name="backup">Create Backup</button>
            </form>
        </div>
        
        <h2>Available Backups</h2>
        
        <?php if (empty($backups)): ?>
            <div class="no-data">No backups found. Create your first backup!</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Size</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($backups as $backup): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($backup['name']); ?></td>
                            <td><?php echo formatBytes($backup['size']); ?></td>
                            <td><?php echo $backup['date']; ?></td>
                            <td>
                                <a href="index.php?page=backup&download=<?php echo urlencode($backup['name']); ?>" 
                                   class="btn-download">Download</a>
                                <a href="index.php?page=backup&delete=<?php echo urlencode($backup['name']); ?>" 
                                   class="btn-delete"
                                   onclick="return confirm('Are you sure you want to delete this backup?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">← Back to Home</a>
    </div>
</body>
</html>