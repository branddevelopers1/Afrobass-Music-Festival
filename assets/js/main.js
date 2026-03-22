/* ============================================================
   AFROBASS MUSIC FESTIVAL — MAIN JS
   ============================================================ */

(function () {
  'use strict';

  /* ─── CURSOR ─── */
  const cursor = document.getElementById('fest-cursor');
  const ring   = document.getElementById('fest-cursor-ring');
  if (cursor && ring) {
    let mx = 0, my = 0, rx = 0, ry = 0;
    document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
    (function anim() {
      cursor.style.left = mx + 'px'; cursor.style.top = my + 'px';
      rx += (mx - rx) * 0.12; ry += (my - ry) * 0.12;
      ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
      requestAnimationFrame(anim);
    })();
    document.querySelectorAll('a, button, .fest-artist-card, .fest-ticket-tier').forEach(el => {
      el.addEventListener('mouseenter', () => {
        cursor.style.transform = 'translate(-50%,-50%) scale(2.2)';
        cursor.style.background = 'rgba(255,69,0,0.5)';
        ring.style.transform = 'translate(-50%,-50%) scale(1.5)';
      });
      el.addEventListener('mouseleave', () => {
        cursor.style.transform = 'translate(-50%,-50%) scale(1)';
        cursor.style.background = '#FF4500';
        ring.style.transform = 'translate(-50%,-50%) scale(1)';
      });
    });
  }

  /* ─── LOADER ─── */
  const loader = document.getElementById('fest-loader');
  if (loader) {
    window.addEventListener('load', () => {
      setTimeout(() => {
        loader.classList.add('fest-hide');
        setTimeout(() => loader.style.display = 'none', 900);
      }, 2200);
    });
  }

  /* ─── NAV SCROLL ─── */
  const nav = document.getElementById('fest-nav');
  if (nav) {
    window.addEventListener('scroll', () => {
      nav.classList.toggle('fest-scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ─── MOBILE NAV ─── */
  const burger = document.querySelector('.fest-hamburger');
  const mobNav = document.getElementById('fest-mobile-nav');
  if (burger && mobNav) {
    burger.addEventListener('click', () => {
      burger.classList.toggle('open');
      mobNav.classList.toggle('open');
      document.body.style.overflow = mobNav.classList.contains('open') ? 'hidden' : '';
    });
    mobNav.querySelectorAll('a').forEach(a => {
      a.addEventListener('click', () => {
        burger.classList.remove('open');
        mobNav.classList.remove('open');
        document.body.style.overflow = '';
      });
    });
  }

  /* ─── PARALLAX HERO ─── */
  const heroVideo = document.querySelector('.fest-cover-video');
  window.addEventListener('scroll', () => {
    if (heroVideo) heroVideo.style.transform = `scale(1.06) translateY(${window.scrollY * 0.2}px)`;
  }, { passive: true });

  /* ─── COUNTDOWN TIMER ─── */
  function updateCountdown() {
    const target = new Date('2026-08-15T20:00:00');
    const now    = new Date();
    const diff   = target - now;
    if (diff <= 0) {
      document.querySelectorAll('.fest-cd-num').forEach(el => el.textContent = '00');
      return;
    }
    const days  = Math.floor(diff / 86400000);
    const hours = Math.floor((diff % 86400000) / 3600000);
    const mins  = Math.floor((diff % 3600000) / 60000);
    const secs  = Math.floor((diff % 60000) / 1000);
    const pad   = n => String(n).padStart(2, '0');
    const el    = (id) => document.getElementById(id);
    if (el('cd-days'))  el('cd-days').textContent  = pad(days);
    if (el('cd-hours')) el('cd-hours').textContent = pad(hours);
    if (el('cd-mins'))  el('cd-mins').textContent  = pad(mins);
    if (el('cd-secs'))  el('cd-secs').textContent  = pad(secs);
  }
  updateCountdown();
  setInterval(updateCountdown, 1000);

  /* ─── REVEAL ON SCROLL ─── */
  const reveals = document.querySelectorAll('.fest-reveal');
  if (reveals.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
      });
    }, { threshold: 0.05 });
    reveals.forEach(el => obs.observe(el));
    setTimeout(() => {
      reveals.forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight) {
          el.classList.add('visible'); obs.unobserve(el);
        }
      });
    }, 100);
  }

  /* ─── EMAIL CAPTURE FORM ─── */
  const captureForm = document.getElementById('fest-capture-form');
  if (captureForm) {
    captureForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const btn = captureForm.querySelector('.fest-capture-submit');
      const msg = captureForm.querySelector('.fest-form-msg');
      btn.textContent = 'Submitting...';
      btn.disabled = true;

      const data = new FormData(captureForm);
      data.append('action', 'fest_email_capture');
      data.append('nonce', festAjax.nonce);

      try {
        const res  = await fetch(festAjax.ajaxurl, { method: 'POST', body: data });
        const json = await res.json();
        msg.className = 'fest-form-msg ' + (json.success ? 'success' : 'error');
        msg.textContent = json.data;
        if (json.success) captureForm.reset();
      } catch {
        msg.className = 'fest-form-msg error';
        msg.textContent = 'Something went wrong. Try again later.';
      }
      btn.textContent = 'Notify Me →';
      btn.disabled = false;
    });
  }

  /* ─── SMOOTH ANCHOR SCROLL ─── */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
  });

})();
