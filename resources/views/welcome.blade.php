<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/icon.png">
        <link href="/css/atlantis.min.css" rel="stylesheet" >
        <style rel="stylesheet">
            [v-cloak] {
                display: none;
            }

            .upper-curve {
                background: linear-gradient(330deg, #cd17e1, #110552) !important;
                background-size: 400% 400%;

                -webkit-animation: glow-animation 3s ease infinite !important;;
                -moz-animation: glow-animation 3s ease infinite !important;;
                -o-animation: glow-animation 3s ease infinite !important;;
                animation: glow-animation 3s ease infinite !important;;


                width: 100%;
                height: 700px;
                border-bottom-left-radius: 50%;
            }

            .app-bar{
                background-color: transparent !important;
                color: white !important;
            }


            @-webkit-keyframes glow-animation {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @-moz-keyframes glow-animation {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @-o-keyframes glow-animation {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }
            @keyframes glow-animation {
                0%{background-position:0% 50%}
                50%{background-position:100% 50%}
                100%{background-position:0% 50%}
            }



            </style>
    </head>
    <body class="glow">
        <div id="app" class="flex-center position-ref">
            <v-app id="inspire" v-cloak>
                <v-app-bar app flat>
                    <v-toolbar-title class="font-weight-black purple--text"><v-btn text color="purple" to="/">GiftCenta</v-btn></v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn text class="purple--text">Explore our gift shop <v-icon>mdi-cart</v-icon></v-btn>
                </v-app-bar>


                <div class="upper-curve"></div>


                    <router-view style="margin-top: -600px"></router-view>



                <v-footer padless absolute>
                    <v-col
                        class="text-center"
                        cols="12"
                    >
                        @{{ new Date().getFullYear() }} — <strong>GiftCenta</strong> Powered By <strong>Built</strong>
                    </v-col>
                </v-footer>
            </v-app>
        </div>

    <script src="{{asset('/js/app.js')}}"></script>
    </body>
</html>

