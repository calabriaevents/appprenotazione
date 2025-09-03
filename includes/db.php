<?php
/**
 * db.php
 *
 * Placeholder database class for "Passione Calabria".
 * This class simulates database interactions by returning mock data.
 * This allows for frontend development without a real database connection.
 * The methods are named based on the functionality described in the project analysis.
 */

class DB {
    // Simulates a connection object, not used in this placeholder.
    public $pdo;

    public function __construct() {
        // In a real application, the constructor would establish a database connection.
        // For now, it does nothing.
        $this->pdo = null;
    }

    /**
     * Fetches all categories.
     * @return array
     */
    public function getCategories() {
        return [
            ['id' => 1, 'name' => 'Borghi e Centri Storici', 'description' => 'Scopri i borghi medievali e i centri storici.', 'image' => 'https://placehold.co/400x300/003366/FFD700?text=Borghi', 'article_count' => 12],
            ['id' => 2, 'name' => 'Spiagge e Coste', 'description' => 'Le più belle spiagge e coste della Calabria.', 'image' => 'https://placehold.co/400x300/003366/FFD700?text=Spiagge', 'article_count' => 24],
            ['id' => 3, 'name' => 'Parchi e Natura', 'description' => 'Esplora i parchi nazionali e le riserve naturali.', 'image' => 'https://placehold.co/400x300/003366/FFD700?text=Natura', 'article_count' => 8],
            ['id' => 4, 'name' => 'Enogastronomia', 'description' => 'Sapori e tradizioni della cucina calabrese.', 'image' => 'https://placehold.co/400x300/003366/FFD700?text=Cibo', 'article_count' => 18],
        ];
    }

    /**
     * Fetches a limited number of recent articles for a given category.
     * @param int $categoryId
     * @param int $limit
     * @return array
     */
    public function getArticlesByCategory($categoryId, $limit = 3) {
        $articles = [
            ['id' => 1, 'title' => 'Tropea: La Perla del Tirreno', 'slug' => 'tropea-la-perla-del-tirreno', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Tropea'],
            ['id' => 2, 'title' => 'Scilla: Il Mito di Cariddi', 'slug' => 'scilla-il-mito-di-cariddi', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Scilla'],
            ['id' => 3, 'title' => 'Pizzo: Il Castello e il Tartufo', 'slug' => 'pizzo-il-castello-e-il-tartufo', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Pizzo'],
            ['id' => 4, 'title' => 'Capo Vaticano: Tramonti Mozzafiato', 'slug' => 'capo-vaticano-tramonti-mozzafiato', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Capo+Vaticano'],
        ];
        return array_slice($articles, 0, $limit);
    }

    /**
     * Fetches a single category by its ID.
     * @param int $id
     * @return array|null
     */
    public function getCategoryById($id) {
        $categories = $this->getCategories();
        foreach ($categories as $category) {
            if ($category['id'] == $id) {
                // Add a specific header image for the detail page
                $category['header_image'] = 'https://placehold.co/1920x400/003366/FFFFFF?text=' . urlencode($category['name']);
                return $category;
            }
        }
        return null;
    }

    /**
     * Fetches a single article by its slug.
     * @param string $slug
     * @return array|null
     */
    public function getArticleBySlug($slug) {
        $articles = $this->getAllArticles();
        foreach ($articles as $article) {
            if ($article['slug'] === $slug) {
                // Add more details for the single page view
                $article['content'] = "Questo è il corpo principale dell'articolo. Parla di luoghi meravigliosi e storie affascinanti. La Calabria è una terra ricca di cultura, tradizioni e paesaggi mozzafiato. In questo articolo, esploreremo in dettaglio " . $article['title'] . ", fornendo informazioni utili, consigli di viaggio e aneddoti interessanti. <br><br> Il testo potrebbe continuare descrivendo la storia del luogo, le specialità culinarie da non perdere, e le attività da svolgere nei dintorni. Vogliamo offrire al lettore un'esperienza completa e coinvolgente.";
                $article['gallery'] = [
                    'https://placehold.co/600x400/cccccc/333?text=Foto+1',
                    'https://placehold.co/600x400/cccccc/333?text=Foto+2',
                    'https://placehold.co/600x400/cccccc/333?text=Foto+3',
                ];
                $article['city_name'] = 'Tropea'; // Mock data
                $article['city_link'] = 'provincia.php?id=4'; // Mock data
                $article['contacts'] = ['phone' => '1234567890', 'whatsapp' => '1234567890', 'email' => 'info@example.com'];
                $article['comments'] = [
                    ['author' => 'Marco Rossi', 'rating' => 5, 'comment' => 'Posto fantastico! Una guida davvero utile.'],
                    ['author' => 'Giulia Bianchi', 'rating' => 4, 'comment' => 'Bellissimo articolo, ma avrei gradito più foto.'],
                ];
                return $article;
            }
        }
        return null;
    }

    /**
     * Fetches all provinces.
     * @return array
     */
    public function getProvinces() {
        return [
            ['id' => 1, 'name' => 'Cosenza', 'description' => 'La provincia più estesa, dal Pollino alla Sila.', 'image' => 'https://placehold.co/400x300/005c99/ffffff?text=Cosenza', 'article_count' => 45],
            ['id' => 2, 'name' => 'Catanzaro', 'description' => 'Il cuore della Calabria, tra due mari.', 'image' => 'https://placehold.co/400x300/005c99/ffffff?text=Catanzaro', 'article_count' => 30],
            ['id' => 3, 'name' => 'Reggio Calabria', 'description' => 'La città dello Stretto e dei Bronzi di Riace.', 'image' => 'https://placehold.co/400x300/005c99/ffffff?text=Reggio+C.', 'article_count' => 55],
            ['id' => 4, 'name' => 'Vibo Valentia', 'description' => 'La Costa degli Dei e un mare incantevole.', 'image' => 'https://placehold.co/400x300/005c99/ffffff?text=Vibo+V.', 'article_count' => 25],
            ['id' => 5, 'name' => 'Crotone', 'description' => 'Storia antica e aree marine protette.', 'image' => 'https://placehold.co/400x300/005c99/ffffff?text=Crotone', 'article_count' => 20],
        ];
    }

    /**
     * Fetches a single province by its ID.
     * @param int $id
     * @return array|null
     */
    public function getProvinceById($id) {
        $provinces = $this->getProvinces();
        foreach ($provinces as $province) {
            if ($province['id'] == $id) {
                return $province;
            }
        }
        return null;
    }

    /**
     * Fetches cities for a given province ID.
     * @param int $province_id
     * @return array
     */
    public function getCitiesByProvinceId($province_id) {
        $all_cities = [
            ['id' => 1, 'name' => 'Cosenza', 'province_id' => 1, 'lat' => 39.2983, 'lng' => 16.2539],
            ['id' => 2, 'name' => 'Rende', 'province_id' => 1, 'lat' => 39.3308, 'lng' => 16.1843],
            ['id' => 3, 'name' => 'Paola', 'province_id' => 1, 'lat' => 39.3621, 'lng' => 16.0378],
            ['id' => 4, 'name' => 'Catanzaro', 'province_id' => 2, 'lat' => 38.9093, 'lng' => 16.5876],
            ['id' => 5, 'name' => 'Lamezia Terme', 'province_id' => 2, 'lat' => 38.9667, 'lng' => 16.3167],
            ['id' => 6, 'name' => 'Soverato', 'province_id' => 2, 'lat' => 38.6833, 'lng' => 16.5500],
            ['id' => 7, 'name' => 'Reggio Calabria', 'province_id' => 3, 'lat' => 38.1147, 'lng' => 15.6503],
            ['id' => 8, 'name' => 'Scilla', 'province_id' => 3, 'lat' => 38.2500, 'lng' => 15.7167],
            ['id' => 9, 'name' => 'Vibo Valentia', 'province_id' => 4, 'lat' => 38.675, 'lng' => 16.105],
            ['id' => 10, 'name' => 'Tropea', 'province_id' => 4, 'lat' => 38.6782, 'lng' => 15.8959],
            ['id' => 11, 'name' => 'Pizzo', 'province_id' => 4, 'lat' => 38.7333, 'lng' => 16.1667],
            ['id' => 12, 'name' => 'Crotone', 'province_id' => 5, 'lat' => 39.0833, 'lng' => 17.1167],
            ['id' => 13, 'name' => 'Isola di Capo Rizzuto', 'province_id' => 5, 'lat' => 38.9608, 'lng' => 17.0950],
        ];

        return array_filter($all_cities, function($city) use ($province_id) {
            return $city['province_id'] == $province_id;
        });
    }

    /**
     * Fetches a static page by its slug.
     * @param string $slug
     * @return array|null
     */
    public function getPageBySlug($slug) {
        $pages = [
            'chi-siamo' => [
                'title' => 'Chi Siamo',
                'meta_description' => 'Scopri la storia e la missione di Passione Calabria.',
                'content' => '<h1>Chi Siamo</h1><p>Passione Calabria è un progetto nato dall\'amore per la nostra terra. La nostra missione è quella di mostrare al mondo le infinite bellezze della Calabria, promuovendo un turismo consapevole e sostenibile. Crediamo che ogni angolo della nostra regione abbia una storia da raccontare e un\'emozione da regalare.</p>'
            ],
            'contatti' => [
                'title' => 'Contatti',
                'meta_description' => 'Mettiti in contatto con il team di Passione Calabria.',
                'content' => '<h1>Contattaci</h1><p>Hai domande, suggerimenti o vuoi collaborare con noi? Compila il modulo qui sotto o scrivici direttamente ai nostri recapiti. Saremo felici di risponderti il prima possibile.</p>'
            ],
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'meta_description' => 'Leggi la nostra politica sulla privacy.',
                'content' => '<h1>Privacy Policy</h1><p>Questa è la privacy policy del nostro sito. Qui descriviamo come raccogliamo, usiamo e proteggiamo i tuoi dati personali. La tua privacy è molto importante per noi... (contenuto completo della policy)</p>'
            ],
            'termini-di-servizio' => [
                'title' => 'Termini di Servizio',
                'meta_description' => 'Leggi i nostri termini e condizioni di servizio.',
                'content' => '<h1>Termini di Servizio</h1><p>Utilizzando il nostro sito, accetti i nostri termini di servizio. Leggi attentamente questo documento per comprendere le regole e le tue responsabilità... (contenuto completo dei termini)</p>'
            ]
        ];

        return $pages[$slug] ?? null;
    }

    // ===================================================================
    // METHODS FOR ADMIN PANEL
    // ===================================================================

    /**
     * Fetches statistics for the admin dashboard.
     * @return array
     */
    public function getDashboardStats() {
        return [
            'total_articles' => count($this->getAllArticles()),
            'published_articles' => count($this->getAllArticles()) - 1, // Mock
            'total_views' => 125600, // Mock
            'pending_comments' => 5 // Mock
        ];
    }

    /**
     * Fetches the most recent articles for the dashboard.
     * @param int $limit
     * @return array
     */
    public function getRecentArticles($limit = 5) {
        $all_articles = $this->getAllArticles();
        // Add author and status for admin view
        $all_articles[0]['author'] = 'Admin';
        $all_articles[0]['status'] = 'Pubblicato';
        $all_articles[1]['author'] = 'Admin';
        $all_articles[1]['status'] = 'Pubblicato';
        $all_articles[2]['author' => 'JulesAdmin';
        $all_articles[2]['status'] = 'Bozza';
        $all_articles[3]['author'] = 'Admin';
        $all_articles[3]['status'] = 'Pubblicato';

        return array_slice($all_articles, 0, $limit);
    }

    /**
     * Fetches all articles with details for list pages.
     * @return array
     */
    public function getAllArticles() {
        return [
            ['id' => 1, 'title' => 'Tropea: La Perla del Tirreno', 'slug' => 'tropea-la-perla-del-tirreno', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Tropea', 'excerpt' => 'Un viaggio alla scoperta di Tropea, con le sue spiagge bianche e il centro storico mozzafiato.', 'rating' => 4.8, 'votes' => 120],
            ['id' => 2, 'title' => 'Scilla: Il Mito di Cariddi', 'slug' => 'scilla-il-mito-di-cariddi', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Scilla', 'excerpt' => 'Esplora il borgo di Chianalea e rivivi il mito di Scilla e Cariddi.', 'rating' => 4.5, 'votes' => 95],
            ['id' => 3, 'title' => 'Parco Nazionale della Sila', 'slug' => 'parco-nazionale-della-sila', 'image' => 'https://placehold.co/400x300/cccccc/333?text=Sila', 'excerpt' => 'Natura incontaminata, laghi e sentieri nel cuore della Calabria.', 'rating' => 4.7, 'votes' => 80],
            ['id' => 4, 'title' => 'La \'Nduja di Spilinga', 'slug' => 'la-nduja-di-spilinga', 'image' => 'https://placehold.co/400x300/cccccc/333?text=\'Nduja', 'excerpt' => 'Un viaggio nel gusto del salume più famoso e piccante della Calabria.', 'rating' => 4.9, 'votes' => 250],
        ];
    }

    /**
     * Fetches all cities with coordinates for the map.
     * @return array
     */
    public function getCities() {
        return [
            ['name' => 'Reggio Calabria', 'lat' => 38.1147, 'lng' => 15.6503, 'link' => 'provincia.php?id=3'],
            ['name' => 'Cosenza', 'lat' => 39.2983, 'lng' => 16.2539, 'link' => 'provincia.php?id=1'],
            ['name' => 'Catanzaro', 'lat' => 38.9093, 'lng' => 16.5876, 'link' => 'provincia.php?id=2'],
            ['name' => 'Tropea', 'lat' => 38.6782, 'lng' => 15.8959, 'link' => 'articolo.php?slug=tropea-la-perla-del-tirreno'],
        ];
    }

    /**
     * Fetches subscription packages.
     * @return array
     */
    public function getPackages() {
        return [
            [
                'name' => 'Pacchetto Base',
                'price' => '29€/anno',
                'features' => ['Visibilità nella tua città', 'Scheda base', '10 Foto', 'Nessuna recensione'],
                'id' => 1
            ],
            [
                'name' => 'Pacchetto Pro',
                'price' => '99€/anno',
                'features' => ['Visibilità in tutta la provincia', 'Scheda Pro con link social', 'Foto illimitate', 'Gestione Recensioni', 'Statistiche base'],
                'id' => 2
            ],
            [
                'name' => 'Pacchetto Premium',
                'price' => '199€/anno',
                'features' => ['Visibilità in tutta la regione', 'Scheda Premium in evidenza', 'Foto e Video illimitati', 'Gestione Recensioni Avanzata', 'Statistiche complete'],
                'id' => 3
            ],
        ];
    }
}

// Global instance of the DB class
$db = new DB();

?>
