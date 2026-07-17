<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ndar Luminaire Déco</title>
  <meta name="google-site-verification" content="WhFounBUvL8lYCdjabRKBFmKEvzMrFXhK7qXd0Ht2wI" />
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!-- Icon Logo -->
  <link rel="shortcut icon" href="images/logo ndar lum.png"/>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --rouge-profond: #18019b;
      --or-eclatant: #ff9d1b;
      color: #1e2a2e;
      --vert-emeraude: #150792;
      --blanc-casse: #FDF5E6;
      --gris-elegant: #2c2c2c;
      --ombre-legere: rgba(33, 11, 155, 0.03);
      --ombre-doree: rgba(212, 175, 55, 0.15);
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: var(--blanc-casse);
      color: var(--gris-elegant);
      line-height: 1.6;
    }
    h1, h2, h3 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      letter-spacing: -0.02em;
    }
    
    /* Logo avec image réelle */
    .logo-ndarLD {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .logo-image {
      width: 42px;
      height: 42px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--or-eclatant);
      box-shadow: 0 3px 10px rgba(139,0,0,0.2);
      background: white;
    }
    .logo-text {
      font-weight: 700;
      color: var(--rouge-profond);
      line-height: 1;
      font-size: 1.1rem;
    }
    .logo-text .le-grand-jour {
      display: block;
      font-size: 0.55rem;
      font-weight: 500;
      color: var(--blanc-casse);
      background: var(--rouge-profond);
      padding: 0.1rem 0.6rem;
      border-radius: 20px;
      letter-spacing: 1px;
      margin-top: 2px;
    }
    
    /* Navbar ultra compacte */
    .navbar {
      background: var(--blanc-casse) !important;
      border-bottom: 1px solid rgba(212, 175, 55, 0.15);
      padding: 0.2rem 0;
      box-shadow: 0 2px 10px var(--ombre-legere);
    }
    .nav-link {
      color: var(--rouge-profond) !important;
      font-weight: 500;
      margin: 0 6px;
      padding: 0.2rem 0 !important;
      font-size: 0.8rem;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      transition: color 0.2s;
    }
    .nav-link:hover,
    .nav-link.active {
      color: var(--or-eclatant) !important;
    }
    
    /* Boutons compacts */
    .btn-rouge, .btn-or {
      padding: 5px 18px;
      font-size: 0.8rem;
      font-weight: 600;
      border-radius: 30px;
      transition: all 0.2s;
      border: none;
    }
    .btn-rouge {
      background: var(--rouge-profond);
      color: var(--blanc-casse);
      box-shadow: 0 3px 10px rgba(139,0,0,0.2);
    }
    .btn-or {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      box-shadow: 0 3px 10px rgba(212,175,55,0.2);
    }
    .btn-rouge:hover {
      background: #6b0000;
      transform: translateY(-1px);
    }
    .btn-or:hover {
      background: #b8960f;
      transform: translateY(-1px);
    }
    
    /* Hero section équilibrée */
    .hero-accueil {
      background: 
       url('images/Banniere\ 1.png') no-repeat;
      background-size: cover;
      background-position: center;
      padding: 80px 0 90px;
      color: var(--blanc-casse);
    }
    .hero-accueil h1 {
      font-size: 3.2rem;
      font-weight: 800;
      color: var(--or-eclatant);
      margin-bottom: 0.8rem;
      line-height: 1.1;
    }
    .hero-accueil p {
      font-size: 1rem;
      max-width: 600px;
      margin: 0 auto 1.2rem;
      opacity: 0.95;
    }
    .hero-badge {
      display: inline-block;
      background: rgba(212,175,55,0.15);
      border: 1px solid var(--or-eclatant);
      padding: 0.2rem 1.2rem;
      border-radius: 30px;
      font-size: 0.7rem;
      letter-spacing: 1px;
      margin-bottom: 1.2rem;
    }
    
    /* Corps de page amélioré - Cards élégantes et aérées */
    .card-avantage {
      background: white;
      padding: 2rem 1.5rem;
      border-radius: 24px;
      text-align: center;
      border: 1px solid rgba(212,175,55,0.1);
      height: 100%;
      transition: all 0.3s;
      box-shadow: 0 8px 20px var(--ombre-legere);
    }
    .card-avantage:hover {
      transform: translateY(-5px);
      border-color: var(--or-eclatant);
      box-shadow: 0 15px 30px var(--ombre-doree);
    }
    .card-avantage i {
      font-size: 2.5rem;
      color: var(--or-eclatant);
      margin-bottom: 1rem;
    }
    .card-avantage h3 {
      font-size: 1.2rem;
      margin-bottom: 0.8rem;
      color: var(--rouge-profond);
    }
    .card-avantage p {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 0;
      line-height: 1.6;
    }
    
    /* Témoignages améliorés - version CARROUSEL */
    .temoignage-card {
      background: white;
      padding: 1.8rem;
      border-radius: 24px;
      border: 1px solid rgba(212,175,55,0.1);
      height: 100%;
      transition: all 0.3s;
      box-shadow: 0 8px 20px var(--ombre-legere);
      text-align: center;
      margin: 10px;
    }
    .temoignage-card:hover {
      border-color: var(--or-eclatant);
      box-shadow: 0 15px 30px var(--ombre-doree);
    }
    .temoignage-card p {
      font-size: 0.95rem;
      font-style: italic;
      margin-bottom: 1.2rem;
      color: #444;
      line-height: 1.7;
    }
    .temoignage-card h5 {
      font-size: 1rem;
      margin-bottom: 0.2rem;
      color: var(--rouge-profond);
    }
    
    /* Contrôles du carrousel pour témoignages */
    .carousel-control-prev,
    .carousel-control-next {
      width: 40px;
      height: 40px;
      background: var(--or-eclatant);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0.8;
    }
    .carousel-control-prev {
      left: -20px;
    }
    .carousel-control-next {
      right: -20px;
    }
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      opacity: 1;
      background: var(--rouge-profond);
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      filter: brightness(0) invert(1);
    }
    .carousel-indicators {
      bottom: -40px;
    }
    .carousel-indicators button {
      background-color: var(--or-eclatant) !important;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      margin: 0 5px;
    }
    .carousel-indicators button.active {
      background-color: var(--rouge-profond) !important;
    }
    
    /* Sections avec proportions équilibrées */
    section {
      padding: 50px 0;
    }
    .section-title {
      font-size: 2.3rem;
      margin-bottom: 0.3rem;
      color: var(--rouge-profond);
    }
    .section-subtitle {
      font-size: 0.95rem;
      color: #666;
      margin-bottom: 2rem;
      font-weight: 300;
    }
    
    /* Images élégantes */
    .img-elegante {
      border-radius: 20px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      width: 100%;
      height: 280px;
      object-fit: cover;
      border: 2px solid rgba(212,175,55,0.2);
      transition: all 0.3s ease;
    }
    .img-elegante:hover {
      transform: scale(1.02);
      border-color: var(--or-eclatant);
      box-shadow: 0 20px 40px rgba(139,0,0,0.15);
    }
    
    /* Galerie d'images avec descriptions */
    .gallery-item {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .gallery-img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: transform 0.5s ease;
      border: 2px solid rgba(212,175,55,0.2);
      border-radius: 20px;
    }
    .gallery-item:hover .gallery-img {
      transform: scale(1.05);
    }
    .gallery-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: linear-gradient(to top, rgba(139,0,0,0.9), transparent);
      color: var(--blanc-casse);
      padding: 1.5rem 1rem 1rem;
      border-radius: 0 0 20px 20px;
      transform: translateY(100%);
      transition: transform 0.4s ease;
    }
    .gallery-item:hover .gallery-overlay {
      transform: translateY(0);
    }
    .gallery-overlay h4 {
      color: var(--or-eclatant);
      font-size: 1.1rem;
      margin-bottom: 0.3rem;
    }
    .gallery-overlay p {
      font-size: 0.8rem;
      margin-bottom: 0;
      opacity: 0.9;
    }
    
    /* Services avec descriptions - 2 PAR LIGNE SUR TOUS LES ÉCRANS */
    .service-card {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 10px 25px var(--ombre-legere);
      border: 1px solid rgba(212,175,55,0.1);
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }
    .service-card:hover {
      transform: translateY(-8px);
      border-color: var(--or-eclatant);
      box-shadow: 0 20px 35px var(--ombre-doree);
    }
    .service-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-bottom: 3px solid var(--or-eclatant);
    }
    .service-content {
      padding: 1.5rem;
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .service-content h4 {
      color: var(--rouge-profond);
      font-size: 1.2rem;
      margin-bottom: 0.8rem;
      font-weight: 700;
    }
    .service-content p {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 1rem;
      line-height: 1.6;
    }
    .service-features {
      list-style: none;
      padding: 0;
      margin: 0;
      margin-top: auto;
    }
    .service-features li {
      font-size: 0.85rem;
      margin-bottom: 0.4rem;
      color: #666;
    }
    .service-features i {
      color: var(--or-eclatant);
      width: 20px;
      font-size: 0.8rem;
      margin-right: 0.5rem;
    }
    
    /* 2 colonnes sur tous les écrans */
    .service-col {
      flex: 0 0 auto;
      width: 33%;
      margin: auto;
    }
    
    /* Ajustements pour mobile */
    @media (max-width: 768px) {
      .service-img {
        height: 140px; /* Images plus petites sur mobile */
      }
      
      .service-content {
        padding: 1rem;
      }
      
      .service-content h4 {
        font-size: 1rem;
        margin-bottom: 0.5rem;
      }
      
      .service-content p {
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limite le texte à 2 lignes */
        -webkit-box-orient: vertical;
        overflow: hidden;
      }
      
      .service-features li {
        font-size: 0.7rem;
        margin-bottom: 0.2rem;
      }
      
      .service-features i {
        font-size: 0.7rem;
        width: 16px;
      }
    }
    
    /* CTA compact */
    .cta-section {
      background: var(--rouge-profond);
      padding: 40px 0;
    }
    
    /* Footer ultra compact */
    footer {
      background: var(--rouge-profond);
      color: var(--blanc-casse);
      padding: 30px 0 15px;
      border-top: 2px solid var(--or-eclatant);
      font-size: 0.8rem;
    }
    .footer-title {
      color: var(--or-eclatant);
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 12px;
      letter-spacing: 0.5px;
    }
    .social-links a {
      width: 30px;
      height: 30px;
      background: rgba(212,175,55,0.1);
      color: var(--or-eclatant);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 5px;
      border: 1px solid var(--or-eclatant);
      font-size: 0.8rem;
      transition: all 0.2s;
      text-decoration: none;
    }
    .social-links a:hover {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      transform: translateY(-2px);
    }
    .footer-links a {
      color: rgba(255,255,255,0.7);
      text-decoration: none;
      transition: color 0.2s;
      line-height: 1.8;
    }
    .footer-links a:hover {
      color: var(--or-eclatant);
    }
    
    /* Ligne décorative */
    .divider-small {
      width: 50px;
      height: 2px;
      background: var(--or-eclatant);
      margin: 1rem 0 1.5rem;
    }
    
    /* Espacement optimisé */
    .container {
      max-width: 1140px;
    }
    .row {
      --bs-gutter-x: 1.5rem;
    }
    
    /* Ajustement pour mobile du carrousel */
    @media (max-width: 768px) {
      .carousel-control-prev,
      .carousel-control-next {
        width: 30px;
        height: 30px;
      }
      .carousel-control-prev {
        left: -5px;
      }
      .carousel-control-next {
        right: -5px;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation ultra compacte -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <div class="logo-ndarLD">
          <!-- Logo image réelle -->
          <img src="images/logo ndar lum.png" alt="ndarLD Logo" class="logo-image" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop&w=200&h=200&fit=crop';">
          <div class="logo-text">
            NDAR LUMINAIRE DECO
            <span class="le-grand-jour">Eclairage-Décoration-Quincaillerie</span>
          </div>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link active" href="/">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('boutique') }}">Boutique</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('apropos') }}">À propos</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Admin</a></li>
          <li class="nav-item ms-2">
            <a href="{{ route('contact') }}" class="btn btn-or btn-sm">Devis</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero section équilibrée -->
  <section class="hero-accueil">
    <div class="container text-center">
      <span class="hero-badge"><i class="fas fa-star me-1"></i> Saint-Louis</span>
      <h1>Ndar Luminaire Déco</h1>
      <p>Illuminez votre espace, sublimez votre intérieur, construisez l’esprit tranquille.</p>
      <div class="d-flex justify-content-center gap-2">
        <a href="{{ route('contact') }}" class="btn btn-or">Contact</a>
        <a href="boutique.html" class="btn btn-rouge">Boutique</a>
      </div>
    </div>
  </section>

  <!-- Introduction avec image -->
  <section>
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <h2 class="section-title">Bienvenue chez <span style="color: var(--or-eclatant);">Ndar Luminaire Déco</span></h2>
          <div class="divider-small"></div>
          <p class="mb-3">Fondée et dirigée par M. Cheikh Moustapha Diop, Ndar Luminaire Déco est votre adresse de référence
             à Saint-Louis pour tous vos projets de construction, de rénovation et d'aménagement intérieur.
             Plus qu'une simple boutique, nous réunissons sous un même toit trois univers essentiels pour donner vie à vos espaces :
             un choix d'éclairages modernes, des articles et services de décoration raffinés, ainsi qu'un rayon quincaillerie complet
              pour tous vos travaux. Que vous soyez un particulier ou un professionnel, notre équipe vous accompagne avec rigueur et passion
               pour faire de votre environnement un lieu unique, sécurisé et chaleureux.</p>
          <div class="row mt-4">
            <div class="col-6">
              <div class="d-flex align-items-center">
                <i class="fas fa-medal me-2" style="color: var(--or-eclatant);"></i>
                <span><strong>Qualité Garantie :</strong><br><small class="text-muted">Une sélection rigoureuse de matériels durables et esthétiques.</small></span>
              </div>
            </div>
            <div class="col-6">
              <div class="d-flex align-items-center">
                <i class="fas fa-heart me-2" style="color: var(--or-eclatant);"></i>
                <span><strong>Service Client :</strong><br><small class="text-muted">Un accompagnement sur-mesure, de l'achat à la pose de votre décoration.</small></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <img src="images/Apropos.jpg" alt="Mariage élégant" class="img-elegante">
        </div>
      </div>
    </div>
  </section>

  <!-- Section Nos services avec descriptions détaillées - HORIZONTAL PAR 2 SUR TOUS ÉCRANS -->
  <section>
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Nos trois univers pour vos projets</h2>
        <p class="section-subtitle">Des solutions complètes pour sublimer et équiper vos espaces.</p>
      </div>
      <div class="row g-4">
        <!-- Service 1 -->
        <div class="service-col">
          <div class="service-card">
            <img src="images/decointerieure.jpg" alt="Décoration" class="service-img">
            <div class="service-content">
              <h4>Éclairage & Luminaires</h4>
              <p>Apportez de la clarté et du style à vos pièces. Nous proposons une large gamme de matériels d'éclairage intérieurs et extérieurs : 
                spots LED économiques, lustres élégants, appliques murales et solutions d'éclairage architectural adaptées à tous les budgets.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i> Large gamme de produits</li>
                <li><i class="fas fa-check"></i> Économie d’énergie</li>
                <li><i class="fas fa-check"></i>Accompagnement technique</li>
                
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Service 2 -->
        <div class="service-col">
          <div class="service-card">
            <img src="images/servlumi.jpg" alt="Accessoires" class="service-img">
            <div class="service-content">
              <h4>Décoration & Design d'Intérieur</h4>
              <p>Transformez votre espace en un lieu qui vous ressemble. En plus de la vente d'objets de décoration tendance et de mobiliers, 
                nous vous proposons un service d'aménagement et de conseil en décoration personnalisé pour harmoniser vos intérieurs.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i> Vente d'objets tendance</li>
                <li><i class="fas fa-check"></i>Service d'aménagement sur-mesure</li>
                <li><i class="fas fa-check"></i>Conseil en couleurs et matières</li>
                
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Service 3 -->
        <div class="service-col">
          <div class="service-card">
            <img src="images/quincail.jpg" alt="Événementiel" class="service-img">
            <div class="service-content">
              <h4>Quincaillerie Générale</h4>
              <p>La solidité et la sécurité au cœur de vos travaux. Retrouvez tout le matériel de quincaillerie fiable et robuste indispensable pour vos chantiers, vos réparations du quotidien et vos finitions professionnelles.</p>
              <ul class="service-features">
                <li><i class="fas fa-check"></i>Matériel de premier choix</li>
                <li><i class="fas fa-check"></i>Solutions pour tous</li>
                <li><i class="fas fa-check"></i> Devis rapide et transparent</li>
                
              </ul>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <!-- Section Nos réalisations avec descriptions -->
  <section>
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Nos réalisations</h2>
        <p class="section-subtitle">Découvrez nos projets phares, reflets de notre savoir-faire et de notre passion.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="images/reali1.jpg" alt="Mariage traditionnel" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Éclairages résidentiels et professionnels</h4>
              <p> Conception de plans de lumière et installation de systèmes de luminaires LED modernes pour des maisons, boutiques et bureaux à Saint-Louis.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="images/reali2.jpg" alt="Baptême" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Aménagements intérieurs sur-mesure</h4>
              <p> Transformation d'espaces de vie et de commerces grâce à nos services de conseil en design, sélection de mobiliers et harmonisation des décors.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="gallery-item">
            <img src="images/reali3.jpg" alt="Réception" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Fourniture complète pour chantiers</h4>
              <p>Accompagnement de projets de construction locaux avec une livraison de matériels de quincaillerie générale et d'outillage de haute qualité.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Avantages - Corps amélioré -->
  <section class="bg-white">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Pourquoi nous choisir ?</h2>
        <p class="section-subtitle">Un partenaire de confiance pour illuminer, décorer et équiper vos espaces.</p>
      </div>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="card-avantage">
            <i class="fas fa-map-marked-alt"></i>
            <h3>Trois univers sous un même toit</h3>
            <p> Plus besoin de courir partout dans Saint-Louis pour vos travaux et votre aménagement. Nous regroupons
               l'éclairage, la décoration haut de gamme et la quincaillerie générale en un seul lieu, juste en face de 
               la pharmacie, pour vous faire gagner du temps et de l'énergie.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-avantage">
            <i class="fas fa-box-open"></i>
            <h3>Expertise et conseils personnalisés</h3>
            <p> Sous la direction de M. Cheikh Moustapha Diop, notre équipe ne se contente pas de vendre du matériel.
               Nous vous apportons un véritable accompagnement technique pour vos choix électriques et des conseils
                sur-mesure pour donner du style à votre intérieur.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-avantage">
            <i class="fas fa-gem"></i>
            <h3>Qualité garantie et devis transparents</h3>
            <p>Nous sélectionnons rigoureusement des produits durables, performants et esthétiques auprès des meilleures marques.
               Que vous soyez un particulier ou un professionnel, nous vous garantissons des tarifs compétitifs et des estimations claires pour tous vos projets.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Témoignages en CARROUSEL -->
  <section class="bg-white">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Ils nous ont fait confiance</h2>
        <p class="section-subtitle">Des Resultats Jste et Economiques</p>
      </div>
      
      <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicateurs -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Témoignage 1"></button>
          <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Témoignage 2"></button>
          <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Témoignage 3"></button>
        </div>
        
        <!-- Slides -->
        <div class="carousel-inner">
          <!-- Slide 1 - Fatou & Amadou -->
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6">
                <div class="temoignage-card">
                  <img src="https://images.unsplash.com/photo-1583939003579-730e1918ee0a?q=80&w=1974&auto=format&fit=crop" alt="Mariage" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--or-eclatant); margin-bottom: 1rem;">
                  <p>"Une baisse immédiate de nos charges électriques. Grâce à l'installation de leur armoire automatique à Mbour, ndarLD a totalement supprimé nos pénalités financières auprès de la SENELEC."</p>
                  <div>
                    <h5 class="mb-0">Mr Camara Amadou</h5>
                    <small class="text-muted">Compensation</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Slide 2 - Marieme Diallo -->
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6">
                <div class="temoignage-card">
                  <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1976&auto=format&fit=crop" alt="Baptême" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--or-eclatant); margin-bottom: 1rem;">
                  <p>"Une rigueur technique absolue sur notre site industriel de Rufisque. Leur audit a permis de restructurer entièrement nos réseaux câblés obsolètes et de sécuriser durablement nos équipes."</p>
                  <div>
                    <h5 class="mb-0">Mme Diallo Marieme </h5>
                    <small class="text-muted">Sécurité</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Slide 3 - Groupe BSO -->
          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-md-8 col-lg-6">
                <div class="temoignage-card">
                  <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=1974&auto=format&fit=crop" alt="Événement pro" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid var(--or-eclatant); margin-bottom: 1rem;">
                  <p>"Des experts de haut niveau. Notre parc d'équipements sensibles subissait des pannes régulières à cause des harmoniques, mais leur diagnostic précis a stabilisé l'ensemble du réseau."</p>
                  <div>
                    <h5 class="mb-0">Groupe BSO</h5>
                    <small class="text-muted">Stabilité</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Contrôles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Suivant</span>
        </button>
      </div>
    </div>
  </section>

  <!-- CTA compact -->
  <section class="cta-section">
    <div class="container text-center text-white">
      <h3 class="fw-bold mb-2">Prêt pour votre transition énergétique ?</h3>
      <p class="small opacity-75 mb-3">Audit? devis et étude technique personnalisée de vos installations.</p>
      <a href="{{ route('contact') }}" class="btn btn-or btn-sm px-4">Demander un Devis</a>
    </div>
  </section>

  <!-- Footer ultra compact -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-2">
          <div class="logo-ndarLD mb-1">
            <!-- Petit logo dans footer -->
            <img src="images/logo ndar lum.png" alt="ndarLD Logo" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid var(--or-eclatant);"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop&w=200&h=200&fit=crop';">
            <span style="color: var(--or-eclatant); font-weight: 600; margin-left: 8px;">ndarLD</span>
          </div>
          <p class="small opacity-75">Votre Partenaire de Qualité</p>
        </div>
        <div class="col-lg-4 mb-2">
          <h5 class="footer-title">Liens</h5>
          <div class="footer-links d-flex gap-3">
            <a href="index.html">Accueil</a>
            <a href="boutique.html">Boutique</a>
            <a href="{{ route('contact') }}">Contact</a>
          </div>
        </div>
        <div class="col-lg-4 mb-2">
          <h5 class="footer-title">Social</h5>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
      </div>
      <hr class="border-light opacity-25 my-2">
      <p class="small opacity-75 text-center mb-0">Copyright ©2026 Tous droits réservés | Ce site est réalisé par BCM-GROUPE</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>