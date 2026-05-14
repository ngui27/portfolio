<?php

class ArticleModel
{
    public function getAll(): array
    {
        return array_reverse($this->articles());
    }

    public function getLatest(int $n = 3): array
    {
        return array_slice(array_reverse($this->articles()), 0, $n);
    }

    public function getBySlug(string $slug): ?array
    {
        foreach ($this->articles() as $article) {
            if ($article['slug'] === $slug) {
                return $article;
            }
        }
        return null;
    }

    private function articles(): array
    {
        return [
            [
                'slug'     => 'seo-technique-pour-developpeur',
                'title'    => 'Les bases du SEO technique que tout développeur doit maîtriser',
                'excerpt'  => 'Balises meta, Core Web Vitals, sitemap, données structurées… Ce que vous devez implémenter dès le départ pour que votre site soit bien indexé par Google.',
                'date'     => '2026-04-10',
                'category' => 'SEO',
                'read_time' => 6,
                'content'  => <<<HTML
<p>En tant que développeur, vous livrez du code propre — mais est-ce que Google peut l'indexer correctement ? Le SEO technique, c'est la fondation invisible de tout bon référencement. Voici ce qu'il faut mettre en place dès le départ.</p>

<h2>1. Les balises meta essentielles</h2>
<p>Chaque page doit avoir une balise <code>&lt;title&gt;</code> unique (50-60 caractères) et une <code>&lt;meta name="description"&gt;</code> (150-160 caractères). Ce sont ces deux éléments qui apparaissent dans les résultats Google. Pensez aussi à la balise <code>canonical</code> pour éviter le contenu dupliqué.</p>

<h2>2. Les Core Web Vitals</h2>
<p>Google mesure trois métriques de performance pour classer votre site :</p>
<ul>
  <li><strong>LCP (Largest Contentful Paint)</strong> : temps d'affichage du plus grand élément visible. Cible : sous 2,5 secondes.</li>
  <li><strong>INP (Interaction to Next Paint)</strong> : réactivité aux clics et inputs. Cible : sous 200 ms.</li>
  <li><strong>CLS (Cumulative Layout Shift)</strong> : stabilité visuelle de la page. Cible : sous 0,1.</li>
</ul>
<p>Ces métriques sont mesurées par de vrais utilisateurs Chrome et impactent directement votre classement.</p>

<h2>3. Le sitemap XML et robots.txt</h2>
<p>Un fichier <code>sitemap.xml</code> indique à Google quelles pages crawler en priorité. Le <code>robots.txt</code> permet d'exclure les URLs inutiles (admin, duplicates). Deux fichiers simples qui font une vraie différence à l'indexation.</p>

<h2>4. Les données structurées (Schema.org)</h2>
<p>Ajoutez du JSON-LD sur vos pages pour aider Google à comprendre votre contenu : type d'entreprise, articles de blog, avis, FAQ. Ces marqueurs peuvent générer des rich snippets dans les résultats de recherche et augmenter votre taux de clic.</p>

<h2>5. HTTPS et sécurité</h2>
<p>HTTPS est un signal de ranking depuis 2014. Assurez-vous que tous vos assets sont servis en HTTPS et que la redirection HTTP → HTTPS est bien configurée côté serveur. Google pénalise les sites "mixed content".</p>

<p>Ces cinq points forment la base d'un site techniquement sain. Une fois ces fondations en place, votre contenu a réellement une chance d'être découvert et classé.</p>
HTML,
            ],
            [
                'slug'     => 'seo-local-site-vitrine-montreal',
                'title'    => 'Pourquoi votre site vitrine doit être optimisé pour la recherche locale',
                'excerpt'  => 'Un site beau mais invisible localement ne ramène pas de clients. Voici comment optimiser votre présence sur Google pour attirer des clients à Montréal et au Québec.',
                'date'     => '2026-04-28',
                'category' => 'SEO Local',
                'read_time' => 5,
                'content'  => <<<HTML
<p>Si vous êtes une PME ou un entrepreneur au Québec, vos clients potentiels recherchent vos services sur Google — souvent avec des requêtes locales comme "développeur web Montréal" ou "agence web Québec". Est-ce que votre site apparaît ?</p>

<h2>Google Business Profile : le point de départ</h2>
<p>Un profil Google Business Profile (anciennement Google My Business) bien rempli vous permet d'apparaître dans le "Local Pack" — ces trois résultats avec carte qui dominent les recherches locales. Adresse, horaires, photos, catégorie : chaque champ compte.</p>

<h2>Le NAP : cohérence avant tout</h2>
<p>NAP signifie Name, Address, Phone. Ces trois informations doivent être identiques sur votre site, votre GBP, les annuaires (Yelp, Pages Jaunes, etc.) et les réseaux sociaux. Une incohérence confond Google et nuit à votre classement local.</p>

<h2>Les signaux on-page pour le local</h2>
<p>Sur votre site, mentionnez explicitement votre ville et région dans :</p>
<ul>
  <li>Le title et la meta description de votre page d'accueil</li>
  <li>Le texte de votre section "À propos" ou "Contact"</li>
  <li>Les données structurées de type <code>LocalBusiness</code> ou <code>Person</code></li>
</ul>
<p>Un schéma JSON-LD avec votre adresse et zone de service indique clairement à Google où vous opérez.</p>

<h2>Les avis clients</h2>
<p>Les avis Google sont un signal de ranking local fort. Plus vous en avez (et plus ils sont récents), mieux vous vous positionnez. N'hésitez pas à demander à vos clients satisfaits de laisser un avis — c'est légal et efficace.</p>

<h2>Le résultat</h2>
<p>Un site optimisé pour la recherche locale génère du trafic qualifié sans publicité payante. Vos visiteurs cherchent exactement ce que vous offrez, dans votre secteur géographique. C'est du marketing ciblé à coût marginal quasi nul.</p>
HTML,
            ],
            [
                'slug'     => 'geo-optimiser-site-ia-chatgpt-perplexity',
                'title'    => 'GEO : comment optimiser son site pour être cité par ChatGPT et Perplexity',
                'excerpt'  => 'Le GEO (Generative Engine Optimization) est la nouvelle frontière du référencement. Voici comment structurer votre contenu pour être mentionné par les IA de recherche.',
                'date'     => '2026-05-12',
                'category' => 'GEO',
                'read_time' => 7,
                'content'  => <<<HTML
<p>ChatGPT, Perplexity, Google AI Overviews… Les moteurs de recherche basés sur l'IA transforment la façon dont les gens trouvent des informations. Une nouvelle discipline émerge : le <strong>GEO (Generative Engine Optimization)</strong> — l'art d'optimiser son contenu pour être cité par ces systèmes.</p>

<h2>Pourquoi le GEO change la donne</h2>
<p>Quand un utilisateur pose une question à ChatGPT ou Perplexity, ces IA synthétisent des réponses à partir de sources qu'elles jugent fiables. Si votre site est cité, vous bénéficiez d'une visibilité sans publicité dans un contexte de forte intention. C'est du référencement au cœur de la réponse, pas dans une liste de liens.</p>

<h2>1. Écrire pour les passages, pas juste pour les pages</h2>
<p>Les IA extraient des passages précis de vos pages. Chaque section de votre contenu doit être autonome et répondre clairement à une question spécifique. Utilisez des titres H2/H3 qui sont eux-mêmes des questions ou des affirmations directes.</p>

<h2>2. Montrer votre autorité (E-E-A-T)</h2>
<p>Google et les IA valorisent l'expérience, l'expertise, l'autorité et la fiabilité. Mentionnez votre parcours, citez des données sources, datez vos contenus. Un article avec "Mis à jour en mai 2026" signé par un auteur identifié sera préféré à du contenu anonyme.</p>

<h2>3. Le fichier llms.txt</h2>
<p>À l'image du <code>robots.txt</code> pour les crawlers classiques, le fichier <code>llms.txt</code> (à la racine de votre site) indique aux IA quelles pages indexer en priorité et comment comprendre votre site. C'est encore émergent, mais les outils comme Perplexity commencent à le respecter.</p>

<h2>4. Structurer vos données</h2>
<p>Les Schema.org (FAQ, Article, HowTo, Person) aident les IA à comprendre le contexte de votre contenu. Un schéma <code>FAQPage</code> bien rempli a de bonnes chances d'être repris directement dans une réponse synthétique.</p>

<h2>5. La cohérence de marque</h2>
<p>Plus votre marque est mentionnée dans des sources tierces (médias, annuaires, forums, GitHub), plus les IA lui accordent de crédit. Le GEO, c'est aussi du PR digital : écrire des articles invités, participer à des discussions, être référencé dans des listes d'experts.</p>

<h2>GEO + SEO : les deux se complètent</h2>
<p>Le GEO ne remplace pas le SEO — il s'y ajoute. Un contenu bien optimisé pour Google a généralement de bonnes bases pour les IA aussi. La différence : le GEO pousse plus loin la clarté, la structure et l'autorité perçue. C'est le SEO de demain, à commencer aujourd'hui.</p>
HTML,
            ],
        ];
    }
}
