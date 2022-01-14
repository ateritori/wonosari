<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary " style="text-align: center;">HALAMAN PROFIL</h5>
        </div>
        <div class="card-body">
            <a class="btn btn-primary btn-icon-split" href="#" data-toggle="modal" data-target="#editProfil<?= $user['id']; ?>">
                <span class="icon text-white-40">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Ubah Profil</span>
            </a>
            <a class="btn btn-info btn-icon-split" href="#" data-toggle="modal" data-target="#editpassword<?= $user['id']; ?>">
                <span class="icon text-white-40">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Ubah Password</span>
            </a>
            <?= $this->session->flashdata('message'); ?>
            <br><br>
            <?php
            $jenis = $user['jenis'];
            $queryjenis = "SELECT jenis from jenis_user WHERE id=$jenis";
            $jenis = $this->db->query($queryjenis)->row_array();
            $nama_jenis = $jenis['jenis'];

            $kode_padukuhan = $user['kode_padukuhan'];
            $queryPadukuhan = "SELECT padukuhan from padukuhan WHERE id=$kode_padukuhan";
            $padukuhan = $this->db->query($queryPadukuhan)->row_array();
            $nama_padukuhan = $padukuhan['padukuhan'];

            $kode_rt = $user['kode_rt'];
            $queryrt = "SELECT rt from rt WHERE id=$kode_rt";
            $rt = $this->db->query($queryrt)->row_array();
            $nama_rt = $rt['rt'];

            ?>
            <div class="table-responsive">
                <table class="no-border">
                    <tr>
                        <td style="width: 150pt;">Id User</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $user['id']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Username</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $user['username']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Nama User</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $user['nama']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Level User</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_jenis; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Lembaga / Padukuhan</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_padukuhan; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Sub-lembaga /     RT</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_rt; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Diperbaharui</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $user['dibuat']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Foto</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;">
                            <img src="<?= base_url('assets/img/') . $user['foto']; ?>" style="width: 150px">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil-->
<div class="modal fade" id="editProfil<?= $user['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilanModalLabel">Ubah Profil</h5>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('user/editprofil');?>
                <input type="hidden" class="form-control" id="iduser" name="iduser" value="<?= $user['id']; ?>">
                <div class="mb-1">
                    <label for="exampleInputNamauser" class="form-label">Nama User:</label>
                    <input type="text" class="form-control" id="namauser" name="namauser" value="<?= $user['nama']; ?>">
                </div>
                <div class="mb-1">
                    <label for="exampleInputNamauser" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                </div>
                <div class="mb-1">
                    <label for="foto" class="form-label">Foto :</label>
                    <input type="file" class="form-control" id="foto" name="foto">
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

<!-- Modal Edit Password-->
<div class="modal fade" id="editpassword<?= $user['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilanModalLabel">Ubah Password</h5>
            </div>
            <form method="POST" action="<?= base_url('user/ubahpassword'); ?>">
            <div class="modal-body">            
                <input type="hidden" class="form-control" id="iduser" name="iduser" value="<?= $user['id']; ?>">
                <div class="mb-1">
                    <label for="exampleInputNamauser" class="form-label">Password Lama:</label>
                    <input type="password" class="form-control" id="passwordlama" name="passwordlama">
                </div>
                <div class="mb-1">
                    <label for="exampleInputNamauser" class="form-label">Password Baru:</label>
                    <input type="password" class="form-control" id="passwordbaru1" name="passwordbaru1" placeholder="Isi Password Baru ...">                
                    <input type="password" class="form-control" id="passwordbaru2" name="passwordbaru2" placeholder="Ulangi Isi Password Baru ...">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary" data-dismiss="modal" aria-label="close">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>