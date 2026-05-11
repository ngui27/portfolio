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
                'chips'      => ['Gestion autonome', 'Boutique intégrée', 'Agenda d\'événements', 'Mobile responsive'],
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
        ];
    }
}
