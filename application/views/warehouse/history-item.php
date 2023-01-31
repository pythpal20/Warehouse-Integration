<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">History <?= $title; ?></h4>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card" style="border-top-color: OrangeRed; border-top-width: 3px;">
                        <div class="card-header">
                            <h6 class="card-title">Info Barang</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" rules="rows">
                                <tr>
                                    <th>Model</th>
                                    <td>:</td>
                                    <td><?= $brg['model'] ?></td>
                                </tr>
                                <tr>
                                    <th>Ket</th>
                                    <td>:</td>
                                    <td><?= $brg['keterangan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Add Date</th>
                                    <td>:</td>
                                    <td><?= date("d/m/Y", $brg['created_at']) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card" style="border-top-color: #FFD700; border-top-width: 3px;">
                        <div class="card-header">
                            <h6 class="card-title">Data Stok</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" rules="rows">
                                <tr>
                                    <th>Stok G-75</th>
                                    <td>:</td>
                                    <td><?= number_format($brg['stok_g75'], 0, ".", "."); ?></td>
                                </tr>
                                <tr>
                                    <th>Stok A-50</th>
                                    <td>:</td>
                                    <td><?= number_format($brg['stok_a50'], 0, ".", "."); ?></td>
                                </tr>
                                <tr>
                                    <th>Update</th>
                                    <td>:</td>
                                    <td><?= date("d/m/Y", $brg['update_at']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card" style="border-top-color: MediumSeaGreen; border-top-width: 3px;">
                        <div class="card-header">
                            <h6 class="card-title">Cari History</h6>
                        </div>
                        <div class="card-body">
                            <form id="cariHistory">
                                <div class="form-group">
                                    <label for="">Gudang</label>
                                    <select name="namaGudang" id="namaGudang" class="form-control namaGudang">
                                        <option value="">= Pilih =</option>
                                        <?php foreach ($gdg as $g) : ?>
                                            <option value="<?= $g['locator']; ?>"><?= $g['locator']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jmutasi">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control kategori">
                                        <option value="all">Semua</option>
                                        <option value="penambahan">Penambahan</option>
                                        <option value="pengurangan">Pengurangan</option>
                                        <option value="mutasi">Pindah Stok</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button id="lihatHistory" class="btn btn-success btn-sm float-right mt-2" disabled=""><span class="fas fa-fw fa-search"></span> Tampilkan</button>
            <button id="repress" class="btn btn-warning btn-sm float-right mt-2 m-2"><span class="fas fa-fw fa-refresh"></span> Reset</button>
        </div>
    </div>
    <div class="card border-left-primary mt-3" id="first">
        <h6 class="h6 card-header card-title">All History</h6>
        <div class="card-body">
            <table class="table table-striped" 
                id="tb_allmutasi" 
                data-search="true" 
                data-toggle="table" 
                data-url="<?= base_url('warehouse/listMutasi/' . $brg['code_barang']); ?>" 
                data-show-toggle="true" 
                data-show-refresh="true" 
                data-show-pagination-switch="true" 
                data-show-columns="true" 
                data-mobile-responsive="true" 
                data-check-on-init="true" 
                data-advanced-search="true" 
                data-id-table="advancedTable" 
                data-pagination="true">
                <thead>
                    <tr>
                        <th data-field="tgl_update" rowspan="2" data-valign="middle">Tgl. Update</th>
                        <th data-field="kategori" rowspan="2" data-formatter="jenis" data-valign="middle">Jenis Perubahan</th>
                        <th colspan="3" data-halign="center">Gudang G75</th>
                        <th colspan="3" data-halign="center">Gudang A50</th>
                        <th rowspan="2" data-field="updateBy" data-formatter="nama" data-valign="middle">User</th>
                        <th rowspan="2" data-field="keterangan" data-valign="middle">Keterangan</th>
                    </tr>
                    <tr>
                        <th data-field="a" data-formatter="qtyAwal75" class="table-info">Awal</th>
                        <th data-field="b" data-formatter="qtyUpdate75" class="table-warning">Perubahan</th>
                        <th data-field="c" data-formatter="qtyAkhir75" class="table-success">Akhir</th>
                        <th data-field="d" data-formatter="qtyAwal50" class="table-info">Awal</th>
                        <th data-field="e" data-formatter="qtyUpdate50" class="table-warning">Perubahan</th>
                        <th data-field="f" data-formatter="qtyAkhir50" class="table-success">Akhir</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card border-left-danger mt-3" id="seccond">
        <h6 class="h6 card-header card-title">History Item</h6>
        <div class="card-body"></div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- javascript -->
<script>
    $(document).ready(function() {
        $(".namaGudang").select2({
            allowClear: true,
            placeholder: "~ Pilih ~"
        });
        $(".kategori").select2({
            allowClear: true,
            placeholder: "~ Pilih ~"
        });
    });
    $(document).ready(function() {
        $("#seccond").hide();

        $("#repress").click(function() {
            window.location.reload();
        });
        $("#lihatHistory").click(function() {
            $("#first").hide();
            $("#seccond").show();
        });
    });
    $(document).ready(function() {
        var x = $("#namaGudang").val();
        var y = $("#kategori").val();
        $(".namaGudang").change(function(){
            var x = $("#namaGudang").val();
            if(x == '') {
                $("#ihatHistory").prop("disabled", true)
            } else {
                $("#lihatHistory").prop("disabled", false)
            }
        });
    });
</script>
<script>
    function qtyAwal75(value, row) {
        var loc = row.locator;
        if(loc == 'stok_g75') {
            return [
                row.qty_awal
            ]
        } else {
            return [
                '0'
            ]
        }
    }
    function qtyUpdate75(value, row) {
        var loc = row.locator;
        if(loc == 'stok_g75') {
            return [
                row.qty_update
            ]
        } else {
            return [
                '0'
            ]
        }
    }
    function qtyAkhir75(value, row) {
        var loc = row.locator;
        if(loc == 'stok_g75') {
            return [
                row.qty_akhir
            ]
        } else {
            return [
                '0'
            ]
        }
    }

    // gudang 50
    function qtyAwal50(value, row) {
        var loc = row.locator;
        if(loc == 'stok_a50') {
            return [
                row.qty_awal
            ]
        } else {
            return [
                '0'
            ]
        }
    }
    function qtyUpdate50(value, row) {
        var loc = row.locator;
        if(loc == 'stok_a50') {
            return [
                row.qty_update
            ]
        } else {
            return [
                '0'
            ]
        }
    }
    function qtyAkhir50(value, row) {
        var loc = row.locator;
        if(loc == 'stok_a50') {
            return [
                row.qty_akhir
            ]
        } else {
            return [
                '0'
            ]
        }
    }

    function jenis(value, row){
        if(value == 'minus') {
            return [
                '(-) STOK'
            ]
        } else if(value == 'plus') {
            return [
                '(+) STOK'
            ]
        } else {
            return [
                'MUTASI'
            ]
        }
    }

    function nama(value, row){
        return [
            value.split(" ")[0]
        ]
    }
</script>