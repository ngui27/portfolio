# CLAUDE.md — Portfolio YéliDev

## Rôle

Tu es mon assistant développeur sur ce projet de portfolio personnel.
Tu modifies uniquement les fichiers existants sauf si je te demande explicitement d'en créer de nouveaux.
Tu ne proposes jamais de changer de stack ou d'ajouter des dépendances.

---

## Contexte personnel

- **Nom de marque** : YéliDev
- **Profil** : Développeur full-stack débutant, basé à Montréal (Québec)
- **Objectif du site** : Attirer des clients (PME, entrepreneurs, petites entreprises locales)
- **Langue du site** : Français

---

## Stack technique — à ne jamais changer

- HTML / CSS / JS vanilla uniquement
- Zéro framework (pas de React, Vue, Angular, etc.)
- Zéro npm, zéro build tool, zéro bundler
- 2 fichiers principaux : `index.html` + `projects.js`
- Hébergé via FTP/cPanel sur serveur o2switch

---

## Architecture des fichiers

```
portfolio/
├── index.html       ← structure + styles (tout-en-un)
└── projects.js      ← données des projets uniquement
```

**Règle importante** : pour ajouter un projet, on modifie uniquement `projects.js`.
Les projets sont rendus dynamiquement dans le `<div id="projects-list">` via JS.

---

## Design system (à respecter strictement)

- **Fond** : `#080808`
- **Texte principal** : `#f0f0f0`
- **Style** : dark monochrome, glassmorphism léger
- **Effets de fond** : grille subtile + halos lumineux via `body::before` / `body::after`
- **Palette** : uniquement des `rgba(255,255,255, X)` pour les teintes — zéro couleur d'accent
- **Police** : `Outfit` (Google Fonts), weights 300 / 400 / 500 / 700 / 800
- **Backdrop-filter blur** sur nav, cartes, boutons, section contact
- **Animations** : uniquement `transition` et `@keyframes blink` (badge disponibilité)
- **Border-radius** : 100px pour les pilules, 20px pour les cartes, 16px pour les stats

---

## Structure HTML actuelle (sections dans l'ordre)

1. `<nav>` — logo YéliDev + liens + bouton CTA
2. `<section class="hero">` — badge dispo + h1 + sous-titre + boutons + stats
3. `<section id="services">` — 3 cards (site vitrine, app web, e-commerce)
4. `<section id="projects">` — liste rendue par `projects.js`
5. `<section id="why">` — 4 items numérotés 01–04
6. `<section id="contact">` — carte centée avec email + réseaux
7. `<footer>`

---

## Projets existants (dans projects.js)

### Kocoon Family

- Type : Client · Site vitrine & boutique
- URL : https://kocoonfamily.fr
- Stack : WordPress, Elementor, WooCommerce, The Events Calendar
- Points forts : gestion autonome, boutique, agenda événements, mobile responsive

### GestiBar

- Type : Application · Gestion métier
- URL : https://espritlibertin.com
- Stack : Symfony, PHP, MySQL, Bootstrap
- Points forts : stock temps réel, 124 recettes cocktails, scanner codes-barres, mobile

---

## Placeholders à remplir par moi-même (ne pas inventer)

- `VOTRE@EMAIL.COM` → mon email réel
- Lien GitHub → `href="#"` à remplacer
- Lien LinkedIn → `href="#"` à remplacer

---

## Ce que tu peux faire sans me demander

- Modifier le CSS si je décris un problème visuel
- Corriger des bugs HTML/JS
- Ajouter un projet dans `projects.js` si je te donne les infos
- Améliorer la responsivité mobile

## Ce que tu dois me demander avant de faire

- Changer la structure des sections
- Ajouter une nouvelle section
- Modifier les textes de contenu (accroche, descriptions)
- Ajouter un fichier PHP (ex: formulaire de contact)
