<!DOCTYPE html>
<html lang="en">
<head>
    <title>TAREFAS</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- ##########     ########## -->
    <!-- ########## CSS ########## -->
    <!-- ##########     ########## -->
    <link href="<?=URLSITE;?>css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
</head>
    <body>
        <div id="wrapper">
            <div id="header" class="fundoPrimario">
                <div class="centralizar">
                    <?php include("header.php");?>
                </div>
            </div>

            <br clear="all">
            <div id="page-wrapper">
                <div class="centralizar">
                    <?php echo $actionReturn; ?>
                </div>
            </div>
        </div>
        
    </body>
</html>