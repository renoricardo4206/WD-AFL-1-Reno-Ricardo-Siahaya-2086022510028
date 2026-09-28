<?php require("controller.php"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>AFL-1 - Office</title>
</head>
<body>
<div class="container py-4">
    <div class="wrap card mx-auto">
        <div class="card-header p-0 border-0">
            <ul class="nav tabbar mb-0">
                <li class="nav-item"><a class="nav-link" href="viewEmployee.php">Employee</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link active" href="viewOffice.php">Office</a></li>
                <li class="nav-item separator">|</li>
                <li class="nav-item"><a class="nav-link" href="viewRelation.php">Office-Employees</a></li>
            </ul>
        </div>
        <div class="card-body">
            <h2 class="section-title">List Kantor</h2>
            <div class="table-responsive">
            <table class="table list-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kantor</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Telepon</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 0;
                    $allOffice = getAllOffice();
                    if (empty($allOffice)) { ?>
                        <tr><td colspan="6" class="empty-row">Belum ada kantor.</td></tr>
                    <?php } else {
                        foreach ($allOffice as $index => $office) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= e($office->namaKantor) ?></td>
                            <td><?= e($office->alamat) ?></td>
                            <td><?= e($office->kota) ?></td>
                            <td><?= e($office->telepon) ?></td>
                            <td>
                                <a class="delete-link" href="controller.php?deleteOfficeID=<?= $index ?>"
                                   onclick="return confirm('Hapus kantor ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            </div>

            <h2 class="section-title">Tambah Kantor</h2>
            <form method="POST" action="controller.php">
                <div class="mb-3">
                    <label for="inputNamaKantor" class="form-label">Nama Kantor</label>
                    <input type="text" class="form-control" id="inputNamaKantor" name="inputNamaKantor" placeholder="Masukkan Nama Kantor" required>
                </div>
                <div class="mb-3">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="inputAlamat" name="inputAlamat" placeholder="Masukkan Alamat" required>
                </div>
                <div class="mb-3">
                    <label for="inputKota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="inputKota" name="inputKota" placeholder="Masukkan Kota" required>
                </div>
                <div class="mb-3">
                    <label for="inputTelepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="inputTelepon" name="inputTelepon" placeholder="Masukkan Telepon" required>
                </div>
                <button name="button_submit_office" type="submit" class="btn btn-primary d-block mx-auto px-4">Submit</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
