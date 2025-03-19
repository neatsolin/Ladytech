<style>
    /* General Styles */
body {
    background-color: #f5f7fa;
    font-family: 'Poppins', sans-serif;
}



/* Contact Hero */
.contact-hero {
    background-color: #e6f0fa;
    position: relative;
    overflow: hidden;
    height: 50vh;
}

.contact-hero::before,
.contact-hero::after {
    content: '';
    position: absolute;
    top: 30px;
    width: 100px;
    height: 40px;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 40" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="10 10 20 20 10 30" /><polyline points="30 10 40 20 30 30" /><polyline points="50 10 60 20 50 30" /><polyline points="70 10 80 20 70 30" /><polyline points="90 10 100 20 90 30" /></svg>') no-repeat center;
    background-size: 100px 40px;
    color: #2a5d67;
    opacity: 0.3;
}

.contact-hero::before {
    left: 20px;
    transform: rotate(180deg);
}

.contact-hero::after {
    right: 20px;
}
/* Cards */
.card {
    border: none;
    border-radius: 15px;
    background-color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
}

/* Contact Form and Newsletter */
.form-control {
    border-radius: 10px;
    border: 1px solid #d3e3f5;
    padding: 12px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #2a5d67;
    box-shadow: 0 0 5px rgba(42, 93, 103, 0.2);
}

.bg-primary {
    background-color: #2a5d67 !important;
}

.btn-primary {
    background-color: #2a5d67;
    border-color: #2a5d67;
    border-radius: 10px;
    padding: 12px;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #1e4a52;
    border-color: #1e4a52;
}

.btn-light {
    color: #2a5d67;
    border-radius: 10px;
    padding: 12px;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.btn-light:hover {
    background-color: #e6f0fa;
    color: #1e4a52;
}

/* Contact Info */
.card i {
    color: #2a5d67;
}

.card h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
}

.card p {
    font-size: 1rem;
}


</style>
<!-- Contact Section -->
<section class="contact-hero text-center py-5">
    <div class="container position-relative">
        <h1 class="contact-title">Contact Us</h1>
        <p class="text-muted mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus.</p>
    </div>
</section>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card shadow p-4">
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" placeholder="Message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Button</button>
                    </form>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4">
                <div class="card shadow p-4 bg-primary text-white">
                    <h3>Our Newsletters</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus.</p>
                    <form>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" required>
                        </div>
                        <button type="submit" class="btn btn-light w-100">Submit Button</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="row g-4 mt-4">
            <div class="col-md-4">
                <div class="card shadow p-4 text-center">
                    <i class="fas fa-phone-alt fa-2x mb-3 text-primary"></i>
                    <h4>Phone</h4>
                    <p class="text-muted">(+876) 765 8655</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-4 text-center">
                    <i class="fas fa-envelope fa-2x mb-3 text-primary"></i>
                    <h4>Email</h4>
                    <p class="text-muted">mail@influenca.id</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow p-4 text-center">
                    <i class="fas fa-map-marker-alt fa-2x mb-3 text-primary"></i>
                    <h4>Location</h4>
                    <p class="text-muted">London Eye, London</p>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="mt-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d177.90098256678544!2d104.8839998305882!3d11.551413456930975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3109517421cddbed%3A0xe41287992a21179a!2sPiphup%20Sokhapheap%20Pharmacy!5e1!3m2!1sen!2skh!4v1742386469702!5m2!1sen!2skh" width="1100" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </main>

    