<!DOCTYPE html>
<html>
  <head>
    <title>QR Code Generate</title>

    <!-- (A) LOAD QRCODEJS LIBRARY -->
    <!-- https://cdnjs.com/libraries/qrcodejs -->
    <!-- https://github.com/davidshimjs/qrcodejs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  </head>
  <body>
    <!-- (B) QR CODE HERE -->
    <div id="printable">
    <?php
$test = $_POST['name'];
echo "<h1 id='test'>localhost/poodos/poodos1.0/start.php/$test</h1>";
echo $_POST['date'];
?>

      <div id="qrcode"></div>
    </div>
    <button id="qrprint">PRINT</button>

    <!-- (C) CREATE QR CODE ON PAGE LOAD -->
    <script>
    window.addEventListener("load", function(){
      // (C1) CREATE QR
      var  test = document.getElementById("test").innerHTML;
      var qrc = new QRCode(document.getElementById("qrcode"), {
        text: test,
        width: 100,
        height: 100,
        colorDark: "#bf2a2a"
      });

      // (C2) PRINT
      document.getElementById("qrprint").addEventListener("click", function(){
        var printwin = window.open("");
        printwin.document.write(document.getElementById("printable").innerHTML);
        printwin.stop();
        let qr = printwin.document.querySelector("#qrcode img");
        qr.addEventListener("load", function(){
          printwin.print();
          printwin.close();
        });
      });
    });
    </script>
  </body>
</html>
