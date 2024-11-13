<?php 
session_start();
require_once 'model/user_model.php'; 

$userModel = new UserModel();

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $error = false;
    $error_user = false;

    $user = $userModel->getUserByName($username);
    
    if ($user && password_verify($password, $user->user_password)) {
        if ($user->role_id == 2) {
            $error_user = true;
        } else{
            $_SESSION["login"] = true;
            $_SESSION["username"] = $user->user_name;
            $_SESSION["role_id"] = $user->role_id; 
            header("Location: index.php");
            exit;
        }
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("bground.jpg"); /* Pastikan nama file sesuai dengan yang Anda simpan */
            background-size: cover; /* Agar gambar memenuhi layar */
            background-position: center; /* Pusatkan gambar */
            background-repeat: no-repeat; /* Hindari pengulangan gambar */
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #ffffff;
        }

        /* Particle canvas */
        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px 30px;
            width: 380px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-size: 14px;
            color: #ffffff;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        input {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid transparent;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #764ba2;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #ffffff;
            color: #764ba2;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: #764ba2;
            color: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
        }

        .error-message {
            color: #ff4d4d;
            margin-top: 10px;
            font-style: italic;
        }

        ::placeholder {
            color: #e5e5e5;
        }
    </style>
</head>
<body>
    <canvas></canvas>

    <div class="login-container">
        <h1>Login Here</h1>

        <?php if (isset($error_user) && $error_user): ?>
            <p class="error-message">User Tidak Bisa Login!</p>
        <?php endif; ?>

        <?php if (isset($error) && $error): ?>
            <p class="error-message">Username atau Password salah!</p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <button type="submit" name="submit">Log In</button>
        </form>
    </div>

    <script>
        const canvas = document.querySelector("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particlesArray;

        // Create particle
        class Particle {
            constructor(x, y, directionX, directionY, size, color) {
                this.x = x;
                this.y = y;
                this.directionX = directionX;
                this.directionY = directionY;
                this.size = size;
                this.color = color;
            }

            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2, false);
                ctx.fillStyle = "#ffffff";
                ctx.fill();
            }

            update() {
                if (this.x + this.size > canvas.width || this.x - this.size < 0) {
                    this.directionX = -this.directionX;
                }
                if (this.y + this.size > canvas.height || this.y - this.size < 0) {
                    this.directionY = -this.directionY;
                }

                this.x += this.directionX;
                this.y += this.directionY;

                this.draw();
            }
        }

        // Create particle array
        function init() {
            particlesArray = [];
            let numberOfParticles = (canvas.height * canvas.width) / 9000;
            for (let i = 0; i < numberOfParticles; i++) {
                let size = (Math.random() * 5) + 1;
                let x = (Math.random() * (innerWidth - size * 2) + size * 2);
                let y = (Math.random() * (innerHeight - size * 2) + size * 2);
                let directionX = (Math.random() * 2) - 1;
                let directionY = (Math.random() * 2) - 1;
                let color = "#ffffff";

                particlesArray.push(new Particle(x, y, directionX, directionY, size, color));
            }
        }

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            ctx.clearRect(0, 0, innerWidth, innerHeight);

            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
            }
        }

        // Resize canvas
        window.addEventListener("resize", function () {
            canvas.width = innerWidth;
            canvas.height = innerHeight;
            init();
        });

        init();
        animate();
    </script>
</body>
</html>
