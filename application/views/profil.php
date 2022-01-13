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
                <span class="text">Edit Profil</span>
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
                        <td style="width: 150pt;">Nama User</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $user['nama']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Jenis User</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_jenis; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Padukuhan/ Kalurahan</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_padukuhan; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">RT</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;"><?= $nama_rt; ?> </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;">Foto</td>
                        <td> : </td>
                        <td style="padding-left: 10pt;">
                            <img class="img-thumbnail" src="<?= base_url('assets/img/') . $user['foto']; ?>" style="width: 100px">
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150pt;"></td>
                        <td></td>
                        <td style="padding-left: 10pt;">

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal Edit Profil-->
<div class="modal fade" id="editProfil<?= $user['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editProfilLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php
        echo form_open_multipart('profil/edit');
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profilanModalLabel">Edit Profil</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="idUser" name="idUser" value="<?= $user['id']; ?>">
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Nama User:</label>
                    <input type="text" class="form-control" id="masalah" name="masalah" value="<?= $user['nama']; ?>">
                </div>
                <div class="mb-1">
                    <label for="exampleInputMasalah" class="form-label">Foto User:</label>
                    <input type="file" class="form-control" id="foto" name="foto" value="<?= $user['foto']; ?>">
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