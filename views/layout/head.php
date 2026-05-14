<?php
$page_title       = $page_title       ?? 'YéliDev — Développeur Full-Stack à Montréal';
$page_description = $page_description ?? 'YéliDev — Développeur full-stack basé à Montréal. Je crée des sites vitrines, applications web et boutiques en ligne pour PME et entrepreneurs. Contactez-moi pour votre projet.';
$page_canonical   = $page_canonical   ?? 'https://yelidev.ca/';
$page_og_type     = $page_og_type     ?? 'website';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?= htmlspecialchars($page_title) ?></title>

  <!-- SEO -->
  <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= htmlspecialchars($page_canonical) ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="<?= htmlspecialchars($page_og_type) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($page_canonical) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta property="og:image" content="https://yelidev.ca/assets/image/og-preview.png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="fr_CA">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($page_description) ?>">
  <meta name="twitter:image" content="https://yelidev.ca/assets/image/og-preview.png">

  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/style.css">

  <!-- Favicons -->
  <link rel="icon" href="/assets/image/favicon/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/image/favicon/favicon.svg" type="image/svg+xml">
  <link rel="icon" type="image/png" sizes="96x96" href="/assets/image/favicon/favicon-96x96.png">

  <!-- Apple / Mobile -->
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/image/favicon/apple-touch-icon.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="YéliDev">

  <!-- Manifest -->
  <link rel="manifest" href="/assets/image/favicon/site.webmanifest">

  <!-- Theme -->
  <meta name="theme-color" content="#0f172a">

  <!-- Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "YéliDev",
    "url": "https://yelidev.ca/",
    "jobTitle": "Développeur Full-Stack",
    "description": "Développeur full-stack basé à Montréal. Sites vitrines, applications web et boutiques en ligne pour PME et entrepreneurs.",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Montréal",
      "addressRegion": "QC",
      "addressCountry": "CA"
    },
    "sameAs": []
  }
  </script>

</head>
<body>
<div class="wrap">
