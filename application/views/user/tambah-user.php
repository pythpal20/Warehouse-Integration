<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message'); ?>
            <div class="card mb-3">
                <h5 class="card-header card-title bg-primary text-white">
                    <i class="card-img"><span class="fas fa-fw fa-pen-alt"></span></i> Form Tambah User
                </h5>
                <div class="card-body text-dark" style="background-color:#D3D3D3;">
                    <form action="<?= base_url('user/addUser'); ?>" method="POST">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="cth: admin@domain.com" autocomplete="off" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email">No. HP</label>
                                    <input type="text" class="form-control" id="nohp" name="nohp" pattern="[0-9]{2}[1-9]{2}[0-9]{4,9}" placeholder="cth: 08123456789" value="<?= set_value('nohp'); ?>">
                                    <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="tempatlahir">User Role</label>
                                    <select name="userRole" id="userRole" class="form-control userRole">
                                        <option value=""></option>
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r['role_id']; ?>"><?= $r['role']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('userRole', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3" id="lokation">
                                <div class="form-group">
                                    <label for="">Lokasi Tugas</label>
                                    <select id="loktask" name="loktask" class="form-control loktask">
                                        <option value="r118">= Pilih =</option>
                                        <option value="a50">Gudang Arjuna 50</option>
                                        <option value="g75">Gudang Garuda 75</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="passoword">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password1" id="password1" placeholder="input password">
                                            <div class="input-group-append">
                                                <span id="mybutton" onclick="change()" class="input-group-text">
                                                    <i class="fas fa-fw fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">&nbsp;</label>
                                        <input type="password" class="form-control" name="password2" id="password2" placeholder="ulangi password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-round btn-primary float-right"><span class="fas fa-fw fa-save"></span> Simpan</button>
                    </form>
                </div>
                <div class="card-footer bg-primary text-white">
                    <p class="card-text"><small><em>Isi form dengan lengkap | login user menggunakan email dan password yang diset dalam form ini nantinya</em></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(() => {
        $(".userRole").select2({
            placeholder: "~ Pilih Role User ~",
            allowClear: 'true',
            style: 'form-control'
        });
    });

    function change() {
        var x = document.getElementById('password1').type;
        if (x == 'password') {
            document.getElementById('password1').type = 'text';
            document.getElementById('mybutton').innerHTML = `<i class="fas fa-fw fa-eye-slash"></i>`;
        } else {
            document.getElementById('password1').type = 'password';
            document.getElementById('mybutton').innerHTML = `<i class="fas fa-fw fa-eye"></i>`;
        }
    }

    $(document).ready(function() {
        
        $("#lokation").hide();
        $(".userRole").change(function() {
            var role = $("#userRole").val();
            if(role == '3') {
                $("#lokation").show();
            } else {
                $("#lokation").hide();
            }
        });
    });
</script>