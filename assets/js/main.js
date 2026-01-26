// ==== LOAD PARTIALS (NAVBAR + FOOTER) ====
async function loadPartial(id, url) {
  const container = document.getElementById(id);
  if (!container) return;
  try {
    const res = await fetch(url);
    container.innerHTML = await res.text();
  } catch (err) {
    console.error(`Error loading partial ${url}:`, err);
  }
}

// ==== NAVBAR BEHAVIOR ====
function initNavbarFeatures() {
  const navbar = document.querySelector('.navbar-custom');
  if (!navbar) return;

  // Shrink khi scroll
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.classList.add('navbar-scrolled');
    } else {
      navbar.classList.remove('navbar-scrolled');
    }
  });

  // Smooth scroll cho link nội bộ (trên trang có section)
  document
    .querySelectorAll('a.nav-link[href^="#"], a.nav-cta[href^="#"]')
    .forEach(link => {
      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const offset = 80; // chiều cao navbar
          const y = target.getBoundingClientRect().top + window.scrollY - offset;
          window.scrollTo({ top: y, behavior: 'smooth' });

          const navbarCollapse = document.querySelector('#mainNavbar');
          if (navbarCollapse && navbarCollapse.classList.contains('show')) {
            new bootstrap.Collapse(navbarCollapse).toggle();
          }
        }
      });
    });

  // Scroll spy (active nav-link theo section)
  const sections = Array.from(document.querySelectorAll('section[id]'));
  const navLinks = Array.from(
    document.querySelectorAll('.navbar .nav-link[href^="#"]')
  );

  function updateActiveNav() {
    if (!sections.length || !navLinks.length) return;

    const scrollPosition = window.scrollY + 120; // bù chiều cao navbar
    let currentId = null;

    for (const sec of sections) {
      if (scrollPosition >= sec.offsetTop) {
        currentId = sec.id;
      }
    }

    navLinks.forEach(link => {
      const href = link.getAttribute('href').replace('#', '');
      if (href === currentId) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  window.addEventListener('scroll', updateActiveNav);
  window.addEventListener('load', updateActiveNav);
  updateActiveNav();
}

// ==== COUNTER NUMBER ====
function initCounters() {
  const counters = document.querySelectorAll('.counter');
  if (!counters.length) return;

  const runCounter = (entry) => {
    const el = entry.target;
    const target = +el.dataset.target;
    const step = Math.max(1, Math.floor(target / 80));
    let current = 0;
    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      el.textContent = current + (target >= 100 ? '+' : '');
    }, 20);
  };

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting && !e.target.classList.contains('counted')) {
        e.target.classList.add('counted');
        runCounter(e);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(c => counterObserver.observe(c));
}

// ==== REVEAL ON SCROLL ====
function initReveal() {
  const revealEls = document.querySelectorAll('.reveal-on-scroll');
  if (!revealEls.length) return;

  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('reveal-visible');
        revealObserver.unobserve(e.target);
      }
    });
  }, { threshold: 0.15 });

  revealEls.forEach(el => revealObserver.observe(el));
}
// ==== CLICK VÀO STATS ĐỂ SCROLL XUỐNG SECTION ====
function initStatClicks() {
  const items = document.querySelectorAll('.stat-item[data-scroll-target]');
  if (!items.length) return;

  items.forEach(item => {
    item.addEventListener('click', () => {
      const targetSelector = item.getAttribute('data-scroll-target');
      const target = document.querySelector(targetSelector);
      if (!target) return;

      const offset = 80; // bù chiều cao navbar
      const y = target.getBoundingClientRect().top + window.scrollY - offset;
      window.scrollTo({ top: y, behavior: 'smooth' });
    });
  });
}

// ==== BOOTSTRAP TOÀN SITE ====
document.addEventListener('DOMContentLoaded', async () => {
  // 1. Load navbar + footer từ partials
  await Promise.all([
    loadPartial('navbar-placeholder', 'partials/navbar.html'),
    loadPartial('footer-placeholder', 'partials/footer.html')
  ]);

  // ==== PROCESS TIMELINE ANIMATION ====
function initProcessTimeline() {
  const steps = document.querySelectorAll('.process-item');
  if (!steps.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('process-visible'); // bật glow
          observer.unobserve(entry.target); // chỉ animate 1 lần
        }
      });
    },
    { threshold: 0.45 }
  );

  steps.forEach((step) => observer.observe(step));
}
// ===== WHY CHOOSE SLIDER (DRAG + BUTTON SCROLL) =====
(function () {
  const slider = document.getElementById("whySlider");
  if (!slider) return;

  const prevBtn = document.querySelector(".why-prev");
  const nextBtn = document.querySelector(".why-next");

  // Scroll theo kích thước 1 card
  const getStep = () => {
    const card = slider.querySelector(".why-card");
    if (!card) return 280;
    const style = window.getComputedStyle(card);
    const gap = parseFloat(style.marginRight || 16);
    return card.offsetWidth + gap;
  };

  prevBtn?.addEventListener("click", () => {
    slider.scrollBy({ left: -getStep(), behavior: "smooth" });
  });

  nextBtn?.addEventListener("click", () => {
    slider.scrollBy({ left: getStep(), behavior: "smooth" });
  });

  // Drag bằng chuột / cảm ứng
  let isDown = false;
  let startX;
  let scrollLeft;

  const startDrag = (pageX) => {
    isDown = true;
    slider.classList.add("dragging");
    startX = pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  };

  const moveDrag = (pageX, e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = pageX - slider.offsetLeft;
    const walk = (x - startX) * 0.1; // tốc độ kéo
    slider.scrollLeft = scrollLeft - walk;
  };

  const endDrag = () => {
    isDown = false;
    slider.classList.remove("dragging");
  };

  // Mouse
  slider.addEventListener("mousedown", (e) => startDrag(e.pageX));
  slider.addEventListener("mousemove", (e) => moveDrag(e.pageX, e));
  slider.addEventListener("mouseleave", endDrag);
  slider.addEventListener("mouseup", endDrag);

  // Touch
  slider.addEventListener("touchstart", (e) =>
    startDrag(e.touches[0].pageX)
  );
  slider.addEventListener("touchmove", (e) =>
    moveDrag(e.touches[0].pageX, e)
  );
  slider.addEventListener("touchend", endDrag);
})();


  // 2. Init navbar (sau khi partial đã được inject)
  initNavbarFeatures();

  // 3. Init các hiệu ứng chung
  initCounters();
  initReveal();
  initStatClicks();
  initProcessTimeline();
});
