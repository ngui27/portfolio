#!/usr/bin/env python3
"""
Génère des markdown mirrors pour chaque page de yelidev.ca.
Crawle le serveur local, strip nav/footer/scripts, convertit en Markdown propre.
Usage : python3 generate_markdown_mirrors.py [--base-url http://localhost:8080]
"""

import os
import sys
import re
from datetime import datetime, timezone
from pathlib import Path
import requests
from bs4 import BeautifulSoup
from markdownify import markdownify as md

BASE_URL   = sys.argv[2] if len(sys.argv) > 2 else "http://localhost:8080"
SITE_URL   = "https://yelidev.ca"
OUT_DIR    = Path(__file__).parent / "markdown"
NOW        = datetime.now(timezone.utc).strftime("%Y-%m-%d")

PAGES = [
    {"path": "/",                                          "out": "index.md",                                                         "title": "YéliDev — Développeur Web à Montréal",                                                    "description": "Développeur web à Montréal. Sites vitrines, applications web et outils personnalisés pour PME et entrepreneurs."},
    {"path": "/blog",                                      "out": "blog/index.md",                                                    "title": "Blog SEO & GEO — YéliDev",                                                               "description": "Conseils pratiques pour développeurs et entrepreneurs qui veulent être trouvés sur Google et les IA de recherche."},
    {"path": "/blog/seo-technique-pour-developpeur",       "out": "blog/seo-technique-pour-developpeur.md",       "title": "SEO technique : les fondations que tout développeur web doit maîtriser",               "description": "Balises meta, Core Web Vitals, données structurées, HTTPS… Un guide pratique de référencement technique pour développeurs."},
    {"path": "/blog/seo-local-site-vitrine-montreal",      "out": "blog/seo-local-site-vitrine-montreal.md",      "title": "SEO local à Montréal : comment votre site vitrine attire des clients sans publicité",   "description": "Google Business Profile, NAP, avis clients, schema LocalBusiness… Tout ce qu'une PME à Montréal doit mettre en place."},
    {"path": "/blog/geo-optimiser-site-ia-chatgpt-perplexity", "out": "blog/geo-optimiser-site-ia-chatgpt-perplexity.md", "title": "GEO : optimiser son site pour être cité par ChatGPT, Perplexity et Google AI Overviews", "description": "Le Generative Engine Optimization (GEO) est la prochaine frontière du référencement. Comment structurer votre contenu pour les IA."},
    {"path": "/blog/meilleur-hebergement-web-site-vitrine","out": "blog/meilleur-hebergement-web-site-vitrine.md","title": "Meilleur hébergement web en 2026 : comment choisir et pourquoi j'utilise o2switch",    "description": "Hébergement mutualisé, VPS, cloud… Lequel choisir pour un site vitrine ? Guide complet + avis honnête sur o2switch."},
]

STRIP_TAGS = ["nav", "footer", "script", "style", "noscript", "header",
              "button", "form", "svg", ".jc-overlay", ".article-nav",
              ".article-footer", ".article-author", ".blog-preview-cta"]

def fetch(url):
    r = requests.get(url, timeout=10)
    r.raise_for_status()
    return r.text

def clean(html, path):
    soup = BeautifulSoup(html, "html.parser")

    for sel in STRIP_TAGS:
        if sel.startswith("."):
            for el in soup.select(sel): el.decompose()
        else:
            for el in soup.find_all(sel): el.decompose()

    # Garder seulement le contenu principal
    main = (soup.find("article")
            or soup.find("main")
            or soup.find(class_="container")
            or soup.find("body"))

    return str(main) if main else str(soup)

def to_markdown(html):
    text = md(html, heading_style="ATX", bullets="-", strip=["img"])
    # Nettoyer les lignes vides excessives
    text = re.sub(r'\n{3,}', '\n\n', text)
    text = re.sub(r'[ \t]+\n', '\n', text)
    return text.strip()

def frontmatter(page):
    canonical = SITE_URL + page["path"]
    return f"""---
title: {page['title']}
description: {page['description']}
url: {canonical}
last_updated: {NOW}
---

"""

def generate(page):
    url = BASE_URL + page["path"]
    try:
        html   = fetch(url)
        clean_html = clean(html, page["path"])
        content    = to_markdown(clean_html)
        output     = frontmatter(page) + content

        out_path = OUT_DIR / page["out"]
        out_path.parent.mkdir(parents=True, exist_ok=True)
        out_path.write_text(output, encoding="utf-8")
        print(f"  ✓  {page['path']}  →  markdown/{page['out']}")
        return True
    except Exception as e:
        print(f"  ✗  {page['path']}  —  {e}")
        return False

if __name__ == "__main__":
    print(f"\nServeur local : {BASE_URL}")
    print(f"Sortie        : {OUT_DIR}\n")

    OUT_DIR.mkdir(exist_ok=True)
    ok = sum(generate(p) for p in PAGES)
    print(f"\n{ok}/{len(PAGES)} fichiers générés dans markdown/\n")
