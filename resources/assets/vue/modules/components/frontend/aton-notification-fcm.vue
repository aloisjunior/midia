<script>
//     var firebase = require('firebase');
//     require("firebase/firebase-app");
//     require("firebase/firebase-auth");
//     require('firebase/firebase-messaging');
//
//     export default {
//         data() {
//             return {
//                 name: 'aton-notification-fcm',
//                 configFCM:{
//                     apiKey: "AIzaSyD1MZbvDJ0mkZy69fGMlIO-Ev5LNjBeaMs",
//                     authDomain: "atonmidia-site-notification.firebaseapp.com",
//                     databaseURL: "https://atonmidia-site-notification.firebaseio.com",
//                     projectId: "atonmidia-site-notification",
//                     storageBucket: "",
//                     messagingSenderId: "1084956817289"
//                 },
//                 defaultMessaging : null,
//                 token:'',
//             }
//         },
//         mounted(){
//             firebase.initializeApp(this.configFCM);
//
//             this.defaultMessaging = firebase.messaging();
//
//             this.requestNotificationsPermissions();
//
//             this.defaultMessaging.onMessage(function(payload) {
//                 console.log("Message received. ", payload);
//                 // ...
//
//             });
//         },
//         methods:{
//             requestNotificationsPermissions: function() {
//                 console.log('Requesting notifications permission...');
//                 this.defaultMessaging.requestPermission().then(function() {
//                     // Notification permission granted.
//                     this.saveMessagingDeviceToken();
//                 }.bind(this)).catch(function(error) {
//                     console.error('Unable to get permission to notify.', error);
//                 });
//             },
//             saveMessagingDeviceToken : function() {
//                 this.defaultMessaging.getToken().then(function(currentToken) {
//                     if (currentToken) {
//                         console.log('Got FCM device token:', currentToken);
//                         this.token = currentToken;
//                         // Saving the Device Token to the datastore.
// //                        firebase.database().ref('/fcmTokens').child(currentToken)
// //                            .set(firebase.auth().currentUser.uid);
//                     } else {
//                         // Need to request permissions to show notifications.
//                         this.requestNotificationsPermissions();
//                     }
//                 }.bind(this)).catch(function(error){
//                     console.error('Unable to get messaging token.', error);
//                 });
//             },
//
//         },
//     }
</script>

<template>

</template>

<style scoped="">

</style>