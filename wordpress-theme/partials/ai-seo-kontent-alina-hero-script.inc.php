<?php
/** Canvas engine hero Алины — aseo-factory-engine */
?>
<script>
/**
 * aseo-factory-engine — Редакционный семантический штаб
 * Мир: поток ключей → кластеры → сборка страницы → импульс индексации в CMS
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("aseo-factory-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;
  var bubbles = [];

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.12;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    keyNode: "#f8fafc",
    keyAccent: "#79f2ff",
    clusterGlow: "rgba(139,92,246,0.35)",
    hubBase: "#1e293b",
    hubCyan: "#79f2ff",
    hubGreen: "#22c55e",
    faqChip: "#fbcfe8",
    cmsBeacon: "#34d399",
    streamLine: "rgba(121,242,255,0.2)",
    agentYellow: "#eab308",
    agentGreen: "#10b981",
    agentBlue: "#3b82f6",
    agentPink: "#ec4899",
    agentPurple: "#8b5cf6",
    bubbleBg: "#0f172a",
    bubbleText: "#e2e8f0"
  };

  function drawRR(ctx, x, y, w, h, r, fill, stroke) {
    ctx.fillStyle = fill;
    ctx.beginPath();
    if (ctx.roundRect) ctx.roundRect(x, y, w, h, r);
    else ctx.rect(x, y, w, h);
    ctx.fill();
    if (stroke) {
      ctx.lineWidth = 1.5;
      ctx.strokeStyle = stroke;
      ctx.stroke();
    }
  }

  function createBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 90, max: 90 });
  }

  /* Дуговые лексические траектории — вместо Conveyor */
  function QueryStreamConduit() {
    this.phase = 0;
  }
  QueryStreamConduit.prototype.draw = function (ctx) {
    this.phase = (frame * 0.028) % (Math.PI * 2);
    var arcs = [
      { rx: 125, ry: 48, y: -18, dash: [5, 7] },
      { rx: 95, ry: 36, y: 8, dash: [4, 6] },
      { rx: 68, ry: 26, y: 28, dash: [3, 5] }
    ];
    arcs.forEach(function (a, idx) {
      ctx.save();
      ctx.strokeStyle = idx === 0 ? C.clusterGlow : C.streamLine;
      ctx.lineWidth = idx === 0 ? 2 : 1;
      ctx.setLineDash(a.dash);
      ctx.lineDashOffset = -frame * 0.35;
      ctx.beginPath();
      ctx.ellipse(0, a.y, a.rx, a.ry, 0, 0, Math.PI * 2);
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.restore();
    });

    var labels = ["seo", "лендинг", "faq", "кластер", "wordstat"];
    for (var i = 0; i < 6; i++) {
      var arc = arcs[i % 3];
      var t = (this.phase * (0.9 + i * 0.1) + i * 1.05) % (Math.PI * 2);
      var nx = Math.cos(t) * arc.rx;
      var ny = arc.y + Math.sin(t) * arc.ry;
      drawKeyNode(ctx, nx, ny, 11, C.keyNode, labels[i % labels.length]);
    }
  };

  function drawKeyNode(ctx, x, y, r, color, label) {
    ctx.save();
    ctx.translate(x, y);
    ctx.fillStyle = color;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.arc(0, 0, r, 0, Math.PI * 2);
    ctx.fill();
    ctx.stroke();
    if (label) {
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 6px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(label, 0, 3);
    }
    ctx.restore();
  }

  /* Шестигранный хаб сборки страниц — вместо WebsiteTerminal */
  function SemanticPublishCore() {
    this.cyclePrg = 0;
    this.indexPulse = 0;
  }
  SemanticPublishCore.prototype.draw = function (ctx) {
    this.cyclePrg = (frame * 0.038) % 260;
    this.indexPulse = 0;

    /* Wordstat-кристалл слева */
    ctx.save();
    ctx.translate(-115, -5);
    ctx.rotate(Math.sin(frame * 0.04) * 0.08);
    drawRR(ctx, -16, -22, 32, 44, 6, "rgba(121,242,255,0.15)", C.hubCyan);
    ctx.fillStyle = C.hubCyan;
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("WS", 0, 2);
    ctx.restore();

    /* Шестигранник — ядро */
    var hexR = 52;
    ctx.fillStyle = C.hubBase;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 2;
    ctx.beginPath();
    for (var h = 0; h < 6; h++) {
      var ang = (Math.PI / 3) * h - Math.PI / 6;
      var hx = Math.cos(ang) * hexR;
      var hy = Math.sin(ang) * hexR - 10;
      if (h === 0) ctx.moveTo(hx, hy);
      else ctx.lineTo(hx, hy);
    }
    ctx.closePath();
    ctx.fill();
    ctx.stroke();

    /* Фазы: CLUSTER → BLUEPRINT → COMPOSE → GUARD → INDEX */
    if (this.cyclePrg >= 40 && this.cyclePrg < 90) {
      /* CLUSTER — созвездие вокруг хаба */
      for (var c = 0; c < 5; c++) {
        var ca = frame * 0.05 + c * 1.2;
        var cr = 70 + Math.sin(frame * 0.06 + c) * 6;
        var cx2 = Math.cos(ca) * cr;
        var cy2 = Math.sin(ca) * cr * 0.55 - 10;
        ctx.fillStyle = "rgba(139,92,246," + (0.25 + Math.sin(frame * 0.1 + c) * 0.15) + ")";
        ctx.beginPath();
        ctx.arc(cx2, cy2, 5, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    if (this.cyclePrg >= 90 && this.cyclePrg < 140) {
      /* BLUEPRINT — карточка ТЗ */
      var by = -55 + Math.sin(frame * 0.08) * 3;
      drawRR(ctx, -34, by, 68, 38, 6, "rgba(255,255,255,0.92)", C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "left";
      ctx.fillText("H1 · title · desc", -28, by + 12);
      ctx.fillStyle = "#94a3b8";
      ctx.font = "6px Inter,sans-serif";
      ctx.fillText("H2/H3 · FAQ · Schema", -28, by + 24);
    }

    if (this.cyclePrg >= 140 && this.cyclePrg < 190) {
      /* COMPOSE — блоки контента */
      var blocks = ["Intro", "FAQ", "CTA"];
      blocks.forEach(function (b, i) {
        var bx = -38 + i * 26;
        var bh = 18 + (i % 2) * 6;
        drawRR(ctx, bx, 8, 22, bh, 4, i === 1 ? C.faqChip : "rgba(147,197,253,0.55)", C.outline);
        ctx.fillStyle = "#0f172a";
        ctx.font = "bold 6px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText(b, bx + 11, 8 + bh / 2 + 2);
      });
    }

    if (this.cyclePrg >= 190 && this.cyclePrg < 230) {
      /* GUARD — щит QA */
      ctx.strokeStyle = "rgba(34,197,94,0.7)";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -10, 38 + Math.sin(frame * 0.12) * 4, 0, Math.PI * 2);
      ctx.stroke();
      ctx.fillStyle = "#bbf7d0";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("QA ✓", 0, -6);
    }

    if (this.cyclePrg >= 230) {
      /* INDEX — импульс в CMS-маяк (не ракета) */
      var ip = Math.min(1, (this.cyclePrg - 230) / 28);
      this.indexPulse = ip;
      drawRR(ctx, -22, 18, 44, 28, 5, "rgba(34,197,94,0.28)", C.hubGreen);
      ctx.fillStyle = "#fff";
      ctx.font = "bold 8px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText("/page-live", 0, 34);

      /* Луч к CMS-маяку справа */
      ctx.strokeStyle = "rgba(52,211,153," + (0.9 - ip * 0.5) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.moveTo(22, 32);
      ctx.lineTo(22 + ip * 75, 32 - ip * 18);
      ctx.stroke();

      if (ip > 0.3 && ip < 0.85) {
        ctx.fillStyle = "rgba(52,211,153," + (0.35 - Math.abs(ip - 0.55) * 0.5) + ")";
        ctx.beginPath();
        ctx.arc(22 + ip * 75, 32 - ip * 18, 8 + ip * 12, 0, Math.PI * 2);
        ctx.fill();
      }
    }

    /* CMS-маяк */
    ctx.save();
    ctx.translate(108, 18);
    drawRR(ctx, -14, -18, 28, 36, 5, "rgba(6,10,24,0.9)", C.cmsBeacon);
    ctx.fillStyle = C.cmsBeacon;
    ctx.beginPath();
    ctx.moveTo(0, -28);
    ctx.lineTo(8, -12);
    ctx.lineTo(-8, -12);
    ctx.closePath();
    ctx.fill();
    if (this.indexPulse > 0.5) {
      ctx.strokeStyle = "rgba(52,211,153," + (this.indexPulse * 0.6) + ")";
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.arc(0, -4, 14 + this.indexPulse * 22, 0, Math.PI * 2);
      ctx.stroke();
    }
    ctx.restore();
  };

  function Agent(x, y, color, role, dialogs) {
    this.x = x;
    this.y = y;
    this.color = color;
    this.role = role;
    this.dialogs = dialogs;
    this.stepTrig = Math.random() * 200;
    this.dir = 1;
    this.bubbleTimer = 0;
  }
  Agent.prototype.draw = function (ctx) {
    var targets = {
      "1_architect": { x: -95, y: 35 },
      "2_seo": { x: -55, y: -55 },
      "3_coder": { x: 25, y: 45 },
      "4_designer": { x: 55, y: -40 },
      "5_deployer": { x: 100, y: 30 }
    };
    var t = targets[this.role] || { x: 0, y: 0 };
    var tx = t.x * scale;
    var ty = t.y * scale;
    var dx = tx - this.x;
    var dy = ty - this.y;
    var dist = Math.sqrt(dx * dx + dy * dy) || 1;
    if (dist > 8) {
      this.x += (dx / dist) * 1.2;
      this.y += (dy / dist) * 1.2;
      this.dir = dx > 0 ? 1 : -1;
    }
    this.stepTrig = (this.stepTrig + 0.6) % 200;
    var bob = Math.sin(this.stepTrig * 0.08) * 2;

    ctx.save();
    ctx.translate(this.x, this.y + bob);
    ctx.scale(this.dir, 1);
    ctx.fillStyle = this.color;
    ctx.strokeStyle = C.outline;
    ctx.lineWidth = 1.5;
    ctx.beginPath();
    ctx.arc(0, -10, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.stroke();
    ctx.fillRect(-5, -3, 10, 14);
    ctx.fillRect(-7, 8, 5, 8);
    ctx.fillRect(2, 8, 5, 8);
    ctx.restore();

    this.bubbleTimer++;
    if (this.bubbleTimer > 180 + Math.random() * 120) {
      this.bubbleTimer = 0;
      var msg = this.dialogs[Math.floor(Math.random() * this.dialogs.length)];
      createBubble(this.x, this.y - 28, msg);
    }
  };

  var stream = new QueryStreamConduit();
  var core = new SemanticPublishCore();
  var agents = [
    new Agent(-140, 60, C.agentYellow, "1_architect", [
      "Группирую 12 фраз в кластер",
      "Интент: коммерческий",
      "Hub-and-spoke для лендинга"
    ]),
    new Agent(-100, -30, C.agentGreen, "2_seo", [
      "Плотность ключей в норме",
      "FAQ из НЧ Wordstat",
      "Title + description готовы"
    ]),
    new Agent(20, 70, C.agentBlue, "3_coder", [
      "Черновик статьи: 4 200 знаков",
      "E-E-A-T чеклист пройден",
      "Антипереспам: ок"
    ]),
    new Agent(70, -20, C.agentPink, "4_designer", [
      "Лендинг: оффер + CTA",
      "Блок кейсов в bento",
      "Перелинковка на хаб"
    ]),
    new Agent(130, 50, C.agentPurple, "5_deployer", [
      "Публикую в WordPress",
      "Schema FAQPage добавлена",
      "Индекс: отправлено в CMS"
    ])
  ];

  var bubbleHints = [
    { at: 55, text: "Импорт семантики Wordstat" },
    { at: 100, text: "Кластеризация по эмбеддингам" },
    { at: 150, text: "ТЗ: H1, meta, структура" },
    { at: 200, text: "Guardrails: фактчек + уникальность" },
    { at: 245, text: "Страница live — импульс индексации" }
  ];
  var lastHint = -1;

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life--;
      if (b.life <= 0) return false;
      var alpha = b.life / b.max;
      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.font = "bold 9px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 22, tw, 18, 6, C.bubbleBg, null);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y - 10);
      ctx.restore();
      return true;
    });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);

    stream.draw(ctx);
    core.draw(ctx);
    agents.forEach(function (a) { a.draw(ctx); });

    bubbleHints.forEach(function (h) {
      if (core.cyclePrg >= h.at && core.cyclePrg < h.at + 8 && lastHint !== h.at) {
        createBubble(0, -75, h.text);
        lastHint = h.at;
      }
    });
    if (core.cyclePrg < 50) lastHint = -1;

    ctx.restore();
    drawBubbles(ctx);
    requestAnimationFrame(engineloop);
  }
  engineloop();
});
</script>
