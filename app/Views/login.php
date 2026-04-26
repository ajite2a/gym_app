<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym App - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f3a 25%, #111827 50%, #0f1219 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animated background elements */
        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.08;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, #fff, transparent);
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #fff, transparent);
            border-radius: 50%;
            bottom: 10%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, #fff, transparent);
            border-radius: 50%;
            top: 50%;
            right: 5%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .login-container {
            background: rgba(15, 18, 25, 0.85);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            width: 100%;
            max-width: 580px;
            z-index: 10;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(204, 255, 0, 0.2);
            animation: slideUp 0.6s ease-out;
            max-height: 90vh;
            display: flex;
            flex-direction: row;
            min-height: 500px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Side - Image */
        .login-left {
            flex: 0.9;
            background: url('<?= base_url('default.png') ?>') center/cover no-repeat;
            /* background-attachment: fixed; */
            position: relative;
            border-right: 2px solid #ccff00;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px 30px;
            box-shadow: inset 0 0 30px rgba(204, 255, 0, 0.3), inset 0 0 60px rgba(204, 255, 0, 0.15);
        }

        

        /* Right Side - Form */
        .login-right {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .login-header {
            background: linear-gradient(135deg, #1a1f3a 0%, #111827 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 2px solid #ccff00;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(204, 255, 0, 0.05);
            border-radius: 50%;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 1;
            animation: scaleIn 0.6s ease-out;
            color: #ccff00;
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .login-header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
            font-weight: 300;
            animation: slideIn 0.8s ease-out 0.2s both;
            color: #aaa;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .login-body {
            padding: 25px 25px;
            animation: fadeIn 0.8s ease-out 0.3s both;
            flex: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
        }

        .form-label {
            font-weight: 700;
            color: #e0e0e0;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .form-label i {
            margin-right: 8px;
            color: #ccff00;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #333;
            border-radius: 10px;
            padding: 9px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: rgba(30, 35, 50, 0.6);
            color: #ffffff !important;
        }

        .form-control:focus {
            border-color: #ccff00;
            box-shadow: 0 0 0 0.2rem rgba(204, 255, 0, 0.25);
            background: rgba(30, 35, 50, 0.8);
            outline: none;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #888;
            font-size: 0.95rem;
        }

        /* Override Bootstrap autofill styling */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus {
            -webkit-box-shadow: inset 0 0 0px 1000px rgba(30, 35, 50, 0.8) !important;
            -webkit-text-fill-color: #ffffff !important;
            color: #ffffff !important;
        }

        .form-control.is-invalid {
            border-color: #ff6b6b;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: #ccff00;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .input-group-text:hover {
            color: #e0ff1a;
        }

        .btn-login {
            background: #ccff00;
            color: #000;
            border: none;
            padding: 11px;
            font-size: 0.95rem;
            font-weight: 700;
            border-radius: 10px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            box-shadow: 0 4px 20px rgba(204, 255, 0, 0.5);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 25px rgba(204, 255, 0, 0.7);
            background: #e0ff1a;
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            background: #999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .form-check {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .form-check-input {
            border: 2px solid #444;
            cursor: pointer;
            width: 18px;
            height: 18px;
            transition: all 0.3s ease;
            background: rgba(30, 35, 50, 0.6);
        }

        .form-check-input:checked {
            background: #ccff00;
            border-color: #ccff00;
        }

        .form-check-label {
            cursor: pointer;
            color: #ccc;
            font-size: 0.85rem;
            font-weight: 500;
            margin-left: 8px;
        }

        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 8px;
        }

        .forget-password {
            text-align: right;
        }

        .forget-password a {
            color: #ccff00;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .forget-password a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ccff00;
            transition: width 0.3s ease;
        }

        .forget-password a:hover::after {
            width: 100%;
        }

        .signup-link {
            text-align: center;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 2px solid #333;
            font-size: 0.85rem;
            color: #aaa;
        }

        .login-slogan {
            text-align: center;
            font-size: 0.9rem;
            font-weight: 600;
            color: #ccff00;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            padding-bottom: 8px;
        }

        .login-slogan::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #ccff00, transparent);
        }

        .signup-link a {
            color: #ccff00;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .signup-link a:hover {
            color: #e0ff1a;
            transform: translateX(3px);
        }

        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: #ff4444;
            color: white;
            border-left: 4px solid #ff0000;
        }

        .alert-success {
            background: #44ff44;
            color: #000;
            border-left: 4px solid #00cc00;
        }

        .loading-spinner {
            display: none;
            margin-left: 8px;
            color: #000;
        }

        .spinner-border {
            color: #000 !important;
        }

        .error-message {
            color: #ff6b6b;
            font-size: 0.75rem;
            margin-top: 4px;
            display: none;
            font-weight: 500;
            animation: slideDown 0.3s ease-out;
        }

        @media (max-width: 1200px) {
            .login-container {
                max-width: 90%;
            }
        }

        @media (max-width: 1024px) {
            .login-container {
                max-width: 85%;
                min-height: 450px;
            }

            .login-header h1 {
                font-size: 1.8rem;
            }

            .login-body {
                padding: 20px;
            }
        }

        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                max-width: 100%;
                min-height: auto;
                margin: 10px;
            }

            .login-left {
                border-right: none;
                border-bottom: 2px solid #ccff00;
                min-height: 280px;
                width: 100%;
            }

            .login-right {
                min-height: auto;
                width: 100%;
            }

            .login-header h1 {
                font-size: 1.7rem;
            }

            .login-body {
                padding: 20px;
            }

            .form-control {
                padding: 8px 10px;
                font-size: 0.85rem;
            }

            .btn-login {
                padding: 9px;
                font-size: 0.9rem;
            }

            .login-slogan {
                font-size: 0.85rem;
                margin-bottom: 8px;
                letter-spacing: 0.5px;
            }
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 10px;
                max-width: calc(100% - 20px);
                min-height: auto;
                border-radius: 15px;
            }

            .login-left {
                min-height: 250px;
            }

            .login-header {
                padding: 20px 15px;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .login-header p {
                font-size: 0.8rem;
            }

            .login-body {
                padding: 18px;
            }

            .form-group {
                margin-bottom: 12px;
            }

            .form-label {
                font-size: 0.8rem;
                margin-bottom: 5px;
            }

            .form-control {
                padding: 8px 10px;
                font-size: 0.85rem;
            }

            .options-row {
                gap: 5px;
                margin-bottom: 10px;
            }

            .form-check-label {
                font-size: 0.8rem;
            }

            .forget-password a {
                font-size: 0.75rem;
            }

            .btn-login {
                padding: 9px;
                font-size: 0.9rem;
                margin-top: 6px;
            }

            .signup-link {
                font-size: 0.75rem;
                margin-top: 10px;
                padding-top: 10px;
            }
        }

        @media (max-width: 640px) {
            .login-container {
                margin: 8px;
                max-width: calc(100% - 16px);
                border-radius: 12px;
                min-height: auto;
            }

            .login-left {
                min-height: 200px;
                padding: 20px 15px;
            }

            .login-header {
                padding: 15px 12px;
                border-bottom: 1px solid #ccff00;
            }

            .login-header h1 {
                font-size: 1.3rem;
            }

            .login-header p {
                font-size: 0.75rem;
                margin-top: 5px;
            }

            .login-body {
                padding: 15px;
            }

            .form-group {
                margin-bottom: 10px;
            }

            .form-label {
                font-size: 0.75rem;
                margin-bottom: 4px;
            }

            .form-label i {
                font-size: 0.85rem;
                margin-right: 6px;
            }

            .form-control {
                padding: 7px 8px;
                font-size: 0.8rem;
                border-radius: 8px;
            }

            .form-control::placeholder {
                font-size: 0.8rem;
            }

            .form-check {
                margin-bottom: 8px;
            }

            .form-check-input {
                width: 16px;
                height: 16px;
            }

            .form-check-label {
                font-size: 0.75rem;
                margin-left: 6px;
            }

            .options-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
                margin-bottom: 8px;
            }

            .forget-password {
                text-align: left;
                width: 100%;
            }

            .forget-password a {
                font-size: 0.7rem;
            }

            .btn-login {
                padding: 8px;
                font-size: 0.85rem;
                margin-top: 5px;
                border-radius: 8px;
            }

            .alert {
                padding: 8px 12px;
                font-size: 0.75rem;
                margin-bottom: 8px;
                border-radius: 6px;
            }

            .error-message {
                font-size: 0.7rem;
                margin-top: 2px;
            }

            .signup-link {
                font-size: 0.7rem;
                margin-top: 8px;
                padding-top: 8px;
            }

            .login-slogan {
                font-size: 0.8rem;
                margin-bottom: 6px;
                letter-spacing: 0.3px;
            }

            .login-slogan::after {
                width: 30px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 5px;
                max-width: calc(100% - 10px);
                border-radius: 10px;
                min-height: auto;
                flex-direction: column;
            }

            .login-left {
                min-height: 150px;
                padding: 15px 10px;
                border-right: none;
                border-bottom: 2px solid #ccff00;
            }

            .login-right {
                width: 100%;
            }

            .login-header {
                padding: 12px 10px;
            }

            .login-header h1 {
                font-size: 1.1rem;
            }

            .login-header p {
                font-size: 0.7rem;
                margin-top: 3px;
            }

            .login-body {
                padding: 12px;
            }

            .form-group {
                margin-bottom: 8px;
            }

            .form-label {
                font-size: 0.7rem;
                margin-bottom: 3px;
            }

            .form-label i {
                font-size: 0.8rem;
                margin-right: 4px;
            }

            .form-control {
                padding: 6px 8px;
                font-size: 0.75rem;
                border-radius: 6px;
            }

            .form-control::placeholder {
                font-size: 0.75rem;
            }

            .form-check-input {
                width: 14px;
                height: 14px;
            }

            .form-check-label {
                font-size: 0.7rem;
                margin-left: 5px;
            }

            .options-row {
                flex-direction: column;
                gap: 6px;
                margin-bottom: 8px;
            }

            .forget-password a {
                font-size: 0.65rem;
            }

            .btn-login {
                padding: 7px;
                font-size: 0.8rem;
                margin-top: 4px;
                border-radius: 6px;
            }

            .btn-login::before {
                display: none;
            }

            .alert {
                padding: 6px 10px;
                font-size: 0.7rem;
                margin-bottom: 6px;
                border-radius: 4px;
            }

            .error-message {
                font-size: 0.65rem;
                margin-top: 2px;
            }

            .signup-link {
                font-size: 0.65rem;
                margin-top: 6px;
                padding-top: 6px;
            }

            .login-slogan {
                font-size: 0.75rem;
                margin-bottom: 5px;
                letter-spacing: 0.2px;
            }

            .login-slogan::after {
                width: 25px;
            }
        }

        @media (max-width: 360px) {
            .login-container {
                margin: 3px;
                max-width: calc(100% - 6px);
                border-radius: 8px;
            }

            .login-left {
                min-height: 120px;
                padding: 10px 8px;
            }

            .login-header {
                padding: 10px 8px;
            }

            .login-header h1 {
                font-size: 0.95rem;
            }

            .login-header p {
                font-size: 0.65rem;
                margin-top: 2px;
            }

            .login-body {
                padding: 10px;
            }

            .form-group {
                margin-bottom: 6px;
            }

            .form-label {
                font-size: 0.65rem;
            }

            .form-control {
                padding: 5px 6px;
                font-size: 0.7rem;
            }

            .btn-login {
                padding: 6px;
                font-size: 0.75rem;
                margin-top: 3px;
            }

            .signup-link {
                font-size: 0.6rem;
                margin-top: 5px;
                padding-top: 5px;
            }

            .login-slogan {
                font-size: 0.7rem;
                margin-bottom: 4px;
                letter-spacing: 0.1px;
            }

            .login-slogan::after {
                width: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated background -->
    <div class="bg-decoration">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <div class="login-container">
        <!-- Left Side - Image -->
        <div class="login-left"></div>

        <!-- Right Side - Form -->
        <div class="login-right">
            <!-- Header -->
            <div class="login-header">
                <h1><i class="fas fa-dumbbell"></i> Gym App</h1>
                <p>Transform Your Body, Transform Your Life</p>
            </div>

            <!-- Login Form -->
            <div class="login-body">
            <!-- Alert Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div id="errorAlert" class="alert alert-danger" role="alert" style="display: none;"></div>
            <div id="successAlert" class="alert alert-success" role="alert" style="display: none;"></div>

            <form id="loginForm" method="POST" action="/login">
                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Email Address
                    </label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        placeholder="Enter your email" 
                        required autofocus
                    >
                    <div class="error-message" id="emailError"></div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        placeholder="Enter your password" 
                        required
                    >
                    <div class="error-message" id="passwordError"></div>
                </div>

                

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <span id="loginText">Login Now</span>
                    <span class="loading-spinner" id="loadingSpinner">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </span>
                </button>
            </form>

            <!-- Slogan -->
            <div class="login-slogan">
                🔥 Rise Stronger Every Day 💪
            </div>

            <!-- Copyright -->
            <div class="signup-link">
                © 2026 Developed by <span style="color: #ccff00; font-weight: 700;">ErrorToArray</span>
            </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Auto-dismiss alerts after 5 seconds
            $('.alert:not(#errorAlert):not(#successAlert)').each(function() {
                const $alert = $(this);
                setTimeout(function() {
                    $alert.fadeOut(300, function() {
                        $alert.remove();
                    });
                }, 5000);
            });

            // Password visibility toggle
            const passwordField = $('#password');
            
            // Add password visibility toggle
            const togglePasswordVisiblity = () => {
                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                }
            };

            // Handle form submission
            $('#loginForm').on('submit', function(e) {
                // Clear previous errors
                clearErrors();

                // Get form data
                const email = $('#email').val().trim();
                const password = $('#password').val();

                // Validate form
                if (!validateForm(email, password)) {
                    e.preventDefault();
                    return false;
                }

                // Show loading state
                toggleLoadingState(true);
            });

            // Validate form
            function validateForm(email, password) {
                let isValid = true;

                // Validate email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email) {
                    showFieldError('email', 'Email is required');
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    showFieldError('email', 'Please enter a valid email');
                    isValid = false;
                }

                // Validate password
                if (!password) {
                    showFieldError('password', 'Password is required');
                    isValid = false;
                } else if (password.length < 6) {
                    showFieldError('password', 'Password must be at least 6 characters');
                    isValid = false;
                }

                return isValid;
            }

            // Show field error
            function showFieldError(fieldName, message) {
                $(`#${fieldName}Error`).text(message).show();
                $(`#${fieldName}`).addClass('is-invalid');
            }

            // Clear errors
            function clearErrors() {
                $('.error-message').hide().text('');
                $('.form-control').removeClass('is-invalid');
            }

            // Toggle loading state
            function toggleLoadingState(isLoading) {
                const $btn = $('button[type="submit"]');
                const $spinner = $('#loadingSpinner');
                const $text = $('#loginText');

                if (isLoading) {
                    $btn.prop('disabled', true);
                    $spinner.show();
                    $text.text('Logging in');
                } else {
                    $btn.prop('disabled', false);
                    $spinner.hide();
                    $text.text('Login Now');
                }
            }

            // Clear error on input
            $('#email, #password').on('input', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.error-message').hide();
            });
        });
    </script>
</body>
</html>
