<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5>My Profil</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('dashboard/myProfil'); ?>" method="POST">
                            <?php foreach ($profil as $p) : ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="hidden" name="id" id="id" value="<?= $p['user_id']; ?>">
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $p['user_nama']; ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="nohp">No. HP</label>
                                            <input type="text" name="nohp" id="nohp" class="form-control" value="<?= $p['user_nohp']; ?>">
                                            <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?= $p['email']; ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <label for="password">Password</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input type="password" name="password1" id="password1" class="form-control" placeholder="Password Baru anda">
                                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="password" name="password2" id="password2" class="form-control" placeholder="ulangi password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary float-right sippans"><span class="fas fa-fw fa-save"></span> Simpan</button>
                        </form>
                        <button id="batal" class="btn btn-secondary">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        $("#batal").click(function() {
            swal.fire({
                title: 'Batalkan ?',
                text: 'Anda akan diredirect ke halaman dashboard',
                imageUrl: "<?= base_url('assets/'); ?>img/icon/question.svg",
                imageHeight: 150,
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonText: 'Ok, Batalkan',
                confirmButtonColor: '#117A65',
                cancelButtonColor: '#C0392B'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.location.href = "<?= base_url('dashboard') ?>";
                }
            });
        });
    });
</script>