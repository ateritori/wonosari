<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary float-md-none">Data Usulan Program/ Pembangunan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="usulanTable" width="100%" cellspacing="0">
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th style="width: 30%;">Usulan/ Program</th>
                        <th style="width: 9%;">Jumlah</th>
                        <th style="width: 20%;">Volume (m)</th>
                        <th>Biaya (Rp.) </th>
                        <th style="width: 14%;">Aksi</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $no = 1;
                    $userid = $user['id'];
                    $queryUsulan = "SELECT * from usulan WHERE user=$userid";
                    $usulan = $this->db->query($queryUsulan)->result_array();
                    foreach ($usulan as $usul) :
                        $kode_padukuhan = $usul['kode_padukuhan'];
                        $queryPadukuhan = "SELECT * from padukuhan where id=$kode_padukuhan";
                        $padukuhan = $this->db->query($queryPadukuhan)->row_array();
                        $namaPadukuhan = $padukuhan['padukuhan'];

                        $kode_rt = $usul['kode_rt'];
                        $queryrt = "SELECT * from rt where id=$kode_rt";
                        $rt = $this->db->query($queryrt)->row_array();
                        $namart = $rt['rt'];

                        $status = $usul['status'];
                        if ($status == 1) :
                            $ket = "VERIFIKASI";
                            $gaya = "btn btn-info btn-sm";
                            $dis = " ";
                        elseif ($status == 2) :
                            $ket = "DIKEMBALIKAN";
                            $gaya = "btn btn-secondary btn-sm";
                            $dis = " ";
                        elseif ($status == 3) :
                            $ket = "DITERIMA";
                            $gaya = "btn btn-success btn-sm";
                            $dis = "disabled";
                        else :
                            $ket = "DITOLAK";
                            $gaya = "btn btn-danger btn-sm";
                            $dis = " ";
                        endif

                    ?>
                        <tr style="text-align: center;">
                            <td><?= $no ?></td>
                            <td style="text-align: justify;"><?= $usul['uraian']; ?></td>
                            <td><?= $usul['jumlah']; ?> Paket</td>
                            <td>P : <?= $usul['panjang']; ?>| L : <?= $usul['lebar']; ?>
                                | P : <?= $usul['tinggi']; ?> m</td>
                            <td><?= number_format($usul['biaya']); ?></td>
                            <td>
                                <button type="submit" class="btn btn-warning btn-sm" <?= $dis; ?>>Ubah</button>
                                <button type="submit" class="btn btn-danger btn-sm" <?= $dis; ?>>Hapus</button>
                            </td>
                            <td>
                                <button type="button" class="<?= $gaya; ?>"><?= $ket; ?></button>
                            </td>
                        </tr>
                    <?php $no = $no + 1;
                    endforeach; ?>
                    <div class="float-right"><b>Padukuhan : <?= $namaPadukuhan; ?> | RT : <?= $namart; ?></b></div>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->