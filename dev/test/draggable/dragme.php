<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Draggin and sorting!</title>
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
                function createObject(id, position) {

                    return {
                        "id": id,
                        "position": position
                    }

                }
                $( "#sortable" ).sortable({
                    update: function(event, ui) {
                        var result = [];//new Array();
                        $("#sortable li").each(function(idx, item){
                            var id = $(item).attr('id');
                            var oRow = createObject(id,idx);
                            result.push(oRow);
                            
                        });
                        //once we have the result let's show it!!
                        var jsonResult = JSON.stringify(result);
                        //once we know it works let's send it!!
                        $.post(
                        "json_process.php",
                        {jsonObject: jsonResult},
                        function(data){
                            $("#response").html(data);
                        }
                    );
                        
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
            while ($i < 5) {
                $i++;
                echo '<li id="' . $i . '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item ' . $i . '</li>';
            }
            ?>
        </ul>
        <div id="response">

        </div>
    </body>
</html>