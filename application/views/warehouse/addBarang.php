<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Tambah <?= $title; ?></h4>
    <div class="card">
        <div class="card-body bg-gray-200">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('warehouse/addItem'); ?>" method="POST">
                <input type="hidden" id="code" name="code">
                <input type="hidden" id="createdby" name="createdby" value="<?= $user['user_nama']; ?>">
                <div class="row">
                    <!-- data header -->
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-body border-left-primary">
                                <div class="form-group">
                                    <label for="">SKU/ Model</label>
                                    <input type="text" name="model" id="model" class="form-control" value="<?= set_value('model'); ?>">
                                    <?= form_error('model', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= set_value('keterangan'); ?>">
                                    <?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- detail stok -->
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-body border-left-danger">
                                <div class="form-group">
                                    <label for="">Stok G-75</label>
                                    <input type="text" name="sg75" id="sg75" class="form-control" value="<?= set_value('sg75'); ?>">
                                    <?= form_error('sg75', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok A-50</label>
                                    <input type="text" name="sa50" id="sa50" class="form-control" value="<?= set_value('sa50'); ?>">
                                    <?= form_error('sa50', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end of detail stok -->
                </div>
                <button type="reset" class="btn btn-warning keluar"><span class="fas fa-fw fa-refresh"></span> Reset</button>
                <button type="button" class="btn btn-danger batal"><span class="fas fa-fw fa-close"></span> Batal</button>
                <button type="submit" class="btn btn-primary simpan float-right"><span class="fas fa-fw fa-save"></span> Simpan</button>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- javascript uhuuy -->
<script>
    $(document).ready(() => {
        function makeid(length) {
            var result = [];
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result.push(characters.charAt(Math.floor(Math.random() *
                    charactersLength)));
            }
            return result.join('');
        }

        var codex = makeid(6);
        document.getElementById("code").value = codex;


        $(".batal").click(() => {
            window.history.back();
        });
    });
</script>