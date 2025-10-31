<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Buat Laporan
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('guru/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Lapor</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush py-4">
                    <div class="card-body pt-5">
                        <?= form_open('guru/pengaduan/store'); ?>

                        <div class="mb-10 fv-row">
                            <div class="col-12">
                                <label class="required form-label">Judul</label>
                                <input type="text" class="form-control mb-2" name="judul" required>
                            </div>
                        </div>

                        <div class="row mb-5 fv-row">
                            <div class="col-md-6">
                                <label class="form-label">Tempat</label>
                                <input type="text" class="form-control mb-2" name="tempat">
                            </div>
                            <div class="col-md-6">
                                <label class="required form-label">Kategori</label>
                                <select name="id_kategori" class="form-select mb-2" data-control="select2"
                                    data-placeholder="Pilih Kategori" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <?php foreach ($kategori as $k): ?>
                                        <option value="<?= $k->id_kategori; ?>"><?= $k->nama_kategori; ?> -
                                            <?= $k->petugas; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-column mb-8">
                            <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control mb-2" rows="5" placeholder="Masukkan laporan anda"></textarea>
                        </div>

                        <div class="alert alert-warning d-flex align-items-center p-3 mb-8 rounded">
                            <i class="ki-outline ki-information-3 fs-4 me-3 text-warning"></i>
                            <div class="fw-semibold text-dark">
                                <span>
                                    Kolom yang ditandai dengan tanda bintang (<span class="text-danger">*</span>)
                                    wajib diisi.
                                </span>
                                Pastikan semua informasi yang diperlukan telah diisi sebelum mengirim
                                laporan.
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-primary fs-bold px-6" data-kt-inbox-form="send">
                                    <span class="indicator-label">Kirim Laporan</span>
                                </button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>