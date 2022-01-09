        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Data Usulan Program/ Pembangunan</h4>
                    <a class="btn btn-primary float-right" href="#" data-toggle="modal" data-target="#modal_usulan">
                        Tambah Usulan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="usulan" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Usulan/ Program</th>
                                    <th>Jumlah</th>
                                    <th>Dimensi (m)</th>
                                    <th>Biaya (Rp.)</th>
                                    <th>Padukuhan</th>
                                    <th>RT</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            <tbody>
                                <?php
                                $userid = $user['id'];

                                $queryUsulan = "SELECT * FROM usulan JOIN user ON usulan.user = user.id WHERE usulan.user = $userid ORDER BY usulan.id";
                                $usulan = $this->db->query($queryUsulan)->result_array();

                                $no = 1;
                                foreach ($usulan as $usul) :
                                    $kodePadukuhan = $usul['kode_padukuhan'];
                                    $queryDukuh = "SELECT padukuhan FROM padukuhan WHERE id = $kodePadukuhan";
                                    $padukuhan = $this->db->query($queryDukuh)->result_array();
                                    foreach ($padukuhan as $dukuh) :
                                        $namaPadukuhan = $dukuh['padukuhan'];
                                    endforeach;

                                    $kodeRt = $usul['kode_rt'];
                                    $queryRt = "SELECT rt FROM rt WHERE id = $kodeRt";
                                    $rt = $this->db->query($queryRt)->result_array();
                                    foreach ($rt as $nama_rt) :
                                        $tampilRt = $nama_rt['rt'];
                                    endforeach;

                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $usul['uraian']; ?></td>
                                        <td><?= $usul['jumlah']; ?> titik/keg</td>
                                        <td>P = <?= $usul['panjang']; ?>, L = <?= $usul['lebar']; ?>, T = <?= $usul['tinggi']; ?></td>
                                        <td><?= number_format($usul['biaya']); ?></td>
                                        <td><?= $namaPadukuhan; ?></td>
                                        <td><?= $tampilRt; ?></td>
                                        <td><?php $status = $usul['status'];
                                            if ($status == 1) {
                                                $ket = "PROSES VERIFIKASI";
                                                $warna = "badge badge-primary";
                                            } else {
                                                if ($status == 2) {
                                                    $ket = "DITERIMA";
                                                    $warna = "badge badge-success";
                                                } else {
                                                    if ($status == 3) {
                                                        $ket = "DIKEMBALIKAN";
                                                        $warna = "badge badge-dark";
                                                    } else {
                                                        $ket = "DITOLAK";
                                                        $warna = "badge badge-danger";
                                                    }
                                                }
                                            }
                                            $no == $no++;
                                            ?>
                                            <a href="#" class="<?= $warna ?>"><?= $ket ?></a>
                                        </td>
                                        </td>
                                        <td><a href="#" class="badge badge-warning">UBAH </a> | <a href="#" class="badge badge-danger">HAPUS</a></td>

                                    <?php endforeach; ?>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Add Usulan Modal-->
        <div class="modal fade" id="modal_usulan" tabindex="-1" role="dialog" aria-labelledby="modal_usulan" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="form-horizontal" method="POST" action="<?= base_url('user/tambah_usulan'); ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="m-0 font-weight-bold text-primary">Tambah Usulan</h5>
                        </div>
                        <div class="modal-body">
                            <label for="usulan" class="form-label">Uraian Usulan :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="usulan" aria-describedby="basic-addon3" placeholder="Isikan uraian kegiatan lengkap ..">
                            </div>
                            <label for="jumlah" class="form-label">Jumlah Titik/ Kegiatan :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="jumlah" aria-describedby="basic-addon3" placeholder="Jumlah titik / kegiatan ... ">
                            </div>
                            <label for="dimensi" class="form-label">Dimensi :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="panjang" aria-describedby="basic-addon3" placeholder="Panjang ...(m) :">
                                <input type="text" class="form-control" id="lebar" aria-describedby="basic-addon3" placeholder="Lebar ... (m) :">
                                <input type="text" class="form-control" id="tinggi" aria-describedby="basic-addon3" placeholder="Tinggi ... (m) :">
                            </div>
                            <label for="biaya" class="form-label">Perkiraan Biaya :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="biaya" aria-describedby="basic-addon3" placeholder="Perkiraan Biaya  Rp. ... ">
                            </div>
                            <label for="proposal" class="form-label">Upload Proposal/ Dokumen Pendukung:</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="jumlah" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('user/crud'); ?>">Simpan</a>
                        </div>
                </form>
            </div>
        </div>
        </div>