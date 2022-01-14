    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/'); ?>img/gadungmlati.png" alt="" width=" 72" height="57">
                                        <h1 class=" h4 text-gray-900 mb-4">Login<br>Sistem Perencanaan Kalurahan<br>Kalurahan Wonosari </h1>
                                    </div>
                                    <form class="user" method="POST" action="<?= base_url('Auth'); ?>">
                                        <?= $this->session->flashdata('message'); ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userid" name="userid" placeholder="Userid" value="<?= set_value('userid') ?>">
                                            <?= form_error('userid', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>