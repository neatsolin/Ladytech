<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Daily Needs</title>
  
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Open Sans", sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 0 10px;
      background: url("https://i.pinimg.com/736x/b7/54/1e/b7541e05591cf263dd211ef7903ae2a4.jpg") center/cover no-repeat;
    }

    .wrapper {
      width: 450px;
      padding: 35px;
      text-align: center;
      border-radius: 12px;
      background: rgba(54, 43, 43, 0.1);
      backdrop-filter: blur(8px);
      color: #fff;
      border: 2px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }

    h2 {
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .input-field {
      position: relative;
      margin: 18px 0;
      border-bottom: 2px solid rgba(255, 255, 255, 0.7);
    }

    .input-field label {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      font-size: 16px;
      color: rgba(255, 255, 255, 0.8);
      transition: 0.3s;
    }

    .input-field input {
      width: 100%;
      padding: 10px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
    }

    .input-field input:focus~label,
    .input-field input:valid~label {
      top: 5px;
      font-size: 13px;
    }

    .profile-upload label {
      display: block;
      background: rgba(255, 255, 255, 0.2);
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin: 15px 0;
    }

    .profile-preview img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
      display: none;
      margin: 10px auto;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #fff;
      color: #000;
      font-weight: 600;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    button:hover {
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      border: 2px solid white;
    }

    .register {
      margin-top: 20px;
    }

    .register a {
      color: #efefef;
      text-decoration: none;
    }

    .register a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="wrapper">
    <h2>Register</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
      
      <div class="input-field">
        <input type="text" id="username" name="username" required>
        <label>Username</label>
      </div>

      <div class="input-field">
        <input type="email" id="email" name="email" required>
        <label>Email</label>
      </div>

      <div class="input-field">
        <input type="tel" id="phone" name="phone" required>
        <label>Phone Number</label>
      </div>

      <div class="input-field">
        <input type="password" id="password" name="password" required>
        <label>Password</label>
      </div>

      <div class="profile-upload">
        <input type="file" id="profile" name="profile" accept="image/*" onchange="previewImage(event)" hidden>
        <label for="profile">Choose Profile Picture</label>
      </div>

      <div class="profile-preview">
        <img id="preview" src="#" alt="Profile Preview">
      </div>

      <button type="submit">Register</button>

      <div class="register">
        <p>Already have an account? <a href="/F_login">Log In</a></p>
      </div>
    </form>
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById("preview");
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function() {
          preview.src = reader.result;
          preview.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    }
  </script>

</body>
</html>
