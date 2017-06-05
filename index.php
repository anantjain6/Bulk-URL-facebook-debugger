<?php

function facebookDebugger($url) {

        $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v1.0/?id='. urlencode($url). '&scrape=1');
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $r = curl_exec($ch);
        return $r;

}
?>

<html>
    <head>
        <title>Bulk URL facebook debugger</title>

        <!-- Including Bootstrap files for theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div style="max-width:500px;margin-left: auto; margin-right: auto;">
            <center>
                <h1>Bulk URL facebook debugger</h1>
                <form action="index.php" method="POST">
                    <textarea name="url" placeholder="Type your URLs here, onre line each" class="form-control"></textarea>
                    <br/>
                    <input type="submit" value="Debug All" class="btn btn-success"/>
                </form>
                <?php
                
                if( isset($_POST['url']) )
                {
                    $text = trim($_POST['url']);
                    $textAr = explode("\n", $text);
                    $textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind
                    
                    echo '<br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>URL</th>
                                    <th>Data</th>
                                </tr>
                            <thead>
                            <tbody>';
                    
                    foreach ($textAr as $line)
                    {
                        echo '<tr>
                                <td>'.$line.'</td>
                                <td>'.facebookDebugger($line).'</td>
                            </tr>';
                    }
                    
                    echo '</tbody>
                    </table>';
                    
                }
                
                ?>
            </center>
        </div>
    </body>
</html>