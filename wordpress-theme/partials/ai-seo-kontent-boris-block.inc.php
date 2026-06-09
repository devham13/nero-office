<section id="ai-seo-kontent-boris-block" class="bas-root" aria-label="Анимация: кластеризация семантики Wordstat и сборка SEO-страниц">
<style>
/* === БОРИС: prefix bas-, scoped внутри #ai-seo-kontent-boris-block === */
#ai-seo-kontent-boris-block.bas-root{padding:56px 0 64px;background:#f0f4fb}
#ai-seo-kontent-boris-block .bas-cnt{max-width:1160px;margin:0 auto;padding:0 24px}
#ai-seo-kontent-boris-block .bas-card{
  display:grid;grid-template-columns:minmax(0,42%) minmax(0,58%);
  border-radius:22px;overflow:hidden;background:#fff;
  box-shadow:0 10px 40px rgba(15,23,42,.08),0 0 0 1px rgba(148,163,184,.18);
  min-height:480px;
}
@media(max-width:1023px){
  #ai-seo-kontent-boris-block .bas-card{grid-template-columns:1fr;min-height:auto}
}
#ai-seo-kontent-boris-block .bas-lft{
  padding:40px 36px;display:flex;flex-direction:column;justify-content:center;
  border-right:1px solid #e2e8f0;
}
@media(max-width:1023px){
  #ai-seo-kontent-boris-block .bas-lft{border-right:none;border-bottom:1px solid #e2e8f0;padding:32px 24px}
}
#ai-seo-kontent-boris-block .bas-ey{
  display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;
  letter-spacing:.12em;text-transform:uppercase;color:#0ea5e9;margin:0 0 14px;
}
#ai-seo-kontent-boris-block .bas-ey::before{content:'';width:18px;height:2px;background:#0ea5e9;border-radius:1px}
#ai-seo-kontent-boris-block .bas-h3{font-size:clamp(20px,2.4vw,26px);font-weight:800;color:#0f172a;line-height:1.28;margin:0 0 18px}
#ai-seo-kontent-boris-block .bas-ul{list-style:none;margin:0 0 22px;padding:0;display:flex;flex-direction:column;gap:9px}
#ai-seo-kontent-boris-block .bas-ul li{display:flex;align-items:flex-start;gap:10px;font-size:14px;line-height:1.5;color:#334155}
#ai-seo-kontent-boris-block .bas-ic{
  flex-shrink:0;width:22px;height:22px;border-radius:50%;background:rgba(14,165,233,.1);
  display:flex;align-items:center;justify-content:center;font-size:11px;color:#0284c7;margin-top:1px;font-style:normal;
}
#ai-seo-kontent-boris-block .bas-pills{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px}
#ai-seo-kontent-boris-block .bas-pl{padding:5px 12px;border-radius:99px;font-size:12px;font-weight:700;white-space:nowrap}
#ai-seo-kontent-boris-block .bas-pl-c{background:rgba(14,165,233,.08);color:#0369a1;border:1.5px solid rgba(14,165,233,.22)}
#ai-seo-kontent-boris-block .bas-pl-v{background:rgba(139,92,246,.08);color:#6d28d9;border:1.5px solid rgba(139,92,246,.22)}
#ai-seo-kontent-boris-block .bas-pl-g{background:rgba(34,197,94,.08);color:#15803d;border:1.5px solid rgba(34,197,94,.22)}
#ai-seo-kontent-boris-block .bas-foot{font-size:13px;color:#64748b;font-style:italic;margin:0}
#ai-seo-kontent-boris-block .bas-rgt{
  position:relative;background:linear-gradient(145deg,#07091a 0%,#0d1224 55%,#090d1f 100%);
  min-height:420px;overflow:hidden;
}
@media(max-width:1023px){#ai-seo-kontent-boris-block .bas-rgt{min-height:360px}}
#bas-seo-cluster-canvas{position:absolute;inset:0;width:100%;height:100%;display:block}
</style>

<div class="bas-cnt">
  <div class="bas-card">
    <div class="bas-lft">
      <span class="bas-ey">Кластеризация в действии</span>
      <h3 class="bas-h3">Из сотен ключей Wordstat — карта кластеров и типы страниц за минуты</h3>
      <ul class="bas-ul">
        <li><span class="bas-ic">◎</span>Ключи сгруппированы по смыслу и интенту: информационный, коммерческий, FAQ</li>
        <li><span class="bas-ic">▣</span>Каждому кластеру назначен тип: статья, лендинг, хаб или FAQ-блок</li>
        <li><span class="bas-ic">⇄</span>Hub-and-spoke: коммерческие хабы связаны со статьями и НЧ-вопросами</li>
        <li><span class="bas-ic">✓</span>SEO-специалист утверждает приоритеты — агент обрабатывает объёмы</li>
      </ul>
      <div class="bas-pills">
        <span class="bas-pl bas-pl-c">10 мин → ~1 мин / кластер</span>
        <span class="bas-pl bas-pl-v">эмбеддинги + LLM</span>
        <span class="bas-pl bas-pl-g">human-in-the-loop</span>
      </div>
      <p class="bas-foot">Дальше — 6 шагов конвейера от генерации до публикации →</p>
    </div>
    <div class="bas-rgt">
      <canvas
        id="bas-seo-cluster-canvas"
        aria-label="Анимация: ключевые слова Wordstat группируются в кластеры и превращаются в статьи, лендинги и FAQ"
        role="img"
      ></canvas>
    </div>
  </div>
</div>

<script>
(function(){
  'use strict';
  var cv = document.getElementById('bas-seo-cluster-canvas');
  if (!cv) return;
  var ctx = cv.getContext('2d');
  var W = 0, H = 0, frame = 0;

  function resize(){
    var p = cv.parentElement;
    if (!p) return;
    cv.width = p.clientWidth || 640;
    cv.height = p.clientHeight || 480;
    W = cv.width; H = cv.height;
  }
  window.addEventListener('resize', resize);
  resize();

  var C = {
    cyan:'#79f2ff', violet:'#8b5cf6', green:'#22c55e',
    text:'#e2e8f0', muted:'rgba(226,232,240,.45)',
    card:'rgba(255,255,255,.065)', bdr:'rgba(255,255,255,.12)',
    word:'#cbd5e1', line:'rgba(121,242,255,.25)'
  };

  var CLUSTERS = [
    {label:'Коммерция', color:C.violet, x:0.72, y:0.28, pages:['Лендинг','Оффер']},
    {label:'Инфо', color:C.cyan, x:0.78, y:0.52, pages:['Статья','Гайд']},
    {label:'FAQ', color:C.green, x:0.68, y:0.76, pages:['FAQ','Schema']}
  ];

  var WORDS = [
    {t:'ai seo', phase:0},{t:'контент', phase:1.2},{t:'wordstat', phase:2.4},
    {t:'кластер', phase:0.8},{t:'лендинг', phase:3.1},{t:'нейросеть', phase:1.9},
    {t:'seo статья', phase:2.7},{t:'под ключ', phase:0.3},{t:'семантика', phase:3.8}
  ];

  function rr(x,y,w,h,r,fill,stroke,lw){
    ctx.beginPath();
    if(ctx.roundRect) ctx.roundRect(x,y,w,h,r);
    else { ctx.moveTo(x+r,y); ctx.arcTo(x+w,y,x+w,y+h,r); ctx.arcTo(x+w,y+h,x,y+h,r); ctx.arcTo(x,y+h,x,y,r); ctx.arcTo(x,y,x+w,y,r); ctx.closePath(); }
    if(fill){ ctx.fillStyle=fill; ctx.fill(); }
    if(stroke){ ctx.strokeStyle=stroke; ctx.lineWidth=lw||1.5; ctx.stroke(); }
  }

  function draw(){
    frame++;
    ctx.clearRect(0,0,W,H);

    ctx.fillStyle=C.text;
    ctx.font='bold 12px Inter,system-ui,sans-serif';
    ctx.textAlign='left';
    ctx.fillText('Wordstat → AI-кластеризатор → типы страниц', 16, 24);

    var srcX = W * 0.14, srcY = H * 0.5, hubX = W * 0.42, hubY = H * 0.5;

    rr(srcX-54, srcY-70, 108, 140, 12, C.card, C.bdr);
    ctx.fillStyle=C.cyan;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.textAlign='center';
    ctx.fillText('Wordstat', srcX, srcY - 48);
    ctx.fillStyle=C.muted;
    ctx.font='10px Inter,system-ui,sans-serif';
    for(var i=0;i<4;i++){
      ctx.fillText(['ai seo','нейросеть','лендинг','семантика'][i], srcX, srcY - 28 + i*18);
    }

    var pulse = 0.5 + 0.5*Math.sin(frame*0.06);
    rr(hubX-48, hubY-48, 96, 96, 48, 'rgba(139,92,246,'+(0.12+pulse*0.08)+')', 'rgba(139,92,246,.45)', 2);
    ctx.fillStyle=C.violet;
    ctx.font='bold 11px Inter,system-ui,sans-serif';
    ctx.fillText('AI', hubX, hubY - 4);
    ctx.fillStyle=C.muted;
    ctx.font='9px Inter,system-ui,sans-serif';
    ctx.fillText('кластер', hubX, hubY + 10);

    WORDS.forEach(function(w, idx){
      var t = (frame*0.018 + w.phase) % 6;
      if(t > 4.2) return;
      var prog = t / 4.2;
      var x = srcX + (hubX - srcX) * prog + Math.sin(frame*0.04 + idx)*6;
      var y = srcY - 20 + idx*6 + Math.cos(frame*0.05 + w.phase)*8;
      ctx.fillStyle='rgba(121,242,255,'+(0.35+prog*0.5)+')';
      ctx.font='9px Inter,system-ui,sans-serif';
      ctx.textAlign='center';
      ctx.fillText(w.t, x, y);
    });

    CLUSTERS.forEach(function(cl, ci){
      var tx = W * cl.x, ty = H * cl.y;
      ctx.strokeStyle = cl.color + '55';
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4,6]);
      ctx.beginPath();
      ctx.moveTo(hubX+40, hubY);
      ctx.quadraticCurveTo(hubX+80, hubY + (ty-hubY)*0.3, tx-50, ty);
      ctx.stroke();
      ctx.setLineDash([]);

      rr(tx-58, ty-36, 116, 72, 10, C.card, cl.color+'66', 1.5);
      ctx.fillStyle=cl.color;
      ctx.font='bold 10px Inter,system-ui,sans-serif';
      ctx.textAlign='left';
      ctx.fillText(cl.label, tx-48, ty-18);
      ctx.fillStyle=C.muted;
      ctx.font='9px Inter,system-ui,sans-serif';
      ctx.fillText(cl.pages.join(' · '), tx-48, ty-2);

      var bounce = Math.sin(frame*0.05 + ci)*2;
      rr(tx-48, ty+12+bounce, 40, 14, 4, 'rgba(34,197,94,.15)', C.green+'55');
      ctx.fillStyle=C.green;
      ctx.font='8px Inter,system-ui,sans-serif';
      ctx.fillText('в очереди', tx-42, ty+22+bounce);
    });

    requestAnimationFrame(draw);
  }
  draw();
})();
</script>
</section>
