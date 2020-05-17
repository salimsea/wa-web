<html>
    <head>
        <title>Whatsapp QRCODE</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    </head>
    <body>
        <center>
            <div id="qrCode"></div>
            
        </center>
    </body>
    <script type="text/javascript">
    function generate(){
        $.post('api-code.php', { url: 'https://wapi.salimseal.com/api-code.php' }, function(data) { 
             var url = 'https://wapi.salimseal.com/api-qrcode.php?key=tester&text='+encodeURIComponent(data);
             $('#qrCode').html("<img src='"+url+"'>");
        });
    }
    generate()
        
    setInterval(() => {
        generate()
    }, 1000)
    </script>
</html>