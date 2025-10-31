<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Ubah Tanggapan
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('manajemen/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('manajemen/pengaduan'); ?>" class="text-muted text-hover-primary">Data
                                Laporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Ubah Tanggapan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush py-4">
                    <div class="card-body pt-5">
                        <?= form_open('manajemen/pengaduan/update_tanggapan/' . $tanggapan->id_balasan); ?>

                        <div class="mb-10 fv-row">
                            <div class="col-12">
                                <label class="required form-label">Status Tanggapan</label>
                                <select name="id_status" class="form-select form-select w-100" data-control="select2"
                                    data-hide-search="true" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <?php foreach ($status_list as $status): ?>
                                        <option value="<?= $status->id_status; ?>"
                                            <?= ($status->id_status == $tanggapan->id_status) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($status->status); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Isi Tanggapan</label>
                            <textarea name="isi_balasan" id="isi_balasan" class="form-control mb-2" rows="6"
                                required><?= htmlspecialchars($tanggapan->isi_balasan); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <a href="<?= site_url('manajemen/pengaduan/detail/' . $tanggapan->id_pengaduan); ?>"
                                class="btn btn-light me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan Perubahan</span>
                            </button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>