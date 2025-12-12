<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Backup Table with Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
    <h2 class="mb-4">Backups</h2>

    <!-- Add Backup Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBackupModal">
        Add Backup
    </button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Backup ID</th>
                <th>Backup Name</th>
                <th>Backup Type</th>
                <th>File Path</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>backup_2025_12_11.sql</td>
                <td>daily</td>
                <td>backups/backup_2025_12_11.sql</td>
                <td>2025-12-11 16:00</td>
                <td>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewBackupModal">
                        View
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- View Backup Modal -->
<div class="modal fade" id="viewBackupModal" tabindex="-1" aria-labelledby="viewBackupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBackupModalLabel">Backup Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Backup ID:</strong> 1</p>
        <p><strong>Backup Name:</strong> backup_2025_12_11.sql</p>
        <p><strong>Backup Type:</strong> daily</p>
        <p><strong>File Path:</strong> backups/backup_2025_12_11.sql</p>
        <p><strong>Created At:</strong> 2025-12-11 16:00</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Backup Modal -->
<div class="modal fade" id="addBackupModal" tabindex="-1" aria-labelledby="addBackupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addBackupModalLabel">Add New Backup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="backupName" class="form-label">Backup Name</label>
            <input type="text" class="form-control" id="backupName" required>
          </div>
          <div class="mb-3">
            <label for="backupType" class="form-label">Backup Type</label>
            <select class="form-select" id="backupType" required>
              <option value="">Select Type</option>
              <option value="daily">Daily</option>
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="filePath" class="form-label">File Path</label>
            <input type="text" class="form-control" id="filePath" required>
          </div>
          <div class="mb-3">
            <label for="createdAt" class="form-label">Created At</label>
            <input type="datetime-local" class="form-control" id="createdAt" required>
          </div>
          <button type="submit" class="btn btn-primary">Save Backup</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
