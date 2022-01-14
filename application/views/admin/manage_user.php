<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary " style="text-align: center;">MANAJEMEN USER</h5>
        </div>
        <div class="card-body">
            <!-- Button trigger modal -->
            <a class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#tambahuser">
                <span class="icon text-white-40">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">User</span>
            </a>
            <?= $this->session->flashdata('message'); ?>
            <br><br>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lembaga</th>
                            <th>Sub-Lembaga</th>
                            <th>Status</th>
                            <th>Terakhir Update</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <?php
                    $no = 1;

                    $userid = $user['id'];
                    $queryuser = "SELECT * from user WHERE aktif=1 ";
                    $user = $this->db->query($queryuser)->result_array();
                    foreach ($user as $usr) :

                        $kode_padukuhan = $usr['kode_padukuhan'];
                        $kode_rt = $usr['kode_rt'];

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
                                    <?= $usr['nama']; ?></a>
                                </td>
                                <td><?= $nama_padukuhan; ?></td>
                                <td><?= $nama_rt; ?></td>
                                <td><?php
                                    $statuser = $usr['aktif'];
                                    if ($statuser == 1) :
                                        $status = "Aktif";
                                    else :
                                        $status = "Tidak Aktif";
                                    endif;
                                    echo $status;
                                    ?>
                                </td>
                                <td><?= $usr['dibuat']; ?></td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#userrinci<?= $usr['id']; ?>"><i class="fas fa-info-circle"></i></button>
                                    <button type="submit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edituser<?= $usr['id']; ?>"><i class=" fas fa-edit"></i></button>
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapususer<?= $usr['id']; ?>"><i class=" fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        </tbody>

                        <!-- Modal Rincian User -->
                        <div class="modal fade" id="userrinci<?= $usr['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $usr['id']; ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><b>Rincian User</b></h5>
                                    </div>
                                    <div class="modal-body">

                                        <?php
                                        echo "UserID     : <b>" . $usr['id'] . "</b><br>";
                                        echo "Username   : <b>" . $usr['username'] . "</b><br>";
                                        echo "Nama       : <b>" . $usr['nama'] . "</b><br>";
                                        $jenis = $usr['jenis'];
                                        $queryjenis = "SELECT jenis from jenis_user WHERE id=$jenis ";
                                        $jns = $this->db->query($queryjenis)->row_array();
                                        echo "Level User : <b>" . $jns['jenis'] . "</b><br>";
                                        echo "Padukuhan/ Lembaga : <b>" . $nama_padukuhan . "</b><br>";
                                        echo "RT/ Sub-Lembaga : <b>" . $nama_rt . "</b><br>";
                                        echo "Status User : <b>" . $status . "</b><br>";
                                        echo "Update : <b>" . $usr['dibuat'] . "</b><br>";
                                        echo "<hr>";
                                        ?>

                                        <img src="<?= base_url('assets/img/') . $usr['foto'] ?>" style="height: 200px;">

                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Edit User -->
                        <div class="modal fade" id="edituser<?= $usr['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $usr['id']; ?>Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <?php echo form_open_multipart('admin/edituser'); ?>
                                    <div class="modal-header">
                                        <h5 class="modal-title"><b>Edit User</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-1">
                                            <input type="hidden" class="form-control" id="iduser" name="iduser" value="<?= $usr['username']; ?>">
                                            <label for="exampleInputMasalah" class="form-label">Username :</label>
                                            <input type="text" class="form-control" id="username" name="username" value="<?= $usr['username']; ?>">
                                        </div>
                                        <div class="mb-1">
                                            <label for="exampleInputMasalah" class="form-label">Password :</label>
                                            <input type="text" class="form-control" id="password1" name="password1" ?>
                                            <input type="text" class="form-control" id="password2" name="password2" ?>
                                        </div>
                                        <div class="mb-1">
                                            <label for="exampleInputMasalah" class="form-label">Nama Lengkap User :</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $usr['nama']; ?>">
                                        </div>
                                        <img src="<?= base_url('assets/img/') . $usr['foto'] ?>" style="height: 200px;">

                                        <div class="mb-1">
                                            <label for="exampleInputProposal" class="form-label">Foto :</label>
                                            <input type="file" class="form-control" id="proposal" name="proposal">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Hapus User -->
                        <div class="modal fade" id="hapususer<?= $usr['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapususulLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapususulLabel"><b>Hapus User</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        echo "<b>Yakin akan Menghapus Data User : </b><br>" . $usr['nama'];
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="<?= base_url('admin/hapususer'); ?>">
                                            <input type="hidden" class="form-control" id="idusulan" name="idusulan" value="<?= $usr['id']; ?>">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Tutup</a>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php $no++;
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="<?= $usr['id']; ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open_multipart('admin/tambahuser'); ?>
            <div class="modal-header">
                <h5 class="modal-title"><b>Tambah User</b></h5>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Username :</label>
                    <input type="hidden" class="form-control" id="userid" name="userid">
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Password :</label>
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Ketik Password ...">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Ketik Password ...">
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Nama Lengkap User :</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Level User :</label>
                    <select class="form-control" id="level" name="level">
                        <option value="1">Admin Kalurahan</option>
                        <option value="2">Admin RT</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Lembaga/ Padukuhan :</label>
                    <select class="form-control" id="lembaga" name="lembaga">
                        <option value="1">Madusari</option>
                        <option value="2">Ringinsari</option>
                        <option value="3">Purbosari</option>
                        <option value="4">Gadungsari</option>
                        <option value="5">Pandansari</option>
                        <option value="6">Tawarsari</option>
                        <option value="7">Jeruksari</option>
                        <option value="8">Kalurahan</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Sub-Lembaga/ RT :</label>
                    <select class="form-control" id="sublembaga" name="sublembaga">
                        <option value="1">001</option>
                        <option value="2">002</option>
                        <option value="3">003</option>
                        <option value="4">004</option>
                        <option value="5">005</option>
                        <option value="6">006</option>
                        <option value="7">007</option>
                        <option value="8">008</option>
                        <option value="9">009</option>
                        <option value="10">010</option>
                        <option value="11">011</option>
                        <option value="12">012</option>
                        <option value="13">013</option>
                        <option value="14">014</option>
                        <option value="15">015</option>
                        <option value="16">Kalurahan </option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="exampleInputProposal" class="form-label">Foto :</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>