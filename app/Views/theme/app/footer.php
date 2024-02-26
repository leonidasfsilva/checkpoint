<footer class="footer">
    <div class="container-fluid">
        <ul class="nav">
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    Creative Tim
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    About Us
                </a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link">
                    Blog
                </a>
            </li>
        </ul>
        <div class="copyright">
            <?= env('appName') ?? 'CheckPoint'; ?> ©
            <script>
                document.write(new Date().getFullYear())
            </script>
            Todos os direitos reservados.
        </div>
    </div>
</footer>
</div>
</div>


<script src="<?= base_url('assets/js/core/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/js/core/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/sweetalert2.min.js') ?>"></script>
<script src="<?= base_url('assets/js/black-dashboard.js?v=1.1.1') ?>"></script>
<script src="<?= base_url('assets/js/plugins/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/js/plugins/jquery.mask.js') ?>"></script>
<!--<script src="../../assets/js/plugins/moment.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/bootstrap-switch.js"></script>-->
<!---->
<!---->
<!--<script src="../../assets/js/plugins/jquery.tablesorter.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/jquery.bootstrap-wizard.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/bootstrap-selectpicker.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/bootstrap-datetimepicker.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/jquery.dataTables.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/bootstrap-tagsinput.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/jasny-bootstrap.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>-->
<!--<script src="../../assets/js/plugins/fullcalendar/daygrid.min.js"></script>-->
<!--<script src="../../assets/js/plugins/fullcalendar/timegrid.min.js"></script>-->
<!--<script src="../../assets/js/plugins/fullcalendar/interaction.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/jquery-jvectormap.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/nouislider.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/chartjs.min.js"></script>-->
<!---->
<!--<script src="../../assets/js/plugins/bootstrap-notify.js"></script>-->
<!---->
<!---->

<script>

    $('.cpf').mask("999.999.999-99");

    <?php if (session()->getFlashdata('success')) : ?>
    Swal.fire({
        position: 'top',
        type: 'success',
        // title: 'Feito!',
        timer: 5000,
        html: '<?= session()->getFlashdata('success') ?>',
        showConfirmButton: false,
        showCancelButton: false,
        showCloseButton: true,
        reverseButtons: true,
        confirmButtonText: '<i class="fa fa-check fa-fw"></i> OK ',
        cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
    }).then((result) => {
        if (result.value) {

        } else {

        }
    });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
    Swal.fire({
        position: 'top',
        type: 'error',
        // title: 'Erro!',
        // timer: 3000,
        html: '<?= session()->getFlashdata('error') ?>',
        showConfirmButton: false,
        showCancelButton: false,
        showCloseButton: true,
        reverseButtons: true,
        confirmButtonText: '<i class="fa fa-check fa-fw"></i> OK ',
        cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
    }).then((result) => {
        if (result.value) {

        } else {

        }
    });
    <?php endif; ?>

    $('.form-checkpoint').submit(function (event) {
        var form = this;
        if ($(form).valid()) {
            event.preventDefault();
            $('.btn-submit').addClass('disabled');
            $('.btn-submit').html('Por favor, aguarde... <i class="fas fa-spinner fa-pulse fa-fw"></i>');

            setTimeout(function () {
                form.submit();
            }, 1000);
        }
    });


    $(document).ready(function () {
        $().ready(function () {
            $sidebar = $('.sidebar');
            $navbar = $('.navbar');
            $main_panel = $('.main-panel');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');
            sidebar_mini_active = true;
            white_color = false;

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();


            $('.fixed-plugin a').click(function (event) {
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .background-color span').click(function () {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data', new_color);
                }

                if ($main_panel.length != 0) {
                    $main_panel.attr('data', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data', new_color);
                }
            });

            $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    sidebar_mini_active = false;
                    blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                } else {
                    $('body').addClass('sidebar-mini');
                    sidebar_mini_active = true;
                    blackDashboard.showSidebarMessage('Sidebar mini activated...');
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function () {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function () {
                    clearInterval(simulateWindowResize);
                }, 1000);
            });

            $('.switch-change-color input').on("switchChange.bootstrapSwitch", function () {
                var $btn = $(this);

                if (white_color == true) {

                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').removeClass('white-content');
                    }, 900);
                    white_color = false;
                } else {

                    $('body').addClass('change-background');
                    setTimeout(function () {
                        $('body').removeClass('change-background');
                        $('body').addClass('white-content');
                    }, 900);

                    white_color = true;
                }

            });

            $('.light-badge').click(function () {
                $('body').addClass('white-content');
            });

            $('.dark-badge').click(function () {
                $('body').removeClass('white-content');
            });
        });
    });
</script>
</body>
</html>