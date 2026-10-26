<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Users</title>

    <!--begin::Theme Init (prevents flash of incorrect theme on load, #6043)-->
    <script>
      (() => {
        'use strict';
        const root = document.documentElement;

        // Applications with their own theming opt out of AdminLTE's color mode
        // entirely, here as well as in the bundle.
        if (root.getAttribute('data-lte-color-mode') === 'off') {
          return;
        }

        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          // localStorage may be unavailable (private mode, sandboxed iframe).
        }
        // Mirror the precedence in color-mode.ts: the visitor's stored choice
        // wins, then a theme this page declared itself, then the OS preference.
        const authored = root.getAttribute('data-bs-theme');
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (authored === 'dark' || authored === 'light') {
          resolved = authored;
        } else if (globalThis.matchMedia('(prefers-color-scheme: dark)').matches) {
          resolved = 'dark';
        }
        root.setAttribute('data-bs-theme', resolved);
        root.style.colorScheme = resolved;
        // Flag values computed here, so the bundle does not mistake them for a
        // theme the page declared and stop following the OS preference.
        if (resolved !== authored) {
          root.setAttribute('data-lte-theme-resolved', '');
        }
      })();
    </script>
    <!--end::Theme Init-->

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Users" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a free Bootstrap 5 admin dashboard template with almost 50 example pages, built with vanilla JS and designed with accessibility in mind."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <style>
      .student-photo {
        width: 42px;
        height: 42px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #e5e7eb;
        background: #f3f4f6;
        display: block;
      }
      .student-photo.fallback {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        color: #475569;
      }
      .table-toolbar .form-select,
      .table-toolbar .form-control {
        min-width: 150px;
      }
      .page-size-select {
        width: 110px;
      }
    </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
  
      <!--end::Header-->
      <!--begin::Sidebar-->
      
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Rekap Nilai Mahasiswa</h1>
              </div>
              <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nilai</li>
                  </ol>
                </nav>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-12">
                <!--begin::Card-->
                <div class="card mb-4">
                  <!--begin::Card Header-->
                  <div class="card-header">
                    <div class="row g-2 align-items-center">
                      <div class="col-12 col-md-4">
                        <h3 class="card-title">Direktori Nilai</h3>
                      </div>
                      <div class="col-12 col-md-8">
                        <div class="table-toolbar d-flex flex-wrap justify-content-md-end gap-2">
                          <div class="input-group input-group-sm w-auto">
                            <span class="input-group-text">
                              <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input
                              type="search"
                              id="user-search"
                              class="form-control"
                              placeholder="Search Berdasarkan Nama"
                              aria-label="Cari Data"
                              style="width: 190px"
                            />
                          </div>
                          <select
                            id="user-role-filter"
                            class="form-select form-select-sm w-auto"
                            aria-label="Filter by role"
                          >
                            <option value="all" selected>Semua Predikat</option>
                            <option value="sangat memuaskan">Sangat Memuaskan</option>
                            <option value="memuaskan">Memuaskan</option>
                            <option value="cukup memuaskan">Cukup Memuaskan</option>
                            <option value="kurang memuaskan">Kurang Memuaskan</option>
                            <option value="tidak lulus">Tidak Lulus</option>
                          </select>
                          <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-add-user"
                          >
                            <i class="bi bi-person-plus-fill me-1" aria-hidden="true"> </i>
                            Tambah Data Nilai
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Card Header-->
                  <?php
                    require_once __DIR__ . "/connection.php";
                    require_once __DIR__ . "/photo_table.php";

                    if (!mysqli_select_db($conn, "dbNilai")) {
                      http_response_code(500);
                      exit("Gagal memilih database dbNilai: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8"));
                    }

                    try {
                      ensurePhotoTable($conn);
                      ensureStudentPhotoTable($conn);
                    } catch (Throwable $error) {
                      http_response_code(500);
                      exit(htmlspecialchars($error->getMessage(), ENT_QUOTES, "UTF-8"));
                    }

                    $photoResult = mysqli_query(
                      $conn,
                      "SELECT id, nama_file, path_file FROM photo ORDER BY uploaded_at DESC, id DESC"
                    );
                    if (!$photoResult) {
                      http_response_code(500);
                      exit("Gagal membaca daftar foto: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8"));
                    }

                    $photos = [];
                    while ($photo = mysqli_fetch_assoc($photoResult)) {
                      $photos[] = $photo;
                    }
                    mysqli_free_result($photoResult);

                    $sql = "SELECT n.nim, n.nm_lengkap, n.nilai_akhir, n.nilai_huruf,
                                   n.predikat, n.created_date, n.modified_date,
                                   p.id AS foto_id,
                                   COALESCE(NULLIF(n.file_path, ''), p.path_file) AS foto_path
                            FROM nilai AS n
                            LEFT JOIN nilai_photo AS np ON np.nim = n.nim
                            LEFT JOIN photo AS p ON p.id = np.photo_id";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                      http_response_code(500);
                      exit("Gagal membaca data nilai: " . htmlspecialchars(mysqli_error($conn), ENT_QUOTES, "UTF-8"));
                    }

                    if (mysqli_num_rows($result) > 0) {
                      ?>
                  <!--begin::Card Body-->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover align-middle m-0">
                        <thead>
                          <tr>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>
                              <button
                                type="button"
                                id="nilai-sort"
                                class="btn btn-link p-0 text-body text-decoration-none fw-bold"
                                aria-label="Urutkan nilai akhir secara menurun"
                                aria-sort="descending"
                              >
                                Nilai Akhir <span id="nilai-sort-indicator" aria-hidden="true">↓</span>
                              </button>
                            </th>
                            <th>Nilai Huruf</th>
                            <th>Predikat</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diubah</th>
                            <th class="text-end">Aksi</th>
                          </tr>
                        </thead>

                        <tbody id="nilai-table-body">
                        <?php
                          while($row = mysqli_fetch_assoc($result)) {
                            $nim = trim((string) $row["nim"]);
                            $nama = trim((string) $row["nm_lengkap"]);
                            $fotoPath = trim((string) ($row["foto_path"] ?? ""));
                            $fotoName = $fotoPath !== "" ? basename($fotoPath) : "";
                            $fotoSrc = $fotoName !== "" ? "img/" . rawurlencode($fotoName) : "";
                            $fotoExists = $fotoName !== "" && is_file(
                              __DIR__ . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . $fotoName
                            );
                            $namaInisial = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', (string) $row["nm_lengkap"]), 0, 2));
                        ?>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">                        
                                <span class="fw-medium"><?php echo $nim !== "" ? htmlspecialchars($nim, ENT_QUOTES, 'UTF-8') : '<span class="text-muted">(NIM kosong)</span>'; ?></span>
                              </div>
                            </td>
                            <td>
                              <div class="d-flex align-items-center gap-2">
                                <?php if ($fotoExists): ?>
                                  <img
                                    class="student-photo"
                                    src="<?php echo htmlspecialchars($fotoSrc, ENT_QUOTES, 'UTF-8'); ?>"
                                    alt="Foto profil <?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>"
                                  />
                                <?php else: ?>
                                  <div class="student-photo fallback" aria-label="Foto profil belum tersedia"><?php echo htmlspecialchars($namaInisial !== '' ? $namaInisial : 'N', ENT_QUOTES, 'UTF-8'); ?></div>
                                <?php endif; ?>
                                <span class="fw-medium"><?php echo $nama !== "" ? htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') : '<span class="text-muted">(Nama kosong)</span>'; ?></span>
                              </div>
                            </td>
                            <td>
                              <span class="fw-medium"> <?php echo $row['nilai_akhir']; ?> </span>
                            </td>
                            <td>
                              <span class="fw-medium"><?php echo $row['nilai_huruf']; ?></span>
                            </td>
                            <td>
                              <span class="fw-medium"><?php echo $row['predikat']; ?></span>
                            </td>
                            <td>
                              <span class="fw-medium"><?php echo $row['created_date']; ?></span>
                            </td>
                            <td>
                              <span class="fw-medium"><?php echo $row['modified_date']; ?></span>
                            </td>
                            <td class="text-end">
                              <div class="btn-group btn-group-sm">
                                <button
                                  type="button"
                                  class="btn btn-outline-secondary"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-edit-user"
                                  data-nim="<?php echo htmlspecialchars($nim, ENT_QUOTES, 'UTF-8'); ?>"
                                  data-nama="<?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>"
                                  data-nilai="<?php echo htmlspecialchars($row['nilai_akhir'], ENT_QUOTES, 'UTF-8'); ?>"
                                  data-foto-id="<?php echo htmlspecialchars((string) ($row['foto_id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"
                                  aria-label="Edit data <?php echo $nama !== "" ? htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') : 'mahasiswa tanpa nama'; ?>"
                                >
                                  <i class="bi bi-pencil" aria-hidden="true"> </i>
                                </button>
                                <button
                                  type="button"
                                  class="btn btn-outline-danger"
                                  data-bs-toggle="modal"
                                  data-bs-target="#modal-delete-user"
                                  data-nim="<?php echo htmlspecialchars($nim, ENT_QUOTES, 'UTF-8'); ?>"
                                  data-nama="<?php echo htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?>"
                                  aria-label="Hapus data <?php echo $nama !== "" ? htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') : 'mahasiswa tanpa nama'; ?>"
                                >
                                  <i class="bi bi-trash" aria-hidden="true"> </i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        </tbody>
                        <tbody>
                          <tr id="filter-no-results" hidden>
                            <td colspan="8" class="text-center py-3">
                              Tidak ada data yang cocok dengan filter.
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive -->
                     <?php
                     } else {
                        echo "0 results - Data Not Found!";
                     } 
                     mysqli_free_result($result);
                     mysqli_close($conn);
                     ?>
                  </div>
                  <!--end::Card Body-->
                  <!--begin::Card Footer-->
                  <div class="card-footer d-flex justify-content-end align-items-center gap-3 flex-wrap">
                    <select
                      id="page-size"
                      class="form-select form-select-sm page-size-select"
                      aria-label="Jumlah baris per halaman"
                    >
                      <option value="5">5</option>
                      <option value="10" selected>10</option>
                      <option value="15">15</option>
                    </select>
                    <ul id="pagination-list" class="pagination pagination-sm m-0"></ul>
                  </div>
                  <!--end::Card Footer-->
                </div>
                <!--end::Card-->
              </div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

            <!--begin::Add User Modal-->
            <div
              class="modal fade"
              id="modal-add-user"
              tabindex="-1"
              aria-labelledby="modal-add-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="insertnilai.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-add-user-label">Tambah Data Nilai</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="new-nim" class="form-label"> NIM </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-nim"
                          name="nim"
                          placeholder="e.g. 3202416080"
                          maxlength="10"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="new-namalengkap" class="form-label"> Nama Lengkap </label>
                        <input
                          type="text"
                          class="form-control"
                          id="new-namalengkap"
                          name="nm_lengkap"
                          placeholder="Masukkan Nama Lengkap"
                          maxlength="100"
                          required
                        />
                        <div class="form-text">Masukkan Nama Lengkap Sesuai KTP</div>
                      </div>
                      <div class="mb-3">
                        <label for="new-foto-id" class="form-label">Foto Profil</label>
                        <select class="form-select" id="new-foto-id" name="foto_id">
                          <option value="">Tanpa foto profil</option>
                          <?php foreach ($photos as $photo): ?>
                            <option value="<?php echo (int) $photo["id"]; ?>">
                              <?php echo htmlspecialchars($photo["nama_file"], ENT_QUOTES, "UTF-8"); ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                        <?php if (count($photos) === 0): ?>
                          <div class="form-text">Belum ada foto di tabel photo. Unggah foto terlebih dahulu.</div>
                        <?php endif; ?>
                      </div>
                      <div class="mb-3">
                        <label for="new-nilaiakhir" class="form-label"> Nilai Akhir </label>
                        <input
                          type="number"
                          class="form-control"
                          id="new-nilaiakhir"
                          name="nilai_akhir"
                          placeholder="Masukkan Nilai Akhir"
                          min="0"
                          max="100"
                          step="0.01"
                          required
                        />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                      </button>
                      <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end::Add User Modal-->

            <!--begin::Edit User Modal-->
            <div
              class="modal fade"
              id="modal-edit-user"
              tabindex="-1"
              aria-labelledby="modal-edit-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="editnilai.php" method="post">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-edit-user-label">Edit Data Nilai</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="nim_lama" id="edit-nim-lama" />
                      <div class="mb-3">
                        <label for="edit-nim" class="form-label">NIM</label>
                        <input
                          type="text"
                          class="form-control"
                          id="edit-nim"
                          name="nim"
                          maxlength="10"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama Lengkap</label>
                        <input
                          type="text"
                          class="form-control"
                          id="edit-nama"
                          name="nm_lengkap"
                          maxlength="100"
                          required
                        />
                      </div>
                      <div class="mb-3">
                        <label for="edit-foto-id" class="form-label">Foto Profil</label>
                        <select class="form-select" id="edit-foto-id" name="foto_id">
                          <option value="">Tanpa foto profil</option>
                          <?php foreach ($photos as $photo): ?>
                            <option value="<?php echo (int) $photo["id"]; ?>">
                              <?php echo htmlspecialchars($photo["nama_file"], ENT_QUOTES, "UTF-8"); ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="edit-nilai" class="form-label">Nilai Akhir</label>
                        <input
                          type="number"
                          class="form-control"
                          id="edit-nilai"
                          name="nilai_akhir"
                          min="0"
                          max="100"
                          step="0.01"
                          required
                        />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                      </button>
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end::Edit User Modal-->

            <!--begin::Delete User Modal-->
            <div
              class="modal fade"
              id="modal-delete-user"
              tabindex="-1"
              aria-labelledby="modal-delete-user-label"
              aria-hidden="true"
            >
              <div class="modal-dialog">
                <div class="modal-content">
                  <form action="hapusnilai.php" method="post">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-delete-user-label">Hapus Data Nilai</h5>
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"
                      ></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-0">
                        Yakin ingin menghapus data nilai milik
                        <strong id="delete-user-name"></strong>
                        (NIM: <span id="delete-user-nim"></span>)? Data yang dihapus tidak dapat dikembalikan.
                      </p>
                      <input type="hidden" name="nim" id="delete-user-nim-input" />
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                      </button>
                      <button type="submit" class="btn btn-danger">
                        Hapus Data
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end::Delete User Modal-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Web Programming Semester 5</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2026&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)-->
    <script>
      const userSearch = document.getElementById('user-search');
      const userRoleFilter = document.getElementById('user-role-filter');
      const nilaiSort = document.getElementById('nilai-sort');
      const nilaiSortIndicator = document.getElementById('nilai-sort-indicator');
      const pageSize = document.getElementById('page-size');
      const filterNoResults = document.getElementById('filter-no-results');
      const tableBody = document.getElementById('nilai-table-body');

      if (tableBody) {
        const allRows = Array.from(tableBody.querySelectorAll('tr'));
        const paginationList = document.getElementById('pagination-list');
        let currentPage = 1;
        let sortMode = 'desc';

        function renderPagination(pageCount) {
          paginationList.replaceChildren();

          function addPageButton(label, page, disabled, active, ariaLabel) {
            const item = document.createElement('li');
            item.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'page-link';
            button.textContent = label;
            if (ariaLabel) button.setAttribute('aria-label', ariaLabel);
            button.disabled = disabled;
            if (!disabled && !active) {
              button.addEventListener('click', function () {
                currentPage = page;
                applySortingAndPagination();
              });
            }
            item.appendChild(button);
            paginationList.appendChild(item);
          }

          addPageButton('«', 1, currentPage <= 1, false, 'Halaman pertama');
          addPageButton('‹', currentPage - 1, currentPage <= 1, false, 'Sebelumnya');
          for (let page = 1; page <= pageCount; page += 1) {
            addPageButton(String(page), page, false, page === currentPage);
          }
          addPageButton('›', currentPage + 1, currentPage >= pageCount, false, 'Berikutnya');
          addPageButton('»', pageCount, currentPage >= pageCount, false, 'Halaman terakhir');
        }

        function applySortingAndPagination() {
          const pageLimit = Number(pageSize.value || 10);
          const searchTerm = userSearch.value.trim().toLocaleLowerCase();
          const selectedPredikat = userRoleFilter.value.toLocaleLowerCase();
          const filtered = allRows.filter(function (row) {
            const nama = row.cells[1].textContent.trim().toLocaleLowerCase();
            const predikat = row.cells[4].textContent.trim().toLocaleLowerCase();
            return nama.includes(searchTerm) &&
              (selectedPredikat === 'all' || predikat === selectedPredikat);
          });

          filtered.sort(function (a, b) {
            const difference = Number(a.cells[2].textContent.trim()) - Number(b.cells[2].textContent.trim());
            return (sortMode === 'asc' ? difference : -difference) ||
              a.cells[0].textContent.trim().localeCompare(b.cells[0].textContent.trim());
          });

          const pageCount = Math.ceil(filtered.length / pageLimit);
          currentPage = Math.min(currentPage, Math.max(pageCount, 1));
          const start = (currentPage - 1) * pageLimit;
          const visibleRows = filtered.slice(start, start + pageLimit);

          allRows.forEach(function (row) {
            row.remove();
          });
          visibleRows.forEach(function (row) {
            tableBody.appendChild(row);
          });

          if (filterNoResults) {
            filterNoResults.hidden = filtered.length !== 0;
          }
          renderPagination(pageCount);
        }

        userSearch.addEventListener('input', function () {
          currentPage = 1;
          applySortingAndPagination();
        });
        userRoleFilter.addEventListener('change', function () {
          currentPage = 1;
          applySortingAndPagination();
        });
        nilaiSort.addEventListener('click', function () {
          sortMode = sortMode === 'asc' ? 'desc' : 'asc';
          nilaiSort.setAttribute(
            'aria-label',
            sortMode === 'asc'
              ? 'Urutkan nilai akhir secara menaik'
              : 'Urutkan nilai akhir secara menurun'
          );
          nilaiSort.setAttribute('aria-sort', sortMode === 'asc' ? 'ascending' : 'descending');
          nilaiSortIndicator.textContent = sortMode === 'asc' ? '↑' : '↓';
          currentPage = 1;
          applySortingAndPagination();
        });
        pageSize.addEventListener('change', function () {
          currentPage = 1;
          applySortingAndPagination();
        });
        applySortingAndPagination();
      }

      document.getElementById('modal-edit-user').addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;

        document.getElementById('edit-nim-lama').value = trigger.getAttribute('data-nim');
        document.getElementById('edit-nim').value = trigger.getAttribute('data-nim');
        document.getElementById('edit-nama').value = trigger.getAttribute('data-nama');
        document.getElementById('edit-nilai').value = trigger.getAttribute('data-nilai');
        document.getElementById('edit-foto-id').value = trigger.getAttribute('data-foto-id') || '';
      });

      document.getElementById('modal-delete-user').addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        const nim = trigger.getAttribute('data-nim');
        const nama = trigger.getAttribute('data-nama');

        document.getElementById('delete-user-name').textContent = nama || '(Nama kosong)';
        document.getElementById('delete-user-nim').textContent = nim || '(NIM kosong)';
        document.getElementById('delete-user-nim-input').value = nim;
      });
    </script>
    <!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!--begin::Color Mode Toggle-->
    <!-- The light/dark/auto switcher ships in adminlte.js as the ColorMode
     module (since 4.1) — no page script needed. Only the no-flash snippet
     in <head> stays inline, because it must run before first paint. -->
    <!--end::Color Mode Toggle-->

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>