<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Question 3</title>

    <!--vue.js-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

    <!--Vuetify framework-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet"
          type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>

    <!--font awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css"
          integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

    <link rel="stylesheet" href="a3q3.css">
    <script src="a3q3.js"></script>
</head>
<body>
<div id="app">
    <v-app dark id="inspire">
        <v-toolbar app fixed clipped-left dark>
            <img src="https://picsum.photos/510/300?random" id="headerImage">
            <v-toolbar-title>Hotel Room Search</v-toolbar-title>
            <h1 id="clock"> {{time}}</h1>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout>
                    <?php
                    echo "Hello World!";
                    ?>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app fixed light height="50px">
            <span>&copy; 2019 All images randomly generated from: https://picsum.photos/510/300?random</span>
            <v-btn dark round @click="disclaimerDialog=true">Privacy/Disclaimer</v-btn>
        </v-footer>
    </v-app>
</div>
<script>
   var app = new Vue({
        el: "#app",
        data() {
            return {
                time: '',
                date: '',
                disclaimerDialog: false
            }
        },
        computed:{
        }
    });
</script>
</body>
</html>