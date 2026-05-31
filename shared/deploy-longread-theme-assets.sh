#!/usr/bin/env bash
# Копирует дизайн-ассеты лонгрида в wordpress-theme/ перед SFTP-деплоем.
set -euo pipefail
ROOT="$(cd "$(dirname "$0")/.." && pwd)"
for f in \
  longread-page-kadence-layout.css \
  longread-page-design-reference.css \
  longread-page-reveal.js \
  longread-page-wordpress-bootstrap.inc.php \
  nero-ai-floating-header.css \
  nero-ai-floating-header.js \
  nero-ai-floating-header.inc.php
do
  cp "$ROOT/shared/$f" "$ROOT/wordpress-theme/$f"
done
echo "Synced design assets to wordpress-theme/"
