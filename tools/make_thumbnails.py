"""Create small gallery thumbnails: img/<gallery>/<photo>  ->  img/<gallery>/thumbs/<photo>

The galleries show thumbnails 75px high; they are made 150px high so they stay sharp on
high-resolution (retina) screens. The full-size photo is only loaded when it is opened in the viewer.

Usage (from the repository root, needs Pillow: pip install pillow):
    python tools/make_thumbnails.py            # only new or changed photos
    python tools/make_thumbnails.py --force    # rebuild every thumbnail
"""
import sys
from pathlib import Path

from PIL import Image, ImageOps

HEIGHT = 150
QUALITY = 80
GALLERIES = sorted(p for p in Path("img").glob("akon[0-9]*") if p.is_dir())
PHOTO_SUFFIXES = {".jpg", ".jpeg", ".png"}


def make_thumbnail(src: Path, dst: Path) -> None:
    with Image.open(src) as image:
        # browsers rotate photos according to their EXIF orientation, so the thumbnail must match
        image = ImageOps.exif_transpose(image)
        width = max(1, round(image.width * HEIGHT / image.height))
        thumb = image.convert("RGB").resize((width, HEIGHT), Image.Resampling.LANCZOS)
    dst.parent.mkdir(exist_ok=True)
    thumb.save(dst, "JPEG", quality=QUALITY, optimize=True, progressive=True)


def main() -> None:
    force = "--force" in sys.argv
    made = skipped = 0
    for gallery in GALLERIES:
        for src in sorted(p for p in gallery.iterdir() if p.suffix.lower() in PHOTO_SUFFIXES):
            dst = gallery / "thumbs" / src.name
            if not force and dst.exists() and dst.stat().st_mtime >= src.stat().st_mtime:
                skipped += 1
                continue
            make_thumbnail(src, dst)
            made += 1
    print(f"thumbnails created: {made}, already up to date: {skipped}")


if __name__ == "__main__":
    main()
