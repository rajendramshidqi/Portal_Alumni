<style>
  /* Footer Background */
.site-footer {
  background: linear-gradient(135deg, #0f172a, #1e293b);
  color: #cbd5e1;
  padding: 60px 0 20px;
}

/* Heading */
.footer-heading {
  color: #fff;
  font-size: 18px;
  margin-bottom: 20px;
  font-weight: 700;
}

/* Text */
.footer-text {
  font-size: 14px;
  line-height: 1.7;
}

/* Links */
.footer-links {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 10px;
  font-size: 14px;
}

.footer-links a {
  color: #cbd5e1;
  text-decoration: none;
  transition: 0.3s;
}

.footer-links a:hover {
  color: #38bdf8;
  padding-left: 5px;
}

/* Newsletter */
.input-newsletter {
  background: transparent;
  border: 1px solid #475569;
  color: #fff;
  border-radius: 20px 0 0 20px;
  padding: 10px;
}

.input-newsletter::placeholder {
  color: #94a3b8;
}

.btn-send {
  background: linear-gradient(45deg, #0ea5e9, #6366f1);
  border: none;
  color: #fff;
  padding: 10px 18px;
  border-radius: 0 20px 20px 0;
  transition: 0.3s;
}

.btn-send:hover {
  transform: scale(1.05);
}

/* Social */
.social-icons a {
  display: inline-block;
  margin-right: 10px;
  font-size: 18px;
  color: #cbd5e1;
  transition: 0.3s;
}

.social-icons a:hover {
  color: #38bdf8;
  transform: translateY(-3px);
}

/* Bottom */
.footer-bottom {
  border-top: 1px solid #334155;
  margin-top: 40px;
  padding-top: 20px;
  font-size: 14px;
}
</style>

<footer class="site-footer">
  <div class="container">

    <div class="row">

      <!-- ABOUT -->
      <div class="col-lg-4 mb-4">
        <h2 class="footer-heading">🎓 AlumniHub</h2>
        <p class="footer-text">
          Platform untuk menghubungkan alumni, berbagi informasi lowongan kerja,
          dan berdiskusi dalam forum komunitas yang aktif dan inspiratif.
        </p>
      </div>

      <!-- QUICK LINKS -->
      <div class="col-lg-2 mb-4">
        <h2 class="footer-heading">Menu</h2>
        <ul class="footer-links">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ route('lowongan.index') }}">Loker</a></li>
          <li><a href="{{ route('forums.index') }}">Forum</a></li>
        </ul>
      </div>

      <!-- CONTACT -->
      <div class="col-lg-3 mb-4">
        <h2 class="footer-heading">Kontak</h2>
        <ul class="footer-links">
          <li>Email: alumni@gmail.com</li>
          <li>Phone: +62 812 3456 7890</li>
          <li>Bandung, Indonesia</li>
        </ul>
      </div>

      <!-- NEWSLETTER -->
      <div class="col-lg-3 mb-4">
        <h2 class="footer-heading">Newsletter</h2>
        <p class="footer-text">Dapatkan info terbaru langsung ke email kamu.</p>

        <form class="footer-subscribe">
          <div class="input-group">
            <input type="email" class="form-control input-newsletter" placeholder="Email kamu">
            <div class="input-group-append">
              <button class="btn-send">Kirim</button>
            </div>
          </div>
        </form>

        <!-- SOCIAL -->
        <div class="social-icons mt-3">
          <a href="#"><span class="icon-facebook"></span></a>
          <a href="#"><span class="icon-twitter"></span></a>
          <a href="#"><span class="icon-instagram"></span></a>
          <a href="#"><span class="icon-linkedin"></span></a>
        </div>
      </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="footer-bottom text-center">
      <p>
        © <script>document.write(new Date().getFullYear());</script> AlumniHub.
        All rights reserved.
      </p>
    </div>

  </div>
</footer>