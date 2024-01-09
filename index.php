<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>For Labeling Nametag</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body class="min-vh-100">
    <div class="container mt-4">
        <div class="row row-cols-2 g-4">
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col">
                    <div class="boxed">
                        <h1 class="product-name text-center "><b><?php echo $row['model_description']; ?></b></h1>
                        <div class="model-lb">
                            <h2 class="product-color">Model: <?php echo $row['model_number']; ?></h2>
                            <h3 class="product-code"><?php echo $row['sap_code']; ?></h3>
                            <svg class="barcode" jsbarcode-format="upc" jsbarcode-value="<?php echo $row['upc_code']; ?>"
                                jsbarcode-textmargin="0" jsbarcode-fontoptions="bold" jsbarcode-width="3" jsbarcode-height="50"
                                jsbarcode-fontSize="20">
                            </svg>
                        </div>
                        <div class="sku-item">
                            <p class="product-sku">SKU : <?php echo $row['sku_number']; ?></p>
                            <p class="product-ukuran">Size : <?php echo $row['size_description']; ?></p>
                            <p class="product-colour">Colour : <?php echo $row['colour_description']; ?> (<?php echo $row['colour_code']; ?>)</p>
                            <p class="product-msrp">MSRP CAD : <?php echo $row['msrp_cad']; ?></p>
                            <hr>
                            <div class="qr-container">
                                <div class="information"><?php echo $row['qr_caption']; ?></div>
                                <div class="qr" data-value="<?php echo $row['qr_data']; ?>"></div>
                                <div class="pono"><?php echo $row['pono']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script>
        var barcodeElements = document.querySelectorAll(".barcode");
        barcodeElements.forEach(function (element) {
            var upcCode = element.getAttribute("jsbarcode-value");
            if (upcCode) {
                JsBarcode(element, upcCode).init();
            } else {
                console.error("Kode UPC tidak valid:", upcCode);
            }
        });

        var qrElements = document.querySelectorAll(".qr");
        qrElements.forEach(function (element) {
            var qrData = element.getAttribute("data-value");
            if (qrData) {
                var qr = new QRCode(element, {
                    text: qrData,
                    width: 90,
                    height: 90,
                });
            } else {
                console.error("Data QR code tidak valid:", qrData);
            }
        });
    </script>
</body>

</html>
