<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breaking Date</title>
    <link rel="icon" href="favicon.png" type="image/png">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style>
        /* tutaj petla w phpie zeby nie pisac 10 razy tego samego + co drugie ma miec inny background i rozna szybkosc animacji*/
        <?php
        $x = ["8", "10", "5", "7", "9", "5", "8", "10", "6", "10"];
        for ($i = 0; $i < 10; $i++) {
            echo ".box div:nth-child(" . strval($i + 1) . ") {";
            if ($i % 2 == 0) {
                echo "background-image: url('/images/heart.png');";
            };
            echo "top: " . strval($i * 10) . "%;
        animation: animate " . $x[$i] . "s linear infinite;
    }\n\n";
        };
        ?>
    </style>
    <!-- miejsce na dodatkowe arkusze stylow -->
    @yield('css')
</head>

<body>

    <!-- przycisk powrotu -->
    <div id="back" onclick="window.isBack=1;disappear();">
    </div>

    <!-- animowane tlo -->
    <div class="box">
        <?php
        for ($i = 0; $i < 10; $i++) {
            echo "<div>
         </div>";
        }
        ?>
    </div>

    <!-- kontener na wszystkie dane -->
    <div id="container">
        @yield('content')
    </div>

    <script>
        if (!('remove' in Element.prototype)) { //funkcja obslugujaca remove() w IE
            Element.prototype.remove = function() {
                if (this.parentNode) {
                    this.parentNode.removeChild(this);
                }
            };
        }

        //domyslna funkcja powrotu
        function back() {
            window.open('<?php echo url('sympatie') ?>', '_self');
        }

        //zdeklarowanie wstepnie funkcji aby nie wyrzucilo undefined
        function ret() {};

        function disappear(a) { //funkcja zanikania zawartosci strony
            a = a || null; //domyslny parametr dla IE
            if (window.used == 1) {
                return null
            };
            window.used = 1;
            ["container", "back"].forEach(function(x) { //potworzenie animacji pojawiania sie od tylu (znikanie)
                var elm = document.getElementById(x);
                elm.style.animation = "1s appear backwards reverse";
                var newone = elm.cloneNode(true);
                elm.parentNode.replaceChild(newone, elm);
            });
            document.querySelector("#container").addEventListener('animationend', function() {
                this.style.opacity = "0";
                document.getElementById("back").style.opacity = "0"; //znikniecie zawratosci strony dla pewnosci gdyby cos stalo sie z animacja
                if (window.isBack == 1) {
                    back();
                    return undefined;
                }
                window.open('<?php
                                switch (url()->full()) {
                                    case url('register'):
                                        echo url('/');
                                        break;
                                    case url('/'):
                                        echo url('register');
                                        break;
                                    default:
                                        break;
                                };
                                ?>', '_self'); //przekierowanie w zaleznosci od podstrony
                if (a != null) {
                    ret(a); //ta funkcja jest zadeklarowana w pod-dokumentach aby po zniknieciu zawartosci strony wykonywala dana rzecz
                } else {
                    ret();
                }
            });
        };
    </script>

    <!-- miejsce na dodatkowy skrypt -->
    @yield('skrypt')


</body>

</html>