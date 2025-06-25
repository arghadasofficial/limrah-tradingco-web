<footer class="bg-black text-white pt-5 pb-4">
    <div class="container">
        <div class="row g-4">

            <!-- Logo & About -->
            <div class="col-md-4">
                <img src="assets/images/limrah.png" alt="Limrah Logo" style="height: 60px;" class="mb-3">
                <p class="text-secondary small">
                    <strong>Limrah Trading Co.</strong><br>
                    Your trusted partner in sustainable exports—bridging India to the world with quality and commitment.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4">
                <h6 class="fw-bold mb-3 text-uppercase text-warning">Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="#heroCarousel" class="text-secondary text-decoration-none d-block py-1">🏠 Home</a></li>
                    <li><a href="#about" class="text-secondary text-decoration-none d-block py-1">👤 Who We Are</a></li>
                    <li><a href="#company-brief" class="text-secondary text-decoration-none d-block py-1">📄 Company Profile</a></li>
                    <li><a href="#products" class="text-secondary text-decoration-none d-block py-1">📦 Our Products</a></li>
                    <li><a href="#reviews" class="text-secondary text-decoration-none d-block py-1">🌟 Testimonials</a></li>
                    <li><a href="#contact" class="text-secondary text-decoration-none d-block py-1">📬 Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4">
                <h6 class="fw-bold mb-3 text-uppercase text-warning">Get In Touch</h6>
                <p class="small mb-2">
                    <i class="fas fa-phone-alt me-2 text-warning"></i>
                    <span class="text-secondary">+91-9932608044 / +91-7364920500</span>
                </p>
                <p class="small mb-2">
                    <i class="fas fa-envelope me-2 text-warning"></i>
                    <span class="text-secondary">limrahtradingco@gmail.com</span>
                </p>
                <p class="small mb-2">
                    <i class="fas fa-envelope me-2 text-warning"></i>
                    <span class="text-secondary">support@limrahtrading.com</span>
                </p>
                <p class="small mb-2">
                    <i class="fas fa-map-marker-alt me-2 text-warning"></i>
                    <span class="text-secondary">Mill Chowpathi, Gopal Bagan, Alipurduar, WB 735213</span>
                </p>
                <!-- <div class="mt-3">
                    <a href="#" class="text-secondary me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary me-3"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-secondary"><i class="fab fa-whatsapp"></i></a>
                </div> -->
            </div>

        </div>

        <!-- Divider -->
        <hr class="border-secondary my-4">

        <!-- Bottom line -->
        <div class="text-center small text-secondary">
            &copy; <?= date('Y') ?> <span class="text-light">Limrah Trading Co.</span> • All rights reserved.
        </div>
    </div>
</footer>


<!-- Bootstrap 5 JS (Popper + Bootstrap Bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
    const swiper = new Swiper(".swiper-reviews", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        breakpoints: {
            768: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            }
        }
    });
</script>

<script>
    document.getElementById('queryForm').addEventListener('submit', function(e) {
        e.preventDefault(); // prevent default form submission

        const form = e.target;
        const formData = new FormData(form);

        fetch('utils/form-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertBox = document.createElement('div');
                alertBox.className = `alert alert-${data.status === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
                alertBox.role = 'alert';
                alertBox.innerHTML = `
      ${data.message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

                form.prepend(alertBox);

                if (data.status === 'success') {
                    form.reset();
                }
            })
            .catch(error => {
                alert('An unexpected error occurred. Please try again.');
                console.error(error);
            });
    });
</script>


<a href="#heroCarousel" class="scroll-top-btn position-fixed text-warning bg-dark rounded-circle shadow"
   style="bottom: 20px; right: 20px; width: 45px; height: 45px; display: none; z-index: 1000; align-items: center; justify-content: center; text-align: center;">
    <i class="fas fa-arrow-up"></i>
</a>

<script>
    const scrollBtn = document.querySelector('.scroll-top-btn');
    const triggerSection = document.querySelector('#products'); // section after which button should show

    window.addEventListener('scroll', () => {
        const triggerTop = triggerSection.getBoundingClientRect().top;
        const viewportHeight = window.innerHeight;

        if (triggerTop < viewportHeight - 100) {
            scrollBtn.style.display = 'flex';
        } else {
            scrollBtn.style.display = 'none';
        }
    });

    scrollBtn.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('#heroCarousel')?.scrollIntoView({ behavior: 'smooth' });
    });
</script>


</body>

</html>