<!-- resources/views/footer.blade.php -->
<div style="margin-top: 30px">
<div class="footer">
    <p class="copyright">
        Copyright 2024 <a href="{{ url('/') }}"><span style="color: rgb(255, 215, 0)">Rumbble (Hottcart Ecommerce Pvt. Ltd)</span></a>. All Rights Reserved
    </p>
    <div class="footerNav">
        <p><a href="{{ url('/') }}">Home</a></p>
        <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></p>
        <p><a href="{{ url('/terms-conditions') }}">Terms & Conditions</a></p>
        <p><a href="{{ url('/return-policy') }}">Return Policy</a></p>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <!-- Add this script to handle the navbar collapse -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            navbarToggler.addEventListener('click', function () {
                navbarCollapse.classList.toggle('show');
            });
                 // Highlight the active link
            const navLinks = document.querySelectorAll('.nav-link');
            //const currentPath = window.location.pathname.split('/').pop();
            const currentPath = window.location.pathname.split('/').pop() || 'home';


            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
          
        });
    </script>