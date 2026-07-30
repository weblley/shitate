#!/usr/bin/env bash
#
# Release the Shitate theme to GitHub.
# Usage: bin/release.sh <version>   (e.g. bin/release.sh 0.2.0)
#
# Prerequisite: CHANGELOG.md has a "## [<version>] - YYYY-MM-DD" section.
# Flow: bump versions → commit → tag → build zip → push → GitHub Release.
set -euo pipefail

cd "$(dirname "$0")/.."

VERSION="${1:?Usage: bin/release.sh <version> (e.g. 0.2.0)}"
[[ "$VERSION" =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]] || { echo "✗ Version must look like 1.2.3"; exit 1; }
TAG="v$VERSION"

[ -z "$(git status --porcelain)" ] || { echo "✗ Working tree is not clean — commit or stash first"; exit 1; }
git rev-parse "$TAG" >/dev/null 2>&1 && { echo "✗ Tag $TAG already exists"; exit 1; }

# Release notes = this version's CHANGELOG section.
NOTES="$(awk -v ver="$VERSION" '
	$0 ~ "^## \\[" ver "\\]" { found = 1; next }
	found && /^## \[/ { exit }
	found { print }
' CHANGELOG.md)"
[ -n "$(echo "$NOTES" | tr -d '[:space:]')" ] || {
	echo "✗ CHANGELOG.md に「## [$VERSION] - YYYY-MM-DD」セクションを書いてから実行してください"
	exit 1
}

echo "→ Bumping version to ${VERSION}"
perl -pi -e "s/^(Version: ).*/\${1}$VERSION/" style.css
perl -pi -e "s/^(Stable tag: ).*/\${1}$VERSION/" readme.txt

git add -A
git commit --allow-empty -m "Release $VERSION"
git tag "$TAG"

echo "→ Building zip…"
bin/build-zip.sh

echo "→ Pushing…"
git push origin HEAD "$TAG"

echo "→ Creating GitHub release…"
gh release create "$TAG" "dist/shitate.zip" --title "Shitate $VERSION" --notes "$NOTES"

echo "✓ Released $VERSION → $(gh release view "$TAG" --json url -q .url)"
