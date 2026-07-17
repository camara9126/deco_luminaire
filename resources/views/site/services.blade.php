<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ndar Luminaire Déco · Services </title>
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
      --vert-emeraude: #18019b;
      --blanc-casse: #FDF5E6;
      --gris-elegant: #2c2c2c;
      --ombre-legere: rgba(0, 0, 0, 0.03);
      --ombre-doree: rgba(212, 175, 55, 0.15);
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: var(--blanc-casse);
      color: var(--gris-elegant);
      line-height: 1.6;
    }
    h1, h2, h3, h4 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      letter-spacing: -0.02em;
    }
    
    /* Logo avec image réelle */
    .logo-njeeygu {
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
    .nav-link.active {
      font-weight: 600;
    }
    
    /* Boutons compacts */
    .btn-rouge, .btn-or {
      padding: 8px 20px;
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
      background: #d3d3c5;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(139,0,0,0.3);
    }
    .btn-or:hover {
      background: #b8960f;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(212,175,55,0.3);
    }
    
    /* Hero Services amélioré - VERSION COMPACTE */
    .hero-services {
      background:  url('images/Baniere\ 4.png') no-repeat;
      background-size: cover;
      background-position: center;
      color: white;
      padding: 40px 0 50px; /* Réduit de 80px/100px à 40px/50px */
      position: relative;
      text-align: center; /* Texte centré */
    }
    .hero-services h1 {
      font-size: 2.5rem; /* Réduit de 3.5rem à 2.5rem */
      color: var(--or-eclatant);
      font-weight: 800;
      margin-bottom: 0.75rem;
    }
    .hero-services p {
      font-size: 1rem; /* Réduit de 1.1rem à 1rem */
      max-width: 700px;
      opacity: 0.95;
      margin-left: auto;
      margin-right: auto; /* Centrer le paragraphe */
    }
    .hero-badge {
      display: inline-block;
      background: rgba(212,175,55,0.15);
      border: 1px solid var(--or-eclatant);
      padding: 0.2rem 1.2rem; /* Réduit légèrement */
      border-radius: 30px;
      font-size: 0.7rem; /* Réduit de 0.8rem à 0.7rem */
      letter-spacing: 1px;
      margin-bottom: 1rem; /* Réduit de 1.5rem à 1rem */
    }
    .hero-services .d-flex {
      justify-content: center; /* Centrer les boutons */
    }
    
    /* Cards services améliorées */
    .service-card {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 15px 30px var(--ombre-legere);
      transition: all 0.3s ease;
      height: 100%;
      border: 1px solid rgba(212,175,55,0.1);
    }
    .service-card:hover {
      transform: translateY(-10px);
      border-color: var(--or-eclatant);
      box-shadow: 0 25px 45px var(--ombre-doree);
    }
    .service-card-header {
      padding: 25px;
      background: linear-gradient(135deg, var(--rouge-profond), #6b0000);
      color: white;
      position: relative;
      text-align: center;
      border-bottom: 3px solid var(--or-eclatant);
    }
    .service-card-header i {
      font-size: 2.8rem;
      color: var(--or-eclatant);
      margin-bottom: 0.8rem;
    }
    .service-card-header h3 {
      color: white;
      font-size: 1.5rem;
      margin-bottom: 0;
    }
    .service-content {
      padding: 1.8rem;
    }
    .service-features {
      list-style: none;
      padding: 0;
      margin-bottom: 1.5rem;
    }
    .service-features li {
      margin-bottom: 0.8rem;
      font-size: 0.9rem;
      display: flex;
      align-items: center;
    }
    .service-features i {
      color: var(--vert-emeraude);
      width: 22px;
      font-size: 0.9rem;
      margin-right: 0.8rem;
    }
    .service-price {
      font-size: 1.8rem;
      color: var(--rouge-profond);
      font-weight: 700;
      font-family: 'Playfair Display', serif;
      text-align: center;
      margin: 1.2rem 0;
      border-top: 1px dashed rgba(212,175,55,0.3);
      padding-top: 1.2rem;
    }
    .service-price small {
      font-size: 0.9rem;
      color: #666;
      font-weight: 400;
    }
    
    /* Timeline améliorée */
    .timeline {
      position: relative;
      padding: 40px 0;
    }
    .timeline::before {
      content: '';
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      width: 2px;
      height: 100%;
      background: linear-gradient(to bottom, var(--or-eclatant), var(--rouge-profond));
    }
    .timeline-item {
      position: relative;
      margin-bottom: 40px;
    }
    .timeline-content {
      background: white;
      padding: 25px;
      border-radius: 20px;
      box-shadow: 0 10px 25px var(--ombre-legere);
      position: relative;
      width: 45%;
      border: 1px solid rgba(212,175,55,0.1);
      transition: all 0.3s ease;
    }
    .timeline-content:hover {
      border-color: var(--or-eclatant);
      box-shadow: 0 15px 35px var(--ombre-doree);
      transform: translateY(-5px);
    }
    .timeline-item:nth-child(odd) .timeline-content {
      margin-left: auto;
    }
    .timeline-item::before {
      content: '';
      position: absolute;
      top: 30px;
      width: 16px;
      height: 16px;
      background: var(--or-eclatant);
      border: 3px solid var(--rouge-profond);
      border-radius: 50%;
      z-index: 2;
      left: 50%;
      transform: translateX(-50%);
    }
    .timeline-content h3 {
      color: var(--rouge-profond);
      font-size: 1.3rem;
      margin-bottom: 0.8rem;
    }
    .timeline-content p {
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 0;
    }
    
    /* Section Galerie avec descriptions */
    .gallery-item {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 15px var(--ombre-legere);
      border: 2px solid rgba(212,175,55,0.15);
      transition: all 0.3s ease;
    }
    .gallery-item:hover {
      border-color: var(--or-eclatant);
      box-shadow: 0 15px 25px var(--ombre-doree);
    }
    .gallery-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      transition: transform 0.5s ease;
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
      padding: 1rem 0.8rem 0.5rem;
      transform: translateY(100%);
      transition: transform 0.4s ease;
    }
    .gallery-item:hover .gallery-overlay {
      transform: translateY(0);
    }
    .gallery-overlay h4 {
      color: var(--or-eclatant);
      font-size: 0.9rem;
      margin-bottom: 0.1rem;
      font-weight: 700;
    }
    .gallery-overlay p {
      font-size: 0.7rem;
      margin-bottom: 0;
      opacity: 0.9;
      line-height: 1.2;
    }
    
    /* Sections */
    section {
      padding: 60px 0;
    }
    .section-title {
      font-size: 2.5rem;
      color: var(--rouge-profond);
      margin-bottom: 0.5rem;
    }
    .section-subtitle {
      font-size: 1rem;
      color: #666;
      margin-bottom: 2.5rem;
    }
    
    /* Footer compact */
    footer {
      background: var(--rouge-profond);
      color: var(--blanc-casse);
      padding: 40px 0 20px;
      border-top: 2px solid var(--or-eclatant);
      margin-top: 60px;
    }
    .footer-title {
      color: var(--or-eclatant);
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 15px;
    }
    .social-links a {
      width: 32px;
      height: 32px;
      background: rgba(212,175,55,0.1);
      color: var(--or-eclatant);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-right: 8px;
      border: 1px solid var(--or-eclatant);
      transition: all 0.2s;
      text-decoration: none;
    }
    .social-links a:hover {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      transform: translateY(-3px);
    }
    .footer-links a {
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      transition: color 0.2s;
      font-size: 0.9rem;
      line-height: 2;
    }
    .footer-links a:hover {
      color: var(--or-eclatant);
    }
    
    /* Divider */
    .divider {
      width: 60px;
      height: 2px;
      background: var(--or-eclatant);
      margin: 1rem 0 1.5rem;
    }
    
    /* Container */
    .container {
      max-width: 1140px;
    }
  </style>
</head>
<body>
  <!-- Navigation compacte -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <div class="logo-njeeygu">
          <!-- Logo image réelle -->
          <img src="images/logo ndar lum.png" 
               alt="NJEEYGU Logo" 
               class="logo-image"
               onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop&w=200&h=200&fit=crop';">
          <div class="logo-text">
            Ndar Luminaire Déco
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

  <!-- Hero Services amélioré - VERSION COMPACTE ET CENTRÉE -->
  <div class="hero-services">
    <div class="container">
      <span class="hero-badge"><i class="fas fa-crown me-2"></i>DEVIS SUR-MESURE</span>
      <h1 class="display-3 fw-bold">Nos Prestations</h1>
      <p class="fs-5 mb-3">Ndar Luminaire Déco ne se contente pas de vous vendre du matériel.
         Nous concevons pour vous des espaces lumineux, des intérieurs élégants et nous vous fournissons les meilleurs outils de quincaillerie pour la réussite de vos projets et chantiers à Saint-Louis.</p>
      <div class="d-flex gap-3 mt-4">
        <a href="#services" class="btn btn-or">Nos Services</a>
        <a href="{{ route('contact') }}" class="btn btn-rouge">Devis</a>
      </div>
    </div>
  </div>

  <!-- Introduction Services -->
  <section id="services">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Des expertises complètes</h2>
        <p class="section-subtitle">Pour tous vos espaces, nous concevons l'optimisation parfaite.</p>
      </div>
      <div class="row align-items-center g-4 mb-5">
        <div class="col-lg-6">
          <img src="SerHead/serv2.png" alt="Décoration événement" class="img-fluid rounded-4 shadow" style="border: 2px solid rgba(212,175,55,0.2);">
        </div>
        <div class="col-lg-6">
          <h3 class="h2" style="color: var(--rouge-profond);">L'art de l'aménagement et du confort</h3>
          <div class="divider"></div>
          <p class="mb-3">Chaque maison, boutique ou chantier raconte une histoire unique. Notre équipe, sous la direction de M. Cheikh Moustapha Diop,
             met son savoir-faire à votre service pour déployer des solutions d’éclairage esthétiques, des agencements de décoration raffinés et des
              fournitures de quincaillerie fiables qui reflètent la sécurité, la performance et l'élégement au cœur de votre quotidien.</p>
          <div class="row mt-4">
            <div class="col-6">
              <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="color: var(--or-eclatant);"></i>
                <span><strong>Matériel Garanti & Durable</strong> </span>
              </div>
            </div>
            <div class="col-6">
              <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2" style="color: var(--or-eclatant);"></i>
                <span><strong>100% Satisfaction Client</strong>  </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Cards avec images et descriptions détaillées -->
  <section class="bg-white">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Nos offres</h2>
        <p class="section-subtitle">Des formules adaptées à chaque demande</p>
      </div>
      <div class="row g-4">
        <!-- Service Mariage -->
        <div class="col-lg-4">
          <div class="service-card">
            <div class="service-card-header">
              <i class="fas fa-heart"></i>
              <h3>Éclairage & Luminaires</h3>
            </div>
            <div class="service-content">
              <img src="images/servlumi.jpg" alt="Mariage" class="img-fluid rounded-3 mb-3" style="height: 150px; width: 100%; object-fit: cover;">
              <p class="small text-muted mb-3">Texte court en bas : Vente et étude d'implantation de luminaires intérieurs et extérieurs. Nous optimisons la clarté de vos pièces avec des technologies LED à basse consommation.</p>
             
              
              <a href="{{ route('contact') }}" class="btn btn-rouge w-100">Demander un devis</a>
            </div>
          </div>
        </div>
        <!-- Service Professionnel -->
        <div class="col-lg-4">
          <div class="service-card">
            <div class="service-card-header">
              <i class="fas fa-briefcase"></i>
              <h3>Décoration & Design</h3>
            </div>
            <div class="service-content">
              <img src="images/decointerieure.jpg" alt="Événement professionnel" class="img-fluid rounded-3 mb-3" style="height: 150px; width: 100%; object-fit: cover;">
              <p class="small text-muted mb-3"> Vente d'articles tendance et service complet d'aménagement d'intérieur. Nous transformons vos espaces pour les rendre chaleureux et uniques.</p>
             
              
              <a href="{{ route('contact') }}" class="btn btn-rouge w-100">Demander un devis</a>
            </div>
          </div>
        </div>
        <!-- Service Privé -->
        <div class="col-lg-4">
          <div class="service-card">
            <div class="service-card-header">
              <i class="fas fa-glass-cheers"></i>
              <h3>Quincaillerie Générale</h3>
            </div>
            <div class="service-content">
              <img src="images/quincail.jpg" alt="Événement privé" class="img-fluid rounded-3 mb-3" style="height: 150px; width: 100%; object-fit: cover;">
              <p class="small text-muted mb-3">Fourniture d'outillage, visserie et matériaux robustes pour professionnels du BTP et particuliers. Tout le nécessaire pour vos travaux.</p>
              
              
              <a href="boutique.html" class="btn btn-rouge w-100">Boutique</a>
            </div>
          </div>  
        </div>
      </div>
    </div>
  </section>

  <!-- Galerie de réalisations avec descriptions -->

 <!--  <section>
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Quelques réalisations</h2>
        <p class="section-subtitle">Des ambiances uniques pour des moments inoubliables</p>
      </div>
      <div class="row g-3">
        <div class="col-md-3 col-6">
          <div class="gallery-item">
            <img src="images/26.jpeg" alt="Mariage" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Mariage traditionnel</h4>
              <p>Décoration rouge & or pour Fatou & Amadou - 150 invités</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="gallery-item">
            <img src="images/27.jpeg" alt="Baptême" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Baptême élégant</h4>
              <p>Ambiance blanche & dorée - 80 invités, coussins personnalisés</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="gallery-item">
            <img src="images/29.jpeg" alt="Réception" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Réception privée</h4>
              <p>Anniversaire surprise - éclairage tamisé et vaisselle prestige</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="gallery-item">
            <img src="images/20.jpeg" alt="Décoration" class="gallery-img">
            <div class="gallery-overlay">
              <h4>Soirée d'entreprise</h4>
              <p>Inauguration - 200 personnes, décoration moderne et lounge</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>  -->

 

  <!-- Pourquoi nous choisir -->
  <section>
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6">
          <h4 class="section-title">Pourquoi nous faire confiance ?</h4>
          <div class="divider"></div>
          <p class="mb-4"> Depuis notre installation à Saint-Louis (en face de la pharmacie), nous accompagnons les particuliers
             et les professionnels du Sénégal avec rigueur, passion et professionnalisme pour donner vie à leurs idées d'aménagement et de construction.</p>
          <div class="row">
            <div class="col-6 mb-3">
              <div class="d-flex">
                <i class="fas fa-star fa-2x me-3" style="color: var(--or-eclatant);"></i>
                <div>
                  <h4 class="h6 fw-bold mb-0">Excellence</h4>
                  <small class="text-muted">Reconnue dans le secteur pour la qualité premium de nos produits de décoration et nos luminaires.</small>
                </div>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="d-flex">
                <i class="fas fa-clock fa-2x me-3" style="color: var(--or-eclatant);"></i>
                <div>
                  <h4 class="h6 fw-bold mb-0">Réactivité</h4>
                  <small class="text-muted">Traitement rapide de vos demandes de devis et livraison de vos matériels de quincaillerie.</small>
                </div>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="d-flex">
                <i class="fas fa-smile fa-2x me-3" style="color: var(--or-eclatant);"></i>
                <div>
                  <h4 class="h6 fw-bold mb-0">Conseil Sur-Mesure</h4>
                  <small class="text-muted">Un accompagnement personnalisé pour choisir l'ambiance et les outils parfaits.</small>
                </div>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="d-flex">
                <i class="fas fa-hand-holding-heart fa-2x me-3" style="color: var(--or-eclatant);"></i>
                <div>
                  <h4 class="h6 fw-bold mb-0">Service Après-Vente</h4>
                  <small class="text-muted">Suivi rigoureux de vos commandes et conseils de pose pour l'ensemble de nos articles.</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <img src="images/logo ndar lum.png" alt="Équipe" class="img-fluid rounded-4 shadow">
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="py-4" style="background: var(--rouge-profond);">
    <div class="container text-center text-white">
      <h3 class="fw-bold mb-2">Prêt pour votre transformation ?</h3>
      <p class="small opacity-75 mb-3">Conseils, devis et étude personnalisée de vos projets en boutique.</p>
      <a href="{{ route('contact') }}" class="btn btn-or btn-sm px-4">Demander un devis</a>
    </div>
  </section>

  <!-- Footer compact -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-3">
          <div class="logo-njeeygu mb-2">
            <!-- Petit logo dans footer -->
            <img src="images/logo ndar lum.png" 
                 alt="NJEEYGU Logo" 
                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--or-eclatant);"
                 onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop&w=200&h=200&fit=crop';">
            <span style="color: var(--or-eclatant); font-weight: 600; margin-left: 8px;">REGILEC</span>
          </div>
          <p class="small opacity-75"> Chaque maison, boutique ou chantier raconte une histoire unique. Notre équipe, met son savoir-faire à votre
             service pour déployer des solutions d’éclairage esthétiques, des agencements de décoration raffinés et des fournitures de quincaillerie fiables
              qui reflètent la sécurité, la performance et l'élégement au cœur de votre quotidien.</p>
          <div class="small">
            <i class="fas fa-map-marker-alt me-1" style="color: var(--or-eclatant);"></i> Saint-Louis, Sénégal<br>
            <i class="fas fa-phone me-1" style="color: var(--or-eclatant);"></i> +221 77 674 21 46<br>
            <i class="fas fa-envelope me-1" style="color: var(--or-eclatant);"></i> contact@ndarluminairedeco.com
          </div>
        </div>
        <div class="col-lg-4 mb-3">
          <h5 class="footer-title">Liens rapides</h5>
          <div class="footer-links">
            <div><a href="index.html">Accueil</a></div>
            <div><a href="boutique.html">Boutique</a></div>
            <div><a href="services.html">Services</a></div>
            <div><a href="apropos.html">À propos</a></div>
            <div><a href="{{ route('contact') }}">Contact</a></div>
          </div>
        </div>
        <div class="col-lg-4 mb-3">
          <h5 class="footer-title">Suivez-nous</h5>
          <div class="social-links mb-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
          <p class="small opacity-75 mb-0">Copyright ©2026 Tous droits réservés | Ce site est réalisé par BCM-GROUPE</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>