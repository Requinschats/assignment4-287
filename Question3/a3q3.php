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

session_start();

<div id="app">
    <v-app dark id="inspire">
        <v-toolbar app fixed clipped-left dark>
            <img src="https://picsum.photos/510/300?random" id="headerImage">
            <v-toolbar-title class="title font-weight-light">Hotel Room Search</v-toolbar-title>
            <?php if(isset($_POST['username'])) {
                echo "<h1 class=\"title font-weight-light\">Hello " . htmlspecialchars($_POST['username']) . "!!</h1>";
            } ?>
            <h1 class="title font-weight-light" id="clock"> {{time}}</h1>
        </v-toolbar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout justify-center align-content-center>
                <v-card light v-if="loginPage" id="loginCard">
                    <v-layout justify-center pb-3>
                    <v-card-title style="justify-content: center" pb-3>
                        <v-icon large left>far fa-user  </v-icon>
                        <span class="title font-weight-light">Login </span>
                    </v-card-title>
                    </v-layout>
                        <form method="POST" action="a3q3.php" id="loginForm" name="loginForm">
                        <v-text-field v-model="username" outline dark autofocus color="white" label="username" :rules="[usernameRules.required, usernameRules.counter, usernameRules.content]" pt-3></v-text-field>
                        <v-text-field v-model="password" outline dark color="white" label="password" type="password" :rules="[passwordRules.required, passwordRules.counterMax, passwordRules.counterMin, passwordRules.characterDigit]" pt-3></v-text-field>
                            <input type="hidden" name="username" value="">
                            <input type="hidden" name="password" value="">
                            <input type="hidden" name="typeOfRequest" value="">
                        <v-layout justify-center>
                        <v-btn type="submit" round @click="typeOfRequest = 'login';login">Login </v-btn>
                        </v-layout>
                        <v-layout justify-center pt-3>
                        <v-btn outline round dark color="white" @click="typeOfRequest = 'create';login">Create new account</v-btn>
                        </v-layout>
                        </form>
                </v-card>
                </v-layout>
            </v-container>
            <v-dialog v-model="disclaimerDialog" max-width="400px" dark>
                <v-card id="disclaimerCard" light>
                    <v-card-title style="justify-content: center" pb-3>
                        <v-icon large left> fas fa-user-secret </v-icon>
                        <span class="title font-weight-light">Disclaimer & Privacy</span>
                    </v-card-title>
                    <span class="font-weight-light"> Your information will not be sold or misused. </span>
                    <span class="font-weight-light"> The creator of this website is not liable nor responsible of any error in the content displayed </span>
                </v-card>
            </v-dialog>
        </v-content>
        <v-footer app fixed light color="grey lighten-1" height="50px" v-if="showFooter">
            <span class=" font-weight-light">&copy; 2019 All images randomly generated from: https://picsum.photos/510/300?random</span>
            <v-btn style="margin-left: 14%" dark round @click="disclaimerDialog=true" light color="grey darken-2">Privacy/Disclaimer</v-btn>
            <v-btn style="margin-left: 42%" fab small @click="showFooter=false"><v-icon color="grey darken-2">fas fa-times</v-icon></v-btn>
        </v-footer>
    </v-app>
</div>
<script>
   var app = new Vue({
        el: "#app",
        data() {
            return {
                userNameEntered: "<?php $username ?> ",
                username: "",
                password: "",
                typeOfRequest: "",
                time: '',
                date: '',
                disclaimerDialog: false,
                loginPage: true,
                showFooter: true,
                usernameRules: {
                    required: value => !!value || 'Required.',
                    counter: value => value.length <= 20 || 'Max 20 characters',
                    content: value => {
                        const pattern = /[\w*-]$/;
                        return pattern.test(value) || 'Invalid username.'
                    }
                },
                passwordRules: {
                    required: value => !!value || 'Required.',
                    counterMax: value => value.length <= 20 || 'Max 20 characters',
                    counterMin: value => value.length >= 6 || 'Min 6 characters',
                    characterDigit: value => {
                        const pattern = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
                        return pattern.test(value) || 'Must contain at least one digit and one character and no special character'
                    }
                }
            }
        },
       methods:{
            login: function(){
                document.loginForm.username.value = this.username;
                document.loginForm.password.value = this.password;
                document.loginForm.typeOfRequest.value =
                document.forms["loginForm"].submit();
            }
       },
        computed:{
        }
    });
</script>

<?php
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['username']);
    $typeOfRequest

    $loginCredentialsFile = fopen("loginCredentials", "w");

?>

</body>
</html>