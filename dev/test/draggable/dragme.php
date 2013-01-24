<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>jQuery UI Sortable - Default functionality</title>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <style>
            #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
            #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
            #sortable li span { position: absolute; margin-left: -1.3em; }
        </style>
        <script>
            $(function() {
                $( "#sortable" ).sortable({
                    update: function(event, ui) {
                        var listOrder = $(this).sortable('toArray').toString();
                        $("#response").html("my selection list "+listOrder);
                        $.post("ajax.php",listOrder);
                    }
                    
                    
                });
                $( "#sortable" ).disableSelection();
                
            });
        </script>
    </head>
    <body>
        <ul id="sortable">
            <?php
                $i = 0;
                while ($i<10){
                    $i++;
                    echo '<li id="'.$i.'" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item '.$i.'</li>';
                }
            ?>
        </ul>
        <div id="response">
            
        </div>
    </body>
</html>