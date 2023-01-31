<!-- tambahan css -->
<style>
    #toolbar {
        margin: 0;
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800"><?= $title; ?></h4>
    <div class="card mb-3">
        <?= $this->session->flashdata('message'); ?>
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <div id="toolbar">
                        <button class="btn btn-round btn-secondary tambah" data-toggle="tooltip" rel="tooltip" title="Tambah Item BOM"><i class="fas fa-fw fa-plus-circle"></i> B.O.M</button>
                    </div>
                    <table class="table-hover table-striped" id="tb_bom" data-show-toggle="true" data-show-refresh="true" data-show-pagination-switch="true" data-show-columns="true" data-mobile-responsive="true" data-check-on-init="true" data-advanced-search="true" data-id-table="advancedTable" data-show-print="true" data-show-columns-toggle-all="true"></table>
                </div>
                <div class="card-footer">
                    <small>
                        Note : Bill of material merupakan data konversi SKU MK ke SKU XB
                    </small>
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
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('[rel="tooltip"]').tooltip()
        });
        // click tambah button will direct you to add new BOM page
        $(".tambah").click(function() {
            document.location.href = "<?= base_url('bofmat/addNew'); ?>";
        });
    });
    $(document).ready(function() {
        $table = $("#tb_bom")
        $table.bootstrapTable({
            url: '<?= base_url('bofmat/getBomList') ?>',
            pagination: true,
            search: true,
            toolbar: '#toolbar',
            columns: [{
                field: 'no',
                title: '#'
            }, {
                field: 'skumk',
                title: 'SKU MK',
                sortable: 'true'
            }, {
                field: 'skuxb',
                title: 'SKU XB',
                sortable: 'true'
            }, {
                field: 'harga',
                title: 'Harga (Rp.)',
                sortable: 'true',
                formatter: Rupiah
            }, {
                field: 'tgl',
                title: 'Create Date',
                sortable: 'true'
            }, {
                field: 'id',
                title: 'Act',
                formatter: tombol,
                align: 'center'
            }]
        });

        function tombol(row, value) {
            return [
                '<button class="btn btn-sm btn-rounded btn-primary edit" data-bom="' + row + '" rel="tooltip" title="edit data bom"><i class="fas fa-fw fa-edit"></i></button> ' +
                '<button class="btn btn-sm btn-rounded btn-danger hapus" data-bom="' + row + '" rel="tooltip" title="Non-aktifkan data bom"><i class="fas fa-fw fa-trash"></i></button>'
            ]
        }

        function Rupiah(value, row) {
            var sign = 1;
            if (value < 0) {
                sign = -1;
                value = -value;
            }

            let num = value.toString().includes('.') ? value.toString().split('.')[0] : value.toString();
            let len = num.toString().length;
            let result = '';
            let count = 1;

            for (let i = len - 1; i >= 0; i--) {
                result = num.toString()[i] + result;
                if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = '.' + result;
                }
                count++;
            }

            if (value.toString().includes(',')) {
                result = result + ',' + value.toString().split('.')[1];
            }
            // return result with - sign if negative
            return sign < 0 ? '-' + result : (result ? 'Rp. ' + result : '');
        }

        $('body').on('click', '#tb_bom .edit', function() {
            var id = $(this).data('bom');
            document.location.href = "<?= base_url(); ?>bofmat/editBom/" + id;
        });
        $('body').on('click', '#tb_bom .hapus', function() {
            swal.fire({
                title: 'Non-aktifkan?',
                text: 'SKU ini tidak akan muncul setelah dinon-aktifkan',
                imageUrl: "<?= base_url('assets/img/icon/question'); ?>.svg",
                imageHeight: 150,
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                confirmButtonColor: '#CD6155',
                cancelButtonText: 'Batal'
            }).then((resl) => {
                if(resl.isConfirmed){
                    
                }
            });
        });
    });
</script>