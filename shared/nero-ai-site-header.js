(function () {
  "use strict";

  function initHeader() {
    var header = document.getElementById("nero-ai-header");
    var toggle = document.getElementById("nero-ai-header-toggle");
    var nav = document.getElementById("nero-ai-header-nav");
    if (!header) return;

    if (toggle && nav) {
      toggle.addEventListener("click", function () {
        var open = header.classList.toggle("is-open");
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
      });

      nav.querySelectorAll("a").forEach(function (link) {
        link.addEventListener("click", function () {
          header.classList.remove("is-open");
          toggle.setAttribute("aria-expanded", "false");
        });
      });
    }

    window.addEventListener(
      "scroll",
      function () {
        header.classList.toggle("is-scrolled", window.scrollY > 24);
      },
      { passive: true }
    );

    document.querySelectorAll('.nero-ai-header-link[href*="#"]').forEach(function (link) {
      link.addEventListener("click", function (e) {
        var href = link.getAttribute("href") || "";
        var hashIndex = href.indexOf("#");
        if (hashIndex === -1) return;

        var id = href.slice(hashIndex + 1);
        if (!id) return;

        var samePage = href.charAt(0) === "#" || href.indexOf(window.location.pathname) !== -1;
        if (!samePage) return;

        var target = document.getElementById(id);
        if (!target) return;

        e.preventDefault();
        var offset = (header.offsetHeight || 80) + 20;
        var top = target.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top: top, behavior: "smooth" });
      });
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initHeader);
  } else {
    initHeader();
  }
})();
