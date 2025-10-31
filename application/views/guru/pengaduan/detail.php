<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Detail Laporan
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('guru/dashboard'); ?>"
                                class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="<?= site_url('guru/pengaduan'); ?>" class="text-muted text-hover-primary">Data
                                Laporan</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Detail Laporan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-15">
                        <div class="d-flex flex-column flex-xl-row">
                            <div class="flex-lg-row-fluid">
                                <div class="mb-17">
                                    <div class="mb-8">
                                        <div class="d-flex flex-wrap mb-6">
                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-calendar-8 text-primary fs-2 me-2"></i>
                                                <span class="fw-bold text-gray-500">
                                                    <?= date('d F Y', strtotime($pengaduan->date)); ?>
                                                </span>
                                            </div>

                                            <div class="me-9 my-1 d-flex align-items-center">
                                                <i class="ki-outline ki-briefcase text-primary fs-2 me-2"></i>
                                                <span
                                                    class="fw-bold text-gray-500"><?= htmlspecialchars($pengaduan->id_kategori); ?></span>
                                            </div>

                                            <?php if (!empty($pengaduan->tempat)): ?>
                                                <div class="me-9 my-1 d-flex align-items-center">
                                                    <i class="ki-outline ki-geolocation text-primary fs-2 me-2"></i>
                                                    <span
                                                        class="fw-bold text-gray-500"><?= htmlspecialchars($pengaduan->tempat); ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <div class="my-1 d-flex align-items-center ms-auto">
                                                <?php if ($pengaduan->jumlah_balasan > 0): ?>
                                                    <span class="badge badge-light-success py-3 px-4 fs-7">Sudah
                                                        Ditanggapi</span>
                                                <?php else: ?>
                                                    <span class="badge badge-light-danger py-3 px-4 fs-7">Menunggu
                                                        Tanggapan</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <h2 class="text-gray-900 fs-2 fw-bold">
                                            <?= htmlspecialchars($pengaduan->judul); ?>
                                        </h2>
                                    </div>
                                    <div class="fs-5 fw-semibold text-gray-600">
                                        <p class="mb-8">
                                            <?= nl2br(htmlspecialchars($pengaduan->deskripsi)); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="mb-17">
                                    <h3 class="text-gray-900 mb-5">Tanggapan dari Manajemen</h3>
                                    <div class="separator separator-dashed mb-9"></div>

                                    <?php if (empty($pengaduan->balasan)): ?>
                                        <p class="text-center text-gray-500 fs-6">Belum ada tanggapan untuk pengaduan ini.
                                        </p>
                                    <?php else: ?>
                                        <?php foreach ($pengaduan->balasan as $balas): ?>
                                            <div class="mb-10">
                                                <div class="d-flex align-items-center mb-4">
                                                    <span
                                                        class="badge badge-light-<?= $balas->status == 'Selesai' ? 'success' : 'primary'; ?> me-4 py-3 px-4 fs-7">
                                                        <?= htmlspecialchars($balas->status); ?>
                                                    </span>
                                                    <span class="fs-7 text-muted">
                                                        Dibalas pada:
                                                        <?= date('d F Y', strtotime($balas->created_at ?? time())); ?>
                                                    </span>
                                                </div>

                                                <div class="fs-5 fw-semibold text-gray-600 mb-7">
                                                    <p><?= nl2br(htmlspecialchars($balas->isi_balasan)); ?></p>
                                                </div>

                                                <div class="border-1 border-dashed card-rounded p-5 p-lg-10 mb-14">
                                                    <div class="fs-6 w-100">
                                                        <?php if (isset($balas->kepuasan) && $balas->kepuasan): ?>
                                                            <h5 class="text-success fw-bold mb-4">Anda sudah memberi feedback:</h5>
                                                            <div class="rating">
                                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                                    <div
                                                                        class="rating-label me-2 <?= ($i < $balas->kepuasan->rating) ? 'checked' : ''; ?>">
                                                                        <i class="ki-outline ki-star fs-2"></i>
                                                                    </div>
                                                                <?php endfor; ?>
                                                                <span
                                                                    class="fw-bold fs-6 ms-2">(<?= $balas->kepuasan->rating; ?>/5)</span>
                                                            </div>
                                                            <p class="mt-4 fs-6 text-gray-700">
                                                                <strong>Komentar: </strong>
                                                                <?= htmlspecialchars($balas->kepuasan->komentar); ?>
                                                            </p>
                                                        <?php else: ?>
                                                            <h5 class="text-primary mb-5">Beri Feedback untuk Tanggapan Ini:</h5>
                                                            <?= form_open('guru/pengaduan/beri_kepuasan/' . $balas->id_balasan, ['class' => 'w-100']); ?>
                                                            <input type="hidden" name="id_pengaduan"
                                                                value="<?= $pengaduan->id_pengaduan; ?>">
                                                            <input type="hidden" name="id_kategori"
                                                                value="<?= $balas->id_kategori; ?>">

                                                            <div class="mb-5">
                                                                <label class="form-label fw-semibold">Rating Kepuasan</label>
                                                                <select name="rating" class="form-select form-select-solid w-100"
                                                                    data-control="select2" data-hide-search="true"
                                                                    data-placeholder="-- Pilih Rating --" required>
                                                                    <option></option>
                                                                    <option value="5">⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                                                    <option value="4">⭐⭐⭐⭐ (Puas)</option>
                                                                    <option value="3">⭐⭐⭐ (Cukup)</option>
                                                                    <option value="2">⭐⭐ (Kurang Puas)</option>
                                                                    <option value="1">⭐ (Tidak Puas)</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-5">
                                                                <label class="form-label fw-semibold">Komentar Anda</label>
                                                                <textarea name="komentar"
                                                                    class="form-control form-control-solid w-100" rows="3"
                                                                    placeholder="Tulis komentar Anda..." required></textarea>
                                                            </div>

                                                            <button type="submit" class="btn btn-success">Kirim Feedback</button>
                                                            <?= form_close(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-start">
                                    <a href="<?= site_url('guru/pengaduan'); ?>" class="btn btn-light me-3">
                                        <i class="ki-outline ki-arrow-left"></i>
                                        Kembali ke Histori Laporan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>