<?php include 'includes/header.php'; ?>
<main>
    <section class="hero">
        <h2>Welcome to the Hospital Management System</h2>
        <p>Your one-stop solution for managing hospital operations efficiently.</p>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Register</a>
    </section>

    <section class="features">
        <h3>Features</h3>
        <div class="feature">
            <h4>For Patients</h4>
            <p class="a">📅 Book appointments, 🏥 view your medical history, and 💊 receive prescriptions.</p>
        </div>
        <div class="feature">
            <h4>For Doctors</h4>
            <p class="a">🗂 Manage your schedule, 👩‍⚕️ view patient details, and 📝 provide medical advice.</p>
        </div>
        <div class="feature">
            <h4>For Admins</h4>
            <p class="a">📊 Oversee hospital operations, 👩‍⚕️ manage doctors & patients, and 📅 handle appointments.</p>
        </div>
    </section>

    <section class="about">
        <h3 class="b">About Us</h3>
        <p class="a">Our system <strong>streamlines hospital operations</strong>, <strong>reduces paperwork</strong>, and <strong>enhances patient care</strong>. With a <strong>user-friendly interface</strong> and <strong>role-based access</strong>, we improve healthcare efficiency.</p>
    </section>
</main>

<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    color: #222;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}
.b{
    color:#003366;
}
.a{
    color:rgb(45, 46, 48);
    font-size:19px;
}

/* Centered Main Layout */
main {
    padding: 20px;
    max-width: 1100px;
    margin: auto;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #003366, #00509e);
    color: #fff;
    padding: 40px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
}

.hero h2 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 20px;
    
    
}

.btn {
    background: #ff5722;
    color: white;
    font-size: 1.1em;
    padding: 12px 25px;
    border-radius: 8px;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
    font-weight: bold;
}

.btn:hover {
    background: #ff7043;
}

/* Features Section */
.features {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

.features h3 {
    text-align: center;
    font-size: 2em;
    margin-bottom: 15px;
    color: #003366;
}

.feature {
    text-align: center;
    padding: 15px;
    margin: 10px 0;
    background: #f0f0f0;
    border-radius: 8px;
    box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
}

.feature h4 {
    color: #00509e;
    font-size: 1.5em;
}

/* About Section */
.about {
    text-align: center;
    padding: 20px;
    font-size: 1.2em;
    margin-top: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero h2 {
        font-size: 2em;
    }

    .hero p {
        font-size: 1em;
    }

    .btn {
        font-size: 1em;
        padding: 10px 20px;
    }

    .features, .about {
        padding: 15px;
    }

    .feature {
        padding: 10px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
