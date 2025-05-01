# 💬 FidZone

**FidZone** is a social discovery platform inspired by Facebook and Instagram, designed to help people connect, interact, and express themselves.

## 🌟 Features

- 👥 **Friend matching**: Discover and connect with new people.
- 📝 **Post sharing**: Share thoughts, photos, and updates.
- 💬 **Chatroom**: Real-time private and group messaging.
- 🎥 **Video calls**: Built-in video communication.
- 🔐 **Facial recognition login**: Secure and fast login with face ID.

## 🔧 Implementation Details

### 👥 Friend Matching
- Developed using **PHP** and **MySQL** to compare user profiles and suggest new connections.

### 📝 Post Sharing
- Posts (text/images) handled with **PHP forms** and stored in **MySQL**.
- **AJAX** used to post without refreshing the page.

### 💬 Chatroom
- Real-time messaging implemented with:
  - **Frontend**: HTML/CSS, **jQuery**, **AJAX**
  - **Backend**: PHP, MySQL
- Supports both private and group messaging.

### 🎥 Video Calls
- **Scaledrone** for signaling and room management.
- **WebRTC** enables peer-to-peer video/audio communication.
- Each call session is mapped to a unique Scaledrone room.

### 🔐 Facial Recognition Login
- Built with **Python** and the `face_recognition` module.
- Face data is captured and compared via a Python script/API.
- Successful matches trigger login via PHP session handling.

## 📁 Tech Stack

- **Frontend**: HTML, CSS, JavaScript, jQuery
- **Backend**: PHP, Python
- **Database**: MySQL
- **Real-time Communication**: AJAX, Scaledrone, WebRTC
- **Security**: Face recognition (Python module)

## 🚀 Vision

FidZone combines modern social networking features with enhanced security, creating a vibrant and trustworthy digital space.

## 📌 Notes

- This project is for academic or personal use and does not include full security measures.
- For deployment to production servers, make sure to add additional security measures (e.g., SQL injection protection, XSS prevention).
  
Copyright © 2022 by 1ching. All rights reserved.
