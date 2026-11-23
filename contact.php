<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <?php include("header.php") ?>


    <main>

        <section class="contact-hero">
            <span class="contact-title">GET IN TOUCH</span>
            <h1>Let's Have a<br><span>Little Chat.</span></h1>
            <p>
                Questions, feedback, or just want to say hello?
                We'd love to hear from you.
            </p>
        </section>

        <section class="contact-section">

            <div class="contact-info">
                <span class="contact-title">CONTACT INFORMATION</span>
                <h2>We'd Love to<br>Hear From <span>You.</span></h2>

                <p>
                    Have something on your mind? Send us a message
                    or visit our café. We're always happy to connect.
                </p>

                <div class="contact-info-item">
                    <div class="contactinfo-icon">⌖</div>
                    <div>
                        <h3>Our Location</h3>
                        <p>Your Café Address, Yangon, Myanmar</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">☎</div>
                    <div>
                        <h3>Phone Number</h3>
                        <p>+95 9 123 456 789</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">✉</div>
                    <div>
                        <h3>Email Address</h3>
                        <p>hello@machacafe.com</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">◷</div>
                    <div>
                        <h3>Opening Hours</h3>
                        <p>Monday – Sunday</p>
                        <p>9:00 AM – 9:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="contact-form-box">
                <span class="contact-title">SEND US A MESSAGE</span>
                <h2>Say <span>Hello!</span></h2>

                <form action="#" method="post">

                    <div class="form-row">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name"
                                placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="email"
                                placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject"
                            placeholder="What is this about?" required>
                    </div>

                    <div class="form-group">
                        <label>Your Message</label>
                        <textarea name="message" rows="6"
                            placeholder="Write your message here..."
                            required></textarea>
                    </div>

                    <button type="submit" name="send">
                        Send Message ↗
                    </button>

                </form>
            </div>

        </section>

        <section class="visit-section">
            <div>
                <span class="contact-title">YOUR NEXT COFFEE STOP</span>
                <h2>Good Coffee.<br>Good <span>Company.</span></h2>
                <p>Come in, take a seat, and make yourself at home.</p>
            </div>

            <a href="menu.php" class="about-btn">Explore Our Menu ↗</a>
        </section>

    </main>

    <?php include("footer.php") ?>


</body>

</html>