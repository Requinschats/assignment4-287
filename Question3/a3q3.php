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

<?php
session_start();
?>


<div id="app">
    <v-app dark id="inspire">
        <v-toolbar app fixed clipped-left light>
            <img src="https://picsum.photos/510/300?random" id="headerImage">
            <v-toolbar-title class="title font-weight-light">Hotel Room Search</v-toolbar-title>
            <h1 class="title font-weight-light" style="color: #424242; margin-left: 30%" v-show="credentialsValidity == 'true'"> Welcome {{sessionUsername}} !</h1>
            <h1 class="title font-weight-light" style="color: #424242" id="clock1" v-show="credentialsValidity == 'true'"> {{time}}</h1>
            <h1 class="title font-weight-light" style="color: #424242" id="clock2" v-show="credentialsValidity == 'false'"> {{time}}</h1>
            <v-btn s style="padding-left: 5px" v-if="credentialsValidity == 'true'" fab flat @click="credentialsValidity ='false'; logout = true"> <v-icon color="#424242"> fas fa-sign-out-alt</v-icon></v-btn>
        </v-toolbar>
        <v-content>
            <v-alert
                    v-model="createdAccountAlert"
                    dismissible
                    type="success"
                    color="green"
                    transition="scale-transition"
            >
                Your account was successfully {{ sessionUsername }}
            </v-alert>
            <v-alert
                    v-model="isValidCredentials"
                    dismissible
                    type="error"
                    color="red"
                    transition="scale-transition"
            >
                Invalid credentials
            </v-alert>
            <v-container fluid fill-height>
                <v-layout justify-center align-content-center v-if="credentialsValidity == 'false' || logout">
                <v-card light id="loginCard">
                    <v-layout justify-center pb-3>
                    <v-card-title style="justify-content: center" pb-3>
                        <v-icon large left>far fa-user  </v-icon>
                        <span class="title font-weight-light">Login </span>
                    </v-card-title>
                    </v-layout>
                        <form method="POST" action="a3q3.php" id="loginForm" name="loginForm">
                        <v-text-field v-model="username" outline dark autofocus color="white" label="username" :rules="[usernameRules.required, usernameRules.counter, usernameRules.content]" pt-3></v-text-field>
                        <v-text-field v-model="password" outline dark color="white" label="password" type="password" :rules="[passwordRules.required, passwordRules.counterMax, passwordRules.counterMin, passwordRules.characterDigit]" pt-3></v-text-field>
                            <input type="hidden" name="username" value="x">
                            <input type="hidden" name="password" value="x">
                            <input type="hidden" name="typeOfRequest" value="x">
                        <v-layout justify-center>
                        <v-btn type="submit" outline round dark color="white" @click="logout = false; typeOfRequest = 'login';login()">Login </v-btn>
                        </v-layout>
                        <v-layout justify-center pt-3>
                        <v-btn round @click="logout = false; typeOfRequest = 'create';login(); createdAccountAlert = true">Create new account</v-btn>
                        </v-layout>
                        </form>
                </v-card>
                </v-layout>
                <v-layout justify-center align-content-center v-if="credentialsValidity == 'true' && !logout">
                    <v-card light v-if="credentialsValidity == 'true'" id="hotelsCard">
                        <v-card-title style="justify-content: center" pb-5>
                            <v-icon large left>fas fa-search</v-icon>
                            <span class="title font-weight-light">Search for an hotel</span>
                        </v-card-title>
                        <form method="POST" action="a3q3.php" id="hotelsForm" name="hotelsForm">

                            <v-combobox v-model="category" :items="categories" style="margin-top: 20px" autofocus label="Choose a category"></v-combobox>
                            <v-text-field v-model="keyword" style="margin-top: 20px;" outline label="Keyword..."></v-text-field>

                            <input type="hidden" name="category" value="x">
                            <input type="hidden" name="keyword" value="x">
                            <input type="hidden" name="typeOfRequest" value="x">
                            <v-layout justify-center pt-3>
                                <v-btn type="submit" outline round dark color="grey darken-2" @click="search()">Search </v-btn>
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
        <v-footer app fixed light color="grey lighten-1" height="50px" v-if="showFooter" id="footer">
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
                category: '',
                keyword: '',
                categories: [ {header: 'Select a search category:'}, {text: 'location'}, {text: 'address'}, {text: 'number of rooms available'}, {text: 'special facilities'}, {text: 'price'}],
                request: "<?php $typeOfRequest = htmlspecialchars($_POST['typeOfRequest']);
                        echo $typeOfRequest;
                ?>",
                userNameEntered: '<?php echo $var?> ',
                username: "",
                sessionUsername: "<?php echo htmlspecialchars($_POST['username']); ?>",
                password: "",
                typeOfRequest: "",
                credentialsValidity: "<?php
                $var = "X";
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $typeOfRequest = htmlspecialchars($_POST['typeOfRequest']);

                $loginCredentialsFile = fopen("loginCredentials.txt", "a+");
                $credentialsValidity = "false";

                if($typeOfRequest == 'create'){
                    fwrite($loginCredentialsFile, $username . ":" . $password. ";\n");
                    $credentialsValidity = "true";
                    echo $credentialsValidity;
                }else{
                   while ($line = fgets($loginCredentialsFile)) {
                        $lineUserName = substr($line, 0, strpos($line,":"));
                        $linePassword = substr($line, strpos($line,":")+1, strpos($line,";")-strpos($line,":")-1);
                        if($username == $lineUserName && (strpos($password, $linePassword) != false || $password == $linePassword)){
                            $credentialsValidity = "true";
                        }
                    }
                    echo $credentialsValidity;
                }
                ?>",

                hotelsString: '<?php
                    $string = file_get_contents("availableHotelRooms.txt");
                    echo json_encode($string)?>',
                time: '',
                date: '',
                disclaimerDialog: false,
                loginPage: true,
                showFooter: true,
                logout: false,
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
                },
            }
        },
       methods:{
            login: function(){
                document.loginForm.username.value = this.username;
                document.loginForm.password.value = this.password;
                document.loginForm.typeOfRequest.value = this.typeOfRequest;
                document.forms["loginForm"].submit();
            },
           search: function(){
               document.hotelsForm.keyword.value = this.keyword;
               document.hotelsForm.category.value = this.category;
               document.forms["hotelsForm"].submit();
           }
       },
        computed:{
            createdAccountAlert: function () {
                return this.request == 'create';
            },
            isValidCredentials: function () {
                if(this.request == 'create'){
                    return false
                }else if (this.request == 'login') {
                    return this.credentialsValidity === 'false' && !this.logout;
                }else{
                    return false;
                }
            }
        }
    });
</script>

<?php
    $var = "X";
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $typeOfRequest = htmlspecialchars($_POST['typeOfRequest']);

    $loginCredentialsFile = fopen("loginCredentials", "w+");
    $credentialsValidity = false;

    if($typeOfRequest == 'create'){
        fwrite($loginCredentialsFile, $username . ":" . $password. "\n");
    }else{
        while ($line = fgets($loginCredentialsFile)) {
            $lineUserName = substr($line, 0, $line.strrpos(":"));
            $linePassword = substr($line, $line.strrpos(":"), strlen($line));
            if($username == $lineUserName && $password == $linePassword){
                $credentialsValidity = true;
            }
        }
    }
?>

</body>
</html>