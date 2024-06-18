<!DOCTYPE html>
<html>
<head>
  <title>FCM with Laravel</title>
  {{-- <script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script> --}}
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
  <script src="https://www.gstatic.com/firebasejs/4.3.0/firebase.js"></script>
</head>
<body>

  <h1>Firebase Cloud Messaging with Laravel</h1>

  <!-- Firebase SDK -->
  {{-- <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
  <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
  <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script> --}}

  {{-- <script defer src="./init-firebase.js"></script> --}}

  <script>

      // import { initializeApp } from "firebase/app";
      // Your web app's Firebase configuration

      const firebaseConfig = {
        apiKey: "AIzaSyAH9hHe3VxODFTlnRJJrW5eB5qdbHyHW0A",
        authDomain: "recyclingapp-11fe4.firebaseapp.com",
        projectId: "recyclingapp-11fe4",
        storageBucket: "recyclingapp-11fe4.appspot.com",
        messagingSenderId: "1086562237669",
        appId: "1:1086562237669:web:0db5b7eda736646820680c"
      };

      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);

      const messaging = firebase.messaging();

      // Request permission to send notifications
      messaging.requestPermission()
      .then(() => {
        console.log('Notification permission granted.');
        return messaging.getToken();
      })
      .then((token) => {
        console.log('FCM Token:', token);
        // Here you can store the token locally, display it to the user, or handle it as needed
      })
      .catch((error) => {
        console.error('Unable to get permission to notify.', error);
      });

      // Handle incoming messages
      messaging.onMessage((payload) => {
      console.log('Message received. ', payload);
      // Customize notification here
      const notificationTitle = payload.notification.title;
      const notificationOptions = {
        body: payload.notification.body,
      };

      new Notification(notificationTitle, notificationOptions);
    });

  </script>


</body>
</html>