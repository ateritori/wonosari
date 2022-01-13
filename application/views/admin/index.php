<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary " style="text-align: center;">PROSES USULAN PROGRAM/ PEMBANGUNAN</h5>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <a class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#usulanModal">
                <span class="icon text-white-40">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Usulan</span>
            </a>
            <?= $this->session->flashdata('message'); ?>
            <br><br>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th style="width: 30%;">Usulan/ Program</th>
                            <th>Jumlah</th>
                            <th>Dimensi/ Volume (m)</th>
                            <th>Biaya (Rp.) </th>
                            <th>Ubah Usulan</th>
                            <th>Proses</th>
                        </tr>
                    </thead>

                    <?php
                    $no = 1;

                    $queryUsulan = "SELECT * from usulan JOIN olah_usulan 
                                    ON usulan.id = olah_usulan.kode_usulan WHERE aktif=1 AND status_verifikasi=1";

                    $usulan = $this->db->query($queryUsulan)->result_array();

                    foreach ($usulan as $usul) :

                        $userinput = $usul['user'];
                        $queryuserinput = "SELECT nama, kode_padukuhan, kode_rt from user WHERE id=$userinput";
                        $padurt = $this->db->query($queryuserinput)->result_array();
                        foreach ($padurt as $pr) :
                            $namainput = $pr['nama'];
                            $kode_padukuhan = $pr['kode_padukuhan'];
                            $kode_rt = $pr['kode_rt'];
                        endforeach;

                        $queryPadukuhan = "SELECT padukuhan from padukuhan WHERE id=$kode_padukuhan";
                        $padukuhan = $this->db->query($queryPadukuhan)->row_array();
                        $nama_padukuhan = $padukuhan['padukuhan'];

                        $queryrt = "SELECT rt from rt WHERE id=$kode_rt";
                        $rt = $this->db->query($queryrt)->row_array();
                        $nama_rt = $rt['rt'];

                    ?>

                        <tbody>
                            <tr style="text-align: center;">
                                <td><?= $no ?></td>
                                <td style="text-align: justify;">
                                    <?= $usul['usulan']; ?></a>
                                </td>
                                <td><?= $usul['jumlah']; ?> Paket</td>
                                <td>P : <?= $usul['panjang']; ?>| L : <?= $usul['lebar']; ?>
                                    | P : <?= $usul['tinggi']; ?> m</td>
                                <td><?= number_format($usul['biaya']); ?></td>
                                <td>
                                    <a type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editusul<?= $usul['id']; ?>"><i class=" fas fa-edit"></i></a>
                                    <a type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapususul<?= $usul['id']; ?>"><i class=" fas fa-trash-alt"></i></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-info btn-icon-split" data-toggle="modal" data-target="#maspo<?= $usul['id']; ?>">
                                        <span class=" icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Proses</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>

                        <?php $no++; ?>

                        <!-- Modal Masalah-Potensi -->
                        <div class=" modal fade" id="maspo<?= $usul['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $usul['id']; ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><b>Proses Usulan</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="<?= base_url('admin/simpan'); ?>">
                                            <?php
                                            echo form_open_multipart('user/edit');
                                            echo "<b>Usulan/ Program :</b><br>";
                                            echo $usul['usulan'] . "<br>";
                                            echo "<hr>";
                                            echo "<b>Penginput & Lokasi :</b><br>";
                                            echo $namainput . " | Padukuhan " . $nama_padukuhan . " | RT " . $nama_rt;
                                            echo "<hr>";
                                            echo "<b>Permasalahan :</b><br>";
                                            echo $usul['masalah'] . "<br>";
                                            echo "<hr>";
                                            echo "<b>Potensi yang dimiliki :</b><br>";
                                            echo $usul['potensi'];
                                            echo "<hr>";
                                            echo "<b>File Proposal :</b><br>";
                                            echo $usul['file'];
                                            echo "<hr>";
                                            echo "<b>Proses Usulan :</b><br>";
                                            ?>
                                            <input type="hidden" class="form-control" id="idusulan" name="idusulan" value="<?= $usul['id']; ?>">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="proses" id="proses" value="1"> Proses Verifikasi Usulan <br>
                                                <input class="form-check-input" type="radio" name="proses" id="proses" value="3"> Kembalikan Usulan<br>
                                                <input class="form-check-input" type="radio" name="proses" id="proses" value="4"> Tolak Usulan <br>
                                                <input class="form-check-input" type="radio" name="proses" id="proses" value="2"> Terima Usulan
                                            </div>
                                            <label for="ketusul">Keterangan Usulan :</label>
                                            <textarea class="form-control" id="ketusul" name="ketusul"></textarea>

                                            <div class="modal-footer">
                                                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal Status -->
                            <div class="modal fade" id="statket<?= $usul['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statketLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statketLabel"><b><?= $usul['usulan']; ?></b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo "<b>Keterangan :</b><br>";
                                            echo $usul['ket'];
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Tutup</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editusul<?= $usul['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editusulLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <?php
                                    echo form_open_multipart('user/edit');
                                    ?>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="usulanModalLabel">Edit Usulan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" class="form-control" id="idusulan" name="idusulan" value="<?= $usul['id']; ?>">
                                            <div class="mb-1">
                                                <label for="exampleInputMasalah" class="form-label">Permasalahan yang dihadapi :</label>
                                                <input type="text" class="form-control" id="masalah" name="masalah" value="<?= $usul['masalah']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputPotensi" class="form-label">Potensi yang dimiliki :</label>
                                                <input type="text" class="form-control" id="potensi" name="potensi" value="<?= $usul['potensi']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputUsulan" class="form-label">Usulan/ Program :</label>
                                                <input type="text" class="form-control" id="uraian" name="uraian" value="<?= $usul['usulan']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputJumlah" class="form-label">Jumlah Paket/ Titik Usulan/ Program :</label>
                                                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $usul['jumlah']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputDimensi" class="form-label">Dimensi/ Volume (m) :</label>
                                                <input type="number" class="form-control" id="panjang" name="panjang" placeholder="Panjang ... " value="<?= $usul['panjang']; ?>">
                                                <input type="number" class="form-control" id="lebar" name="lebar" placeholder="Lebar ... " value="<?= $usul['lebar']; ?>">
                                                <input type="number" class="form-control" id="tinggi" name="tinggi" placeholder="Tinggi ... " value="<?= $usul['tinggi']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputBiaya" class="form-label">Biaya (Rp.) :</label>
                                                <input type="number" class="form-control" id="biaya" name="biaya" value="<?= $usul['biaya']; ?>">
                                            </div>
                                            <div class="mb-1">
                                                <label for="exampleInputProposal" class="form-label">Unggah Proposal/ Dokumen Pendukung :</label>
                                                <input type="file" class="form-control" id="proposal" name="proposal">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>

                            <!-- Modal Hapus Usulan -->
                            <div class="modal fade" id="hapususul<?= $usul['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapususulLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapususulLabel"><b>HAPUS USULAN </b></h5>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            echo "<b>Yakin akan Menghapus Data Usulan : </b><br>" . $usul['usulan'];
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="<?= base_url('user/hapus'); ?>">
                                                <input type="hidden" class="form-control" id="idusulan" name="idusulan" value="<?= $usul['id']; ?>">
                                                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Tutup</a>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
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
        <?php
        $userid = $usul['user'];
        echo form_open_multipart('user/tambah')

        ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usulanModalLabel">Tambah Usulan</h5>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Permasalahan yang dihadapi :</label>
                    <textarea class="form-control" id="masalah" name="masalah"> </textarea>
                </div>
                <div class="mb-1">
                    <label for="exampleInputPotensi" class="form-label">Potensi yang dimiliki :</label>
                    <textarea type="text" class="form-control" id="potensi" name="potensi"></textarea>
                </div>
                <div class="mb-1">
                    <label for="exampleInputUsulan" class="form-label">Usulan/ Gagasan/ Program :</label>
                    <textarea class="form-control" id="uraian" name="uraian"></textarea>
                </div>
                <div class="mb-1">
                    <label for="exampleInputJumlah" class="form-label">Jumlah Paket / Titik Usulan :</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" maxlength="11">
                </div>
                <div class="mb-1">
                    <label for="exampleInputDimensi" class="form-label">Dimensi/ Volume : </label>
                    <input type="number" class="form-control" id="panjang" name="panjang" maxlength="11" placeholder="Panjang (cm)/ Jumlah Peserta (orang) ... ">
                    <input type="number" class="form-control" id="lebar" name="lebar" maxlength="11" placeholder="Lebar (cm) ... ">
                    <input type="number" class="form-control" id="tinggi" name="tinggi" maxlength="11" placeholder="Tinggi (cm) ... ">
                </div>
                <div class="mb-1">
                    <label for="exampleInputBiaya" class="form-label">Biaya (Rp.) :</label>
                    <input type="number" class="form-control" id="biaya" name="biaya" maxlength="11">
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
        <?= form_close(); ?>
    </div>
</div>