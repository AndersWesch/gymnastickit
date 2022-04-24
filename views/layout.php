<!DOCTYPE html>
<html>
<head>
    <title><?php echo($this->title) ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/radio.css">

    <!-- Google Analytics -->
    <?php if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') { ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-JGWWZ1KTWV"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-JGWWZ1KTWV');
        </script>
    <?php } ?>

    <!-- Google Adsense -->
    <?php if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1') { ?>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6970330240524637"
     crossorigin="anonymous"></script>
    <?php } ?>

</head>
<body>
    <main>
        <?php
            require_once($this->view. '.php');
        ?>
    </main>

    <?php if ($this->footer) {
        include('components/footer.php');
    } ?>

    <!-- Vue.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.25/vue.min.js"></script>

    <!-- Custom JS -->
    <script src="js/stick-it.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
