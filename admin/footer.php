<div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <p class="copyright">&copy; <?=date('Y');?><a href="https://www.clouddreams.in" target="_blank"> | Clouddreams</a>. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
    <script src="assets/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/vendor/chartist/js/chartist.min.js"></script>
    <script src="assets/scripts/klorofil-common.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script>
    // 	 tinyMCE.init({
    //     //mode : "textareas",
    //     mode : "specific_textareas",
    // editor_selector : "mceEditor",
    // });

       tinymce.init({ selector:'.tinymce',
    plugins: "code image media print autoresize link autolink"
    });
</script>

<script>
$(document).ready(function() {
    $('#datatable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<?php $url = $_SERVER['REQUEST_URI'];
                                        $url=explode("/",$url);
                                        $url= (end($url));
                                        if($url=='welcome.php'){ 

//DAILY REPORT
$d0=$db->queryUniqueObject("SELECT SUM(total_price) as d0 FROM `orders` WHERE date LIKE '".date('Y-m-d')."%'");
$d1=$db->queryUniqueObject("SELECT SUM(total_price) as d1 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-1 day'))."%'");
$d2=$db->queryUniqueObject("SELECT SUM(total_price) as d2 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-2 day'))."%'"); 
$d3=$db->queryUniqueObject("SELECT SUM(total_price) as d3 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-3 day'))."%'");                                            
$d4=$db->queryUniqueObject("SELECT SUM(total_price) as d4 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-4 day'))."%'");                                            
$d5=$db->queryUniqueObject("SELECT SUM(total_price) as d5 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-5 day'))."%'");                                            
$d6=$db->queryUniqueObject("SELECT SUM(total_price) as d6 FROM `orders` WHERE date LIKE '".date('Y-m-d', strtotime('-6 day'))."%'");                                            
//MONTHLY REPORT
$m0=$db->queryUniqueObject("SELECT SUM(total_price) as m0 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-31')."')");
$m1=$db->queryUniqueObject("SELECT SUM(total_price) as m1 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-1 Months'))."' AND '".date('Y-m-31', strtotime('-1 Months'))."')");
$m2=$db->queryUniqueObject("SELECT SUM(total_price) as m2 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-2 Months'))."' AND '".date('Y-m-31', strtotime('-2 Months'))."')");
$m3=$db->queryUniqueObject("SELECT SUM(total_price) as m3 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-3 Months'))."' AND '".date('Y-m-31', strtotime('-3 Months'))."')");
$m4=$db->queryUniqueObject("SELECT SUM(total_price) as m4 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-4 Months'))."' AND '".date('Y-m-31', strtotime('-4 Months'))."')");
$m5=$db->queryUniqueObject("SELECT SUM(total_price) as m5 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-5 Months'))."' AND '".date('Y-m-31', strtotime('-5 Months'))."')");
$m6=$db->queryUniqueObject("SELECT SUM(total_price) as m6 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-5 Months'))."' AND '".date('Y-m-31', strtotime('-6 Months'))."')");
$m7=$db->queryUniqueObject("SELECT SUM(total_price) as m7 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-7 Months'))."' AND '".date('Y-m-31', strtotime('-7 Months'))."')");
$m8=$db->queryUniqueObject("SELECT SUM(total_price) as m8 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-8 Months'))."' AND '".date('Y-m-31', strtotime('-8 Months'))."')");
$m9=$db->queryUniqueObject("SELECT SUM(total_price) as m9 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-9 Months'))."' AND '".date('Y-m-31', strtotime('-9 Months'))."')");
$m10=$db->queryUniqueObject("SELECT SUM(total_price) as m10 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-10 Months'))."' AND '".date('Y-m-31', strtotime('-10 Months'))."')");
$m11=$db->queryUniqueObject("SELECT SUM(total_price) as m11 FROM `orders` WHERE (date BETWEEN '".date('Y-m-01', strtotime('-11 Months'))."' AND '".date('Y-m-31', strtotime('-11 Months'))."')");
 ?>
                          
    <script>
    $(function() {
        var data, options;

        // daily charts
        data = {
            labels: ['<?=date('D', strtotime('-6 day'));?>', '<?=date('D', strtotime('-5 day'));?>', '<?=date('D', strtotime('-4 day'));?>', '<?=date('D', strtotime('-3 day'));?>', '<?=date('D', strtotime('-2 day'));?>', '<?=date('D', strtotime('-1 day'));?>', '<?=date('D');?>'],
            series: [
                [<?=$d6->d6;?>,<?=$d5->d5;?>,<?=$d4->d4;?>,<?=$d3->d3;?>,<?=$d2->d2;?>,<?=$d1->d1;?>,<?=$d0->d0;?>],
                [<?=$d0->d0;?>, <?=$d1->d1;?>, <?=$d2->d2;?>, <?=$d4->d4;?>, <?=$d3->d3;?>, <?=$d6->d6;?>, <?=$d5->d5;?>],
            ]
        };

        options = {
            height: 300,
            showArea: true,
            showLine: false,
            showPoint: false,
            fullWidth: true,
            axisX: {
                showGrid: false
            },
            lineSmooth: false,
        };

        new Chartist.Line('#daily-chart', data, options);


        //monthly charts
        data = {
            labels: ['<?=date('M', strtotime('-11 Months'));?>', '<?=date('M', strtotime('-10 Months'));?>', '<?=date('M', strtotime('-9 Months'));?>', '<?=date('M', strtotime('-8 Months'));?>', '<?=date('M', strtotime('-7 Months'));?>', '<?=date('M', strtotime('-6 Months'));?>', '<?=date('M', strtotime('-5 Months'));?>', '<?=date('M', strtotime('-4 Months'));?>', '<?=date('M', strtotime('-3 Months'));?>', '<?=date('M', strtotime('-2 Months'));?>', '<?=date('M', strtotime('-1 Months'));?>', '<?=date(M);?>'],
            series: [{
                name: 'series-real',
                data: [<?=$m11->m11;?>,<?=$m10->m10;?>,<?=$m9->m9;?>,<?=$m8->m8;?>,<?=$m7->m7;?>,<?=$m6->m6;?>,<?=$m5->m5;?>,<?=$m4->m4;?>,<?=$m3->m3;?>,<?=$m2->m2;?>,<?=$m1->m1;?>,<?=$m0->m0;?>,],
            }, {
                name: 'series-projection',
                data: [<?=$m11->m11;?>,<?=$m10->m10;?>,<?=$m9->m9;?>,<?=$m8->m8;?>,<?=$m7->m7;?>,<?=$m6->m6;?>,<?=$m5->m5;?>,<?=$m4->m4;?>,<?=$m3->m3;?>,<?=$m2->m2;?>,<?=$m1->m1;?>,<?=$m0->m0;?>,],
            }]
        };

        options = {
            fullWidth: true,
            lineSmooth: false,
            height: "270px",
            low: 0,
            high: 'auto',
            series: {
                'series-projection': {
                    showArea: true,
                    showPoint: false,
                    showLine: false
                },
            },
            axisX: {
                showGrid: false,

            },
            axisY: {
                showGrid: false,
                onlyInteger: true,
                offset: 0,
            },
            chartPadding: {
                left: 20,
                right: 20
            }
        };

        new Chartist.Line('#monthly-chart', data, options);
    });
    </script>

    <?php } ?>
</body>

</html>
