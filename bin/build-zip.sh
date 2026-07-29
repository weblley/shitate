#!/usr/bin/env bash
#
# Build a distributable zip of the Shitate theme.
# Stages only the files that ship and zips them with the theme slug as the
# top-level folder (required for WordPress installs).
#
set -euo pipefail

cd "$(dirname "$0")/.."

SLUG="shitate"
DIST="dist"
STAGE="$DIST/$SLUG"

echo "→ Staging files…"
rm -rf "$STAGE" "$DIST/$SLUG.zip"
mkdir -p "$STAGE"

for item in style.css theme.json functions.php readme.txt screenshot.png templates parts patterns styles assets languages; do
	if [ -e "$item" ]; then
		cp -R "$item" "$STAGE/"
	fi
done

echo "→ Zipping…"
( cd "$DIST" && zip -rqX "$SLUG.zip" "$SLUG" )
rm -rf "$STAGE"

echo "✓ Built $DIST/$SLUG.zip"
