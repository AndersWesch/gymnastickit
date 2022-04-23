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

    <style type="text/css">
        body {
            font-family: Futura,Trebuchet MS,Arial,sans-serif;
            font-weight: 100;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Bebas Neue';
            letter-spacing: 0.1em;
        }

        html, body, main {
            height:  100%;
            max-height: 900px;
        }

        a {
            text-decoration: none;
            color: #212529;
        }

        /** RADIO TEST */
        .radios {
            padding: 0 55px;
        }

        .radios label,
        .radios input {
            display: block;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.25rem;
            text-align: center;
        }

        .radios label {
            height: 50px;
            line-height: 45px;
        }

        .radios input {
        }

        .radios input[type="radio"] {
            opacity: 0.01;
            z-index: 100;
        }

        .selected-green:checked+label,
        .Checked+label {
            background: #198754;
            color: #fff;
        }

        .selected-yellow:checked+label,
        .Checked+label {
            background: #ffc107;
            color: #212529;
        }

        .selected-red:checked+label,
        .Checked+label {
            background: #dc3545;
            color: #fff;
        }

        .radios .stick-green {
            border: 1px solid #198754;
            color: #198754;
            cursor: pointer;
            z-index: 90;
            font-size: 20px;
        }

        .radios .stick-yellow {
            border: 1px solid #ffc107;
            color: #ffc107;
            cursor: pointer;
            z-index: 90;
            font-size: 20px;
        }

        .radios .stick-red {
            border: 1px solid #dc3545;
            color: #dc3545;
            cursor: pointer;
            z-index: 90;
            font-size: 20px;
        }

        .stick-green:hover .stick-green:active{
            background: #198754;
            color: #fff;
        }

        .stick-yellow:hover .stick-yellow:active {
            background: #ffc107;
            color: #212529;
        }

        .stick-red:hover .stick-red:active {
            background: #dc3545;
            color: #fff;
        }
    </style>

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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6970330240524637"
     crossorigin="anonymous"></script>

</head>
<body>
    <?php
        // include('components/header.php');
    ?>

    <main>
        <?php
            require_once($this->view. '.php');
        ?>
    </main>

    <?php if ($this->footer) {
        include('components/footer.php');
    } ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
