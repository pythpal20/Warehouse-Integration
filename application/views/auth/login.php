<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><img src="<?= base_url() ?>assets/img/system/kalibaru.png" alt=""></h1>
                                </div>
                                <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                            <div class="input-group-append">
                                                <span id="mybutton" onclick="change()" class="input-group-text">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        LOGIN
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    System Gudang Foodpack <?= date('Y'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!--<div class="modal fade bg-transparent" id="pop">-->
<!--    <div class="modal-dialog bg-transparent">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-content">-->
<!--                <img src="<?= base_url('assets'); ?>/img/system/1663229536458.JPG" alt="">-->
<!--            </div>-->
<!--            <div class="modal-footer" style="background-color:transparent">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">close</span>-->
<!--                </button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->