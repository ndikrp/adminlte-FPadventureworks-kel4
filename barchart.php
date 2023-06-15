<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Adventure Works Cycles</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/styleGraph.css">

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

</head>

<body id="page-top">

<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
//data barchart
include ('data.php');
include ('data2.php');

$data = json_decode($data, TRUE);
$data2 = json_decode($data2, TRUE);
// $data2 = json_decode($data2, TRUE);

?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php";?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                
                <div id="barchart" class="grafik"></div>
                <p class="highcharts-description">
                Berikut merupakan grafik untuk menampilkan produk apa yang terjual paling banyak dalam tahun 2003.
                </p>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dashboard Adventure Works Cycles</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
    // Create the barchart
        Highcharts.chart('barchart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top Product in A Year'
            },
            subtitle: {
                text: 'Source: Database Adventure Works Cycles'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'nama produk'
            },
            yAxis: {
                title: {
                    text: 'Jumlah Pembelian'
                }
            
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}$'
                    }
                }
            },
        
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}$</b> of total<br/>'
            },
        
            series: [
                {
                    name: "Nama Produk",
                    colorByPoint: true,
                    data: [
                        <?php foreach ($data as $data):?>
                        {
                            name: '<?= $data["nama_produk"]; ?>',
                            y: <?= $data["bulan"]; ?>,
                            drilldown: '<?= $data["total_terjual"]; ?>'
                        },
                        <?php endforeach;?>
                    ]
                }
            ],
            drilldown: {
                series: [
                    <?php for ($i=0; $i < count($data2); $i+=5):?>
                    {
                        name: "<?= $data2[$i]["nama_vendor"]; ?>",
                        id: "<?= $data2[$i]["kota"]; ?>",
                        data: [
                            <?php for ($a=$i; $a < $i+5; $a++):?>
                            [
                                "<?= $data2[$a]["kategori"]; ?>",
                                <?= $data2[$a]["bulan"]; ?>
                            ],
                            <?php endfor;?>
                        ]
                    },
                    <?php endfor;?>
                ]}
        });
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js"></script>


</body>

</html>