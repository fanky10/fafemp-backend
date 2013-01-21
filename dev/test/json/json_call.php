<html>
    <head>              
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

        <script>
            function sendData() {
                $.getJSON('json_test.php', function(data) {
                    var items = [];
                    $.each(data, function(key, jsonItem) {
                        //al ser una lista, lo transformamos en un objeto y listo (:
                        var oItem = $.parseJSON(jsonItem);
                        items.push("<li>Id: "+oItem.id+" Nombre: "+oItem.nombre+" </li>");
                        
                    });
                    $('<ul/>', {
                        'class': 'my-new-list',
                        html: items.join('')
                    }).appendTo('#table');
                });
            }
                  
                  
        </script>
    </head>
    <body>
        <a onclick="sendData();" title="hola!" href="#">Que onda???</a>
        <div id="response">
        </div>
        <div id="object">
        </div>
        <div id="table">
        </div>

    </body>
</html>
