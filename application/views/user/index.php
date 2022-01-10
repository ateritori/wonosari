<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary " style="text-align: center;">DATA USULAN PROGRAM/ PEMBANGUNAN</h5>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <a class="btn btn-primary sm" href="#" data-toggle="modal" data-target="#usulanModal">
                <i class="fas fa-plus"> Tambah Usulan</i>
            </a>
            <div class="table-responsive">
                <?= form_error('uraian', '<div class="alert alert-danger" role="danger">', '</div>'); ?>
                <table class="table table-hover" id="usulanTable" width="100%" cellspacing="0">
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Usulan/ Program</th>
                        <th>Jumlah</th>
                        <th>Dimensi/ Volume (m)</th>
                        <th>Biaya (Rp.) </th>
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $no = 1;

                    $userid = $user['id'];
                    $queryUsulan = "SELECT * from usulan WHERE user=$userid";
                    $usulan = $this->db->query($queryUsulan)->result_array();

                    $kode_padukuhan = $user['kode_padukuhan'];
                    $queryPadukuhan = "SELECT padukuhan from padukuhan WHERE id=$kode_padukuhan";
                    $padukuhan = $this->db->query($queryPadukuhan)->row_array();
                    $nama_padukuhan = $padukuhan['padukuhan'];

                    $kode_rt = $user['kode_rt'];
                    $queryrt = "SELECT rt from rt WHERE id=$kode_rt";
                    $rt = $this->db->query($queryrt)->row_array();
                    $nama_rt = $rt['rt'];


                    foreach ($usulan as $usul) :
                        //kurang iki
                        $masalah = $usul['masalah'];
                        $potensi = $usul['potensi'];
                        $usulanid = $usul['id'];

                        $querystat = "SELECT olah_usulan.status from olah_usulan JOIN usulan
                        ON olah_usulan.kode_usulan = $usulanid";
                        $stat = $this->db->query($querystat)->row_array();
                        $status = $stat['status'];

                        $queryket = "SELECT olah_usulan.ket from olah_usulan JOIN usulan
                        ON olah_usulan.kode_usulan = $usulanid";
                        $sket = $this->db->query($queryket)->row_array();
                        $jelas = $sket['ket'];


                        if ($status == 1) :
                            $keterangan = "VERIFIKASI";
                            $gaya = "btn btn-info btn-sm";
                            $dis = "";
                        elseif ($status == 2) :
                            $keterangan = "DITERIMA";
                            $gaya = "btn btn-success btn-sm";
                            $dis = "disabled";
                        elseif ($status == 3) :
                            $keterangan = "DIKEMBALIKAN";
                            $gaya = "btn btn-secondary btn-sm";
                            $dis = "";
                        else :
                            $keterangan = "DITOLAK";
                            $gaya = "btn btn-danger btn-sm";
                            $dis = "";
                        endif;

                    ?>
                        <tr style="text-align: center;">
                            <td><?= $no ?></td>
                            <td style="text-align: justify;">
                                <a href="#" data-toggle="modal" data-target="#maspo"><?= $usul['usulan']; ?></a>
                            </td>
                            <td><?= $usul['jumlah']; ?> Paket</td>
                            <td>P : <?= $usul['panjang']; ?>| L : <?= $usul['lebar']; ?>
                                | P : <?= $usul['tinggi']; ?> m</td>
                            <td><?= number_format($usul['biaya']); ?></td>
                            <td>
                                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#statket" class="<?= $gaya; ?>" <?= $dis; ?>><?= $keterangan; ?></a>
                            </td>
                        </tr>
                        <?php $no = $no + 1; ?>

                        <!-- Modal Masalah-Potensi -->
                        <div class="modal fade" id="maspo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="maspoLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="maspoLabel"><b><?= $usul['usulan']; ?></b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo "<b>Lokasi :</b><br>";
                                        echo "Padukuhan : " . $nama_padukuhan . ", RT : " . $nama_rt . "<br>";
                                        echo "<hr>";
                                        echo "<b>Permasalahan :</b><br>";
                                        echo $masalah . "<br>";
                                        echo "<hr>";
                                        echo "<b>Potensi yang dimiliki :</b><br>";
                                        echo $potensi;
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Tutup</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Status -->
                        <div class="modal fade" id="statket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statketLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statketLabel"><b><?= $keterangan; ?></b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo "<b>Keterangan :</b><br>";
                                        echo $jelas;
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Tutup</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php endforeach; ?>
                    <div class="float-right">
                        <h5>Padukuhan : <?= $nama_padukuhan; ?> | RT : <?= $nama_rt; ?> </h5>
                    </div>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- tambah Modal -->
<div class="modal fade" id="usulanModal" tabindex="-1" aria-labelledby="usulanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?= base_url('user/tambah'); ?>" method="POST">
            <?php
            $_SESSION['user'] = $userid;
            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="usulanModalLabel">Tambah Usulan</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="exampleInputMasalah" class="form-label">Permasalahan yang dihadapi :</label>
                        <input type="text" class="form-control" id="masalah" name="masalah">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPotensi" class="form-label">Potensi yang dimiliki :</label>
                        <input type="text" class="form-control" id="potensi" name="potensi">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputUsulan" class="form-label">Usulan/ Program :</label>
                        <input type="text" class="form-control" id="uraian" name="uraian">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputJumlah" class="form-label">Jumlah Paket Program :</label>
                        <input type="text" class="form-control" id="jumlah" name="jumlah">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputDimensi" class="form-label">Dimensi/ Volume (m) :</label>
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Panjang ... ">
                        <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Lebar ... ">
                        <input type="text" class="form-control" id="tinggi" name="tinggi" placeholder="Tinggi ... ">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputBiaya" class="form-label">Biaya (Rp.) :</label>
                        <input type="text" class="form-control" id="biaya" name="biaya">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputProposal" class="form-label">Unggah Proposal/ Dokumen Pendukung :</label>
                        <input type="file" class="form-control" id="proposal" name="proposal">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>