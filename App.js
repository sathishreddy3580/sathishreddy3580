import './App.css';
import React, { useEffect } from 'react';
import Router from './Navigator/RouteNavigation';
import firebase from 'firebase';
import { UserProvider } from './context/userContext';

var firebaseConfig = {
  apiKey: "AIzaSyB9koPHhTVoxFe0wPsER4q18Rcc0XPB2UQ",
  authDomain: "chatbot-b45c1.firebaseapp.com",
  projectId: "chatbot-b45c1",
  storageBucket: "chatbot-b45c1.appspot.com",
  messagingSenderId: "496813171770",
  appId: "1:496813171770:web:815e3b54a632df93ecc103",
  measurementId: "G-3E5STV2H2E"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

function App() {

  return (
    <UserProvider>
      <Router />
    </UserProvider>
  );
}

export default App;
