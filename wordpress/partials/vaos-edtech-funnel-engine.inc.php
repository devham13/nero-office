<?php
/**
 * Hero canvas engine (Алина) — vaos-edtech-funnel-canvas
 * Не модифицировать без согласования с блоком === АЛИНА (HERO) ===
 */
?>
<script>
/**
 * vaos-edtech-engine — Диспетчерская воронки онлайн-школы
 */
document.addEventListener("DOMContentLoaded", function () {
  var canvas = document.getElementById("vaos-edtech-funnel-canvas");
  if (!canvas) return;
  var ctx = canvas.getContext("2d");
  var cw = 0, ch = 0, scale = 1, cx = 0, cy = 0, frame = 0;

  function resizeCanvas() {
    var wrap = canvas.parentElement;
    if (!wrap) return;
    canvas.width = wrap.clientWidth || 400;
    canvas.height = wrap.clientHeight || 260;
    cw = canvas.width;
    ch = canvas.height;
    cx = cw / 2;
    cy = ch / 2 + 8;
    scale = Math.min(cw / 420, ch / 280) * 1.1;
  }
  window.addEventListener("resize", resizeCanvas);
  resizeCanvas();

  var C = {
    outline: "#64748b",
    webinarGlow: "rgba(139,92,246,0.45)",
    river: "rgba(121,242,255,0.2)",
    hubBase: "#1e293b",
    hubAccent: "#79f2ff",
    hubViolet: "#8b5cf6",
    gcGreen: "#22c55e",
    hotAmber: "#fbbf24",
    curatorBell: "#f472b6",
    leadCard: "#f1f5f9",
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

  function WebinarLeadRiver() { this.wave = 0; }
  WebinarLeadRiver.prototype.draw = function (ctx) {
    this.wave = (frame * 0.03) % (Math.PI * 2);
    var pathY = -ch * 0.32;
    ctx.strokeStyle = C.river;
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 7]);
    ctx.lineDashOffset = -frame * 0.5;
    ctx.beginPath();
    for (var x = -cw * 0.5; x <= cw * 0.5; x += 8) {
      var y = pathY + Math.sin(x * 0.025 + this.wave) * 14;
      if (x === -cw * 0.5) ctx.moveTo(x, y);
      else ctx.lineTo(x, y);
    }
    ctx.stroke();
    ctx.setLineDash([]);
    for (var i = 0; i < 4; i++) {
      var t = (frame * 0.018 + i * 0.28) % 1;
      var px = -cw * 0.42 + t * cw * 0.84;
      var py = pathY + Math.sin(px * 0.025 + this.wave) * 14;
      var hot = i === 1;
      drawRR(ctx, px - 16, py - 10, 32, 20, 4, hot ? "rgba(251,191,36,0.35)" : C.leadCard, C.outline);
      ctx.fillStyle = "#0f172a";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(hot ? "HOT" : "лид", px, py + 3);
    }
  };

  function WebinarStage() { this.pulse = 0; }
  WebinarStage.prototype.draw = function (ctx) {
    var x = -cw * 0.38, y = -ch * 0.38;
    drawRR(ctx, x, y, 72, 48, 6, "#0f172a", C.hubViolet);
    ctx.fillStyle = C.webinarGlow;
    ctx.globalAlpha = 0.35 + Math.sin(frame * 0.08) * 0.15;
    drawRR(ctx, x + 6, y + 8, 60, 32, 4, "rgba(139,92,246,0.5)", null);
    ctx.globalAlpha = 1;
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("LIVE", x + 36, y + 26);
    ctx.fillStyle = C.hubAccent;
    ctx.font = "6px Inter,sans-serif";
    ctx.fillText("Bizon365", x + 36, y + 38);
    if (frame % 90 < 45) {
      ctx.fillStyle = "#ef4444";
      ctx.beginPath();
      ctx.arc(x + 14, y + 14, 3, 0, Math.PI * 2);
      ctx.fill();
    }
  };

  function LearningFunnelHub() {
    this.phase = 0;
    this.completionPulse = 0;
  }
  LearningFunnelHub.prototype.draw = function (ctx) {
    var prg = (frame * 0.035) % 280;
    this.phase = prg;
    drawRR(ctx, -58, -72, 116, 148, 12, C.hubBase, C.outline);
    ctx.fillStyle = "rgba(121,242,255,0.1)";
    ctx.beginPath();
    ctx.moveTo(-44, -52);
    ctx.lineTo(44, -52);
    ctx.lineTo(26, 28);
    ctx.lineTo(-26, 28);
    ctx.closePath();
    ctx.fill();
    ctx.strokeStyle = C.hubAccent;
    ctx.lineWidth = 1.5;
    ctx.stroke();
    var stages = ["Заявка", "Консульт.", "Оплата", "Модуль 3"];
    stages.forEach(function (s, i) {
      ctx.fillStyle = prg > 40 + i * 55 ? C.hubAccent : "rgba(255,255,255,0.45)";
      ctx.font = "bold 7px Inter,sans-serif";
      ctx.textAlign = "center";
      ctx.fillText(s, 0, -38 + i * 20);
    });
    if (prg >= 50 && prg < 110) {
      LeadScoreChip.drawAt(ctx, 62, -20, Math.floor((prg - 50) / 6));
    }
    if (prg >= 110 && prg < 180) {
      GetCourseEnrollCard.drawAt(ctx, 0, 42, (prg - 110) / 70);
    }
    if (prg >= 180) {
      CuratorAlertBell.drawAt(ctx, -62, 10, (prg - 180) / 100);
      this.completionPulse = Math.min(1, (prg - 200) / 40);
      if (prg > 200) {
        ctx.strokeStyle = "rgba(34,197,94," + (0.7 - this.completionPulse * 0.5) + ")";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.arc(0, 0, 30 + this.completionPulse * 35, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fillStyle = C.gcGreen;
        ctx.font = "bold 9px Inter,sans-serif";
        ctx.textAlign = "center";
        ctx.fillText("доходимость ↑", 0, 68);
      }
    }
  };

  function LeadScoreChip() {}
  LeadScoreChip.drawAt = function (ctx, x, y, score) {
    drawRR(ctx, x - 22, y - 12, 44, 24, 6, "rgba(251,191,36,0.3)", C.hotAmber);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 8px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("score " + Math.min(99, 40 + score * 8), x, y + 4);
  };

  function GetCourseEnrollCard() {}
  GetCourseEnrollCard.drawAt = function (ctx, x, y, prg) {
    var lift = (1 - prg) * 20;
    drawRR(ctx, x - 30, y - lift, 60, 28, 6, "rgba(34,197,94,0.28)", C.gcGreen);
    ctx.fillStyle = "#fff";
    ctx.font = "bold 7px Inter,sans-serif";
    ctx.textAlign = "center";
    ctx.fillText("GetCourse ✓", x, y + 4 - lift);
    ctx.font = "6px Inter,sans-serif";
    ctx.fillStyle = "#bbf7d0";
    ctx.fillText("оплата", x, y + 14 - lift);
  };

  function CuratorAlertBell() {}
  CuratorAlertBell.drawAt = function (ctx, x, y, prg) {
    var swing = Math.sin(frame * 0.12) * 0.15 * prg;
    ctx.save();
    ctx.translate(x, y);
    ctx.rotate(swing);
    ctx.fillStyle = C.curatorBell;
    ctx.beginPath();
    ctx.arc(0, 0, 10, Math.PI, 0);
    ctx.lineTo(10, 6);
    ctx.lineTo(-10, 6);
    ctx.closePath();
    ctx.fill();
    ctx.fillStyle = C.hotAmber;
    ctx.beginPath();
    ctx.arc(0, 8, 3, 0, Math.PI * 2);
    ctx.fill();
    ctx.restore();
  };

  var river = new WebinarLeadRiver();
  var webinar = new WebinarStage();
  var hub = new LearningFunnelHub();
  var bubbles = [];

  function createBubble(x, y, text) {
    bubbles.push({ x: x, y: y, text: text, life: 0, max: 110 });
  }

  var dialogs = [
    ["Сценарий post-webinar готов", "Триггер Bizon → CRM"],
    ["KB курса загружена", "36 модулей в RAG"],
    ["Webhook GetCourse ок", "единый ID ученика"],
    ["Тон AI-куратора согласован", "онбординг цепочка"],
    ["Пилот 20% трафика", "SLA < 15 сек"],
    ["Горячий лид → менеджер", "саммари в сделке"],
    ["Напоминание модуль 2", "ученик в зоне риска"],
    ["152-ФЗ: согласие в боте", "хранение в РФ"]
  ];

  function Agent(role, color, startX, startY) {
    this.role = role;
    this.color = color;
    this.x = startX;
    this.y = startY;
    this.targetX = startX;
    this.targetY = startY;
    this.dir = 1;
    this.bubbleTimer = Math.random() * 200;
  }
  Agent.prototype.update = function () {
    var dx = this.targetX - this.x;
    var dy = this.targetY - this.y;
    var dist = Math.sqrt(dx * dx + dy * dy);
    if (dist > 3) {
      this.x += (dx / dist) * 1.2;
      this.y += (dy / dist) * 1.2;
      this.dir = dx >= 0 ? 1 : -1;
    }
    this.bubbleTimer--;
    if (this.bubbleTimer <= 0 && Math.random() < 0.02) {
      var d = dialogs[Math.floor(Math.random() * dialogs.length)];
      createBubble(this.x, this.y - 28, d[0]);
      this.bubbleTimer = 120 + Math.random() * 180;
    }
  };
  Agent.prototype.draw = function (ctx) {
    ctx.save();
    ctx.translate(this.x, this.y);
    ctx.scale(this.dir, 1);
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(0, -8, 7, 0, Math.PI * 2);
    ctx.fill();
    ctx.fillRect(-5, -1, 10, 12);
    ctx.fillRect(-6, 10, 4, 8);
    ctx.fillRect(2, 10, 4, 8);
    ctx.restore();
  };

  var agents = [
    new Agent("1_architect", C.agentYellow, -90, 55),
    new Agent("2_kb", C.agentGreen, -50, 70),
    new Agent("3_dev", C.agentBlue, 0, 75),
    new Agent("4_curator", C.agentPink, 50, 70),
    new Agent("5_deploy", C.agentPurple, 90, 55)
  ];

  var stepTrig = [0, 0, 0, 0];
  function updateAgentTargets() {
    var prg = hub.phase;
    var targets = [
      { x: -cw * 0.28, y: -ch * 0.12 },
      { x: -cw * 0.12, y: ch * 0.08 },
      { x: cw * 0.08, y: ch * 0.1 },
      { x: cw * 0.22, y: 0 },
      { x: cw * 0.3, y: -ch * 0.08 }
    ];
    if (prg >= 30 && prg < 80 && !stepTrig[0]) {
      stepTrig[0] = 1;
      agents[0].targetX = targets[0].x;
      agents[0].targetY = targets[0].y;
      createBubble(targets[0].x, targets[0].y, "Лиды с эфира → AI");
    }
    if (prg >= 80 && prg < 140 && !stepTrig[1]) {
      stepTrig[1] = 1;
      agents[1].targetX = targets[1].x;
      agents[1].targetY = targets[1].y;
      agents[2].targetX = targets[2].x;
      agents[2].targetY = targets[2].y;
      createBubble(0, -20, "Квалификация из KB");
    }
    if (prg >= 140 && prg < 200 && !stepTrig[2]) {
      stepTrig[2] = 1;
      agents[3].targetX = targets[3].x;
      agents[3].targetY = targets[3].y;
      createBubble(targets[3].x, targets[3].y, "Оплата → онбординг");
    }
    if (prg >= 200 && !stepTrig[3]) {
      stepTrig[3] = 1;
      agents[4].targetX = targets[4].x;
      agents[4].targetY = targets[4].y;
      createBubble(0, 50, "Доходимость: модуль 3 ✓");
    }
    if (prg > 260) {
      stepTrig = [0, 0, 0, 0];
      agents.forEach(function (a, i) {
        a.targetX = [-90, -50, 0, 50, 90][i];
        a.targetY = [55, 70, 75, 70, 55][i];
      });
    }
  }

  function drawBubbles(ctx) {
    bubbles = bubbles.filter(function (b) {
      b.life++;
      b.y -= 0.35;
      var alpha = 1 - b.life / b.max;
      if (alpha <= 0) return false;
      ctx.globalAlpha = alpha;
      ctx.font = "bold 8px Inter,sans-serif";
      var tw = ctx.measureText(b.text).width + 14;
      drawRR(ctx, b.x - tw / 2, b.y - 10, tw, 18, 6, C.bubbleBg, C.hubAccent);
      ctx.fillStyle = C.bubbleText;
      ctx.textAlign = "center";
      ctx.fillText(b.text, b.x, b.y + 2);
      ctx.globalAlpha = 1;
      return true;
    });
  }

  function engineloop() {
    frame++;
    ctx.clearRect(0, 0, cw, ch);
    ctx.save();
    ctx.translate(cx, cy);
    ctx.scale(scale, scale);
    webinar.draw(ctx);
    river.draw(ctx);
    hub.draw(ctx);
    updateAgentTargets();
    agents.forEach(function (a) {
      a.update();
      a.draw(ctx);
    });
    drawBubbles(ctx);
    ctx.restore();
    requestAnimationFrame(engineloop);
  }

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(engineloop);
  } else {
    engineloop();
  }
});
</script>
