<?php

class ProjectModel
{
    public function getAll(): array
    {
        return [
            [
                'type'       => 'Client · Site vitrine & boutique',
                'title'      => 'Kocoon Family',
                'desc'       => 'Site complet pour un concept store familial en Normandie : boutique en ligne, gestion d\'événements et ateliers, newsletter, espace de réservation. Conçu sur WordPress pour une gestion autonome par le client.',
                'chips'      => ['Boutique intégrée', 'Agenda d\'événements', 'Gestion autonome', 'Mobile responsive'],
                'techs'      => ['WordPress', 'Elementor', 'WooCommerce', 'The Events Calendar'],
                'url'        => 'https://kocoonfamily.fr',
                'link_label' => 'Voir le site',
            ],
            [
                'type'       => 'Application · Gestion métier',
                'title'      => 'GestiBar',
                'desc'       => 'Application web complète pour la gestion de bars : suivi de stock en temps réel, réception de marchandises, 124 recettes de cocktails, tableaux de bord avec alertes et rapports. Interface pensée pour des équipes non-techniques.',
                'chips'      => ['Stock temps réel', '124 recettes cocktails', 'Scanner codes-barres', 'Interface mobile'],
                'techs'      => ['Symfony', 'PHP', 'MySQL', 'Bootstrap'],
                'url'        => 'https://gestibar.ca',
                'link_label' => 'Voir l\'app',
            ],
            [
                'type'       => 'Outil SaaS · Hébergement',
                'title'      => 'HostBook',
                'desc'       => 'Plateforme de gestion d\'hébergement web : suivi des domaines, renouvellements, clients et factures regroupés dans un seul tableau de bord. Conçu pour les freelances et agences qui gèrent plusieurs clients.',
                'chips'      => ['Gestion domaines', 'Suivi facturation', 'Multi-clients', 'Alertes renouvellement'],
                'techs'      => ['Laravel', 'Vue.js', 'Stripe', 'MySQL'],
                'url'        => 'https://hostbook.dev',
                'link_label' => 'Voir le projet',
            ],
            [
                'type'       => 'Plugin WordPress · Sur mesure',
                'title'      => 'Kocoon Manager',
                'desc'       => 'Application de gestion standalone pour Kocoon Family : caisse avec intégration SumUp, gestion de stock, agenda des ateliers, suivi des adhésions et rapports. Interface indépendante du back-office WordPress, accessible sur /kocoon-manager.',
                'chips'      => ['Caisse SumUp', 'Gestion stock', 'Ateliers & réservations', 'Rôles & accès'],
                'techs'      => ['WordPress', 'PHP', 'MySQL', 'SumUp API'],
                'url'        => 'https://kocoonfamily.fr/kocoon-manager',
                'link_label' => 'Voir le plugin',
            ],
        ];
    }
}
