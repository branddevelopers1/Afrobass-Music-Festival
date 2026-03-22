/* ============================================================
   AFROBASS MUSIC FESTIVAL — MAIN JS
   ============================================================ */
(function(){
  'use strict';

  /* ── CURSOR ── */
  const cur  = document.getElementById('fest-cursor');
  const ring = document.getElementById('fest-cursor-ring');
  if (cur && ring) {
    let mx=0,my=0,rx=0,ry=0;
    document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;});
    (function anim(){
      cur.style.left=mx+'px';cur.style.top=my+'px';
      rx+=(mx-rx)*.1;ry+=(my-ry)*.1;
      ring.style.left=rx+'px';ring.style.top=ry+'px';
      requestAnimationFrame(anim);
    })();
    document.querySelectorAll('a,button').forEach(el=>{
      el.addEventListener('mouseenter',()=>{
        cur.style.transform='translate(-50%,-50%) scale(2.5)';
        cur.style.background='rgba(255,45,138,0.6)';
        ring.style.transform='translate(-50%,-50%) scale(1.6)';
      });
      el.addEventListener('mouseleave',()=>{
        cur.style.transform='translate(-50%,-50%) scale(1)';
        cur.style.background='#FF2D8A';
        ring.style.transform='translate(-50%,-50%) scale(1)';
      });
    });
  }

  /* ── LOADER ── */
  const loader = document.getElementById('fest-loader');
  if (loader) {
    window.addEventListener('load',()=>{
      setTimeout(()=>{
        loader.classList.add('fest-hide');
        setTimeout(()=>loader.style.display='none',900);
      },2200);
    });
  }

  /* ── NAV SCROLL ── */
  const nav = document.getElementById('fest-nav');
  if (nav) {
    window.addEventListener('scroll',()=>{
      nav.classList.toggle('fest-scrolled', window.scrollY > 40);
    },{passive:true});
  }

  /* ── PARALLAX ── */
  window.addEventListener('scroll',()=>{
    const hero = document.querySelector('.fhero');
    if (hero) {
      const sy = window.scrollY;
      const ring = hero.querySelector('.fring');
      if (ring) ring.style.transform = `translate(-50%,-50%) rotate(${sy*0.02}deg) scale(${1+sy*0.0002})`;
    }
  },{passive:true});

  /* ── COUNTDOWN ── */
  function pad(n){return String(n).padStart(2,'0');}
  function tick(){
    const target=new Date('2026-08-15T20:00:00');
    const diff=target-new Date();
    if(diff<=0){['days','hours','mins','secs'].forEach(id=>{const el=document.getElementById('cd-'+id);if(el)el.textContent='00';});return;}
    const d=Math.floor(diff/86400000);
    const h=Math.floor((diff%86400000)/3600000);
    const m=Math.floor((diff%3600000)/60000);
    const s=Math.floor((diff%60000)/1000);
    function update(id,val){
      const el=document.getElementById('cd-'+id);
      if(!el)return;
      if(el.textContent!==val){
        el.textContent=val;
        el.classList.add('ftick');
        setTimeout(()=>el.classList.remove('ftick'),150);
      }
    }
    update('days',pad(d));
    update('hours',pad(h));
    update('mins',pad(m));
    update('secs',pad(s));
  }
  tick();setInterval(tick,1000);

  /* ── EMAIL CAPTURE ── */
  const form = document.getElementById('fest-capture-form');
  if (form) {
    form.addEventListener('submit',async function(e){
      e.preventDefault();
      const btn = form.querySelector('.fest-capture-submit');
      const msg = form.querySelector('.fest-form-msg');
      const email = form.querySelector('[name=email]').value;

      if (!email||!/\S+@\S+\.\S+/.test(email)){
        msg.className='fest-form-msg error';
        msg.textContent='Please enter a valid email address.';
        return;
      }
      if (form.querySelector('[name=website]') && form.querySelector('[name=website]').value) return;

      btn.textContent='Submitting...';btn.disabled=true;

      try {
        if (typeof festAjax!=='undefined') {
          const data=new FormData(form);
          data.append('action','fest_email_capture');
          data.append('nonce',festAjax.nonce);
          const res=await fetch(festAjax.ajaxurl,{method:'POST',body:data});
          const json=await res.json();
          msg.className='fest-form-msg '+(json.success?'success':'error');
          msg.textContent=json.data;
          if(json.success)form.reset();
        } else {
          msg.className='fest-form-msg success';
          msg.textContent="You're on the list! We'll notify you when tickets drop. 🔥";
          form.reset();
        }
      } catch {
        msg.className='fest-form-msg error';
        msg.textContent='Something went wrong. DM us @afrobass on Instagram.';
      }
      btn.textContent='Notify Me When Tickets Drop →';
      btn.disabled=false;
    });
  }

  /* ── SMOOTH SCROLL ── */
  document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener('click',e=>{
      const t=document.querySelector(a.getAttribute('href'));
      if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth'});}
    });
  });

})();
