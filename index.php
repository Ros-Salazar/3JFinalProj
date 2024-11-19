<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellness Center - Your Journey Starts Here</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Manhattan Font -->
    <link href="https://fonts.cdnfonts.com/css/manhattan-darling" rel="stylesheet">



    <link rel="icon" type="image/png" href="images/logo_favicon.png">
    <!-- For Apple devices -->
    <link rel="apple-touch-icon" href="images/logo_favicon.png">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Serenity Spa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="booking.php">Book Now</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="overlay"></div>
        <div class="container position-relative">
            <div class="row min-vh-75 align-items-center justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        <!-- Website Title and desc: We can change this. -->
                        <h1 class="mb-4 text-white">Your Wellness Journey Starts Here</h1>
                        <p class="lead text-white mb-5">Experience tranquility and rejuvenation with our premium wellness services. Let our expert therapists guide you to ultimate relaxation.</p>
                        <div class="hero-buttons">
                            <a href="booking.php" class="btn btn-primary btn-lg me-3">Book Now</a>
                            <a href="services.php" class="btn btn-outline-light btn-lg">View Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Overview -->
    <section class="services-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">What we offer</h2>
            <div class="carousel-container">
                <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Service 1 -->
                        <div class="carousel-item active">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/6560304/pexels-photo-6560304.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Swedish Massage">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Swedish Massage</h5>
                                    <p class="card-text">A classic stress-relieving massage using smooth flowing techniques.</p>
                                    <p class="price">₱450</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Service 2 -->
                        <div class="carousel-item">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/275768/pexels-photo-275768.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Sports Massage">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Sports Massage</h5>
                                    <p class="card-text">Improve recovery and flexibility while reducing injury risks.</p>
                                    <p class="price">₱550</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Service 3 -->
                        <div class="carousel-item">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/6193357/pexels-photo-6193357.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Trigger Point Therapy">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Trigger Point Therapy</h5>
                                    <p class="card-text">Release bound muscles causing pain or decreased motion range.</p>
                                    <p class="price">₱600</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Service 4 -->
                        <div class="carousel-item">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/7365442/pexels-photo-7365442.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Couples Massage">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Couples Massage</h5>
                                    <p class="card-text">Share a relaxing experience with your loved one in our premium couples suite.</p>
                                    <p class="price">₱900</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Service 5 -->
                        <div class="carousel-item">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/10893352/pexels-photo-10893352.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Deep Tissue Massage">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Deep Tissue Massage</h5>
                                    <p class="card-text">Intense pressure targeting chronic muscle tension and knots.</p>
                                    <p class="price">₱650</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <!-- Service 6 -->
                        <div class="carousel-item">
                            <div class="card service-card">
                                <div class="card-img-wrapper">
                                    <img src="https://images.pexels.com/photos/4085448/pexels-photo-4085448.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="card-img-top" alt="Chair Massage">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Chair Massage</h5>
                                    <p class="card-text">Quick and effective relief for neck, shoulder, and back tension.</p>
                                    <p class="price">₱300</p>
                                    <a href="booking.php" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>

                        <!-- We can add more services here if we want to. -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">What Our Clients Say</h2>
            <div class="row">
                <!-- Testimonial 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.unsplash.com/photo-1480455624313-e29b44bbfde1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Drew Hays</h5>
                                <p class="card-text">"Amazing experience! The therapists are very professional."</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Sarah Johnson</h5>
                                <p class="card-text">"The deep tissue massage was exactly what I needed. Highly recommended!"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Michael Chen</h5>
                                <p class="card-text">"Regular sports massages have significantly improved my performance!"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 4 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.pexels.com/photos/12846223/pexels-photo-12846223.jpeg?auto=compress&cs=tinysrgb&w=600" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Maricel Santos</h5>
                                <p class="card-text">"Ang galing ng couples massage sis! Perfect para sa anniversary namin. Sobrang relaxing!"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 5 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.pexels.com/photos/3155723/pexels-photo-3155723.jpeg?auto=compress&cs=tinysrgb&w=600" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Jun Reyes</h5>
                                <p class="card-text">"Nawala ang chronic back pain ko. Salamat sa mga therapist, ang ganda ni ate kaya full five stars!"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 6 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.pexels.com/photos/4815216/pexels-photo-4815216.png?auto=compress&cs=tinysrgb&w=600" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Ana Dela Cruz</h5>
                                <p class="card-text">"Best spa sa area! Napaka-professional ng staff d tulad ng mga taga mcdo char. napaka-relaxing ng ambiance."</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 7 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.pexels.com/photos/3031774/pexels-photo-3031774.jpeg?auto=compress&cs=tinysrgb&w=600" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Paolo Mendoza</h5>
                                <p class="card-text">"Perfect ang chair massage para sa busy schedule ko. sana ibenta nila sakin to HAHAHAHA"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 8 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdNIrNbiiPAgB_-pD5W0mVgEN0kFSGxdfiHW_wF-iOLJWmCFyr6A6mMYjmUYWglMxifFc&usqp=CAU" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Bos sing Labn Kha</h5>
                                <p class="card-text">"Halluh!!!! infairness sya sis, super worth it, Grabe bhi, maganda....."</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 9 -->
                    <div class="col-md-4 mb-4">
                        <div class="card testimonial-card">
                            <div class="card-body text-center">
                                <img src="https://images.pexels.com/photos/5063434/pexels-photo-5063434.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="rounded-circle mb-3" alt="Client">
                                <h5 class="card-title">Yuki Tanaka</h5>
                                <p class="card-text">"とてもリラックスできました！スタッフの皆さんがとても親切で、マッサージも最高でした。また来ます！"</p>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- we can add more testimonials here -->
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <h2>Ready to Start Your Wellness Journey?</h2>
            <p class="lead">Join us today and experience the difference.</p>
            <a href="#" class="btn btn-primary btn-lg">Create Account</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-premium">
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <div class="footer-info">
                            <h3 class="brand-name">Serenity Spa</h3>
                            <p class="footer-desc">Where tranquility meets luxury. Experience the perfect blend of traditional techniques and modern wellness solutions.</p>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>123 Wellness Street, Metro Manila, Philippines</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>+63 912 345 6789</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@serenityspa.ph</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="col-lg-4">
                        <div class="quick-links">
                            <h4>Quick Links</h4>
                            <div class="links-grid">
                                <a href="#" class="link-item">
                                    <i class="fas fa-spa"></i>
                                    <span>Our Services</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Book Appointment</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-info-circle"></i>
                                    <span>About Us</span>
                                </a>
                                <a href="#" class="link-item">
                                    <i class="fas fa-gift"></i>
                                    <span>Gift Cards</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media & Newsletter -->
                    <div class="col-lg-4">
                        <div class="social-newsletter">
                            <h4>Connect With Us</h4>
                            <div class="social-links">
                                <a href="#" class="social-icon facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-icon instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="social-icon twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-icon tiktok">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                            </div>
                            <div class="newsletter-signup">
                                <h5>Subscribe to Our Newsletter</h5>
                                <form class="newsletter-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright">© 2024 Serenity Spa. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-links">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms of Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/navigation.js"></script>
</body>
</html>