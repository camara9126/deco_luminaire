<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ndar Luminaire Déco · Contact</title>
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
    
    /* Logo avec image */
    .logo-njeeygu {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .logo-image {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--or-eclatant);
      box-shadow: 0 3px 10px rgba(139,0,0,0.2);
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
      padding: 0.1rem 0;
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
      font-size: 0.85rem;
      font-weight: 600;
      border-radius: 40px;
      transition: all 0.3s;
      border: none;
    }
    .btn-rouge {
      background: var(--rouge-profond);
      color: var(--blanc-casse);
      box-shadow: 0 5px 15px rgba(139,0,0,0.3);
    }
    .btn-or {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      box-shadow: 0 5px 15px rgba(212,175,55,0.3);
    }
    .btn-rouge:hover {
      background: #6b0000;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(139,0,0,0.4);
    }
    .btn-or:hover {
      background: #b8960f;
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(212,175,55,0.4);
    }
    
    /* Hero Contact - texte centré */
    .hero-contact {
      background: 
                   url('images/Banniere\ 3.png') no-repeat;
      background-size: cover;
      background-position: center;
      color: white;
      padding: 50px 0 60px;
      position: relative;
      text-align: center;
    }
    .hero-contact h1 {
      font-size: 2.5rem;
      font-weight: 800;
      color: var(--or-eclatant);
      margin-bottom: 0.5rem;
    }
    .hero-contact p {
      font-size: 1rem;
      max-width: 700px;
      opacity: 0.95;
      margin-bottom: 0.5rem;
      margin-left: auto;
      margin-right: auto;
    }
    .hero-badge {
      display: inline-block;
      background: rgba(255,255,255,0.1);
      border: 1px solid var(--or-eclatant);
      padding: 0.2rem 1.2rem;
      border-radius: 30px;
      font-size: 0.7rem;
      letter-spacing: 2px;
      margin-bottom: 1rem;
    }
    .hero-contact .d-flex {
      justify-content: center;
    }
    
    /* Coordonnées améliorées */
    .info-card {
      background: white;
      padding: 20px 15px;
      border-radius: 30px;
      box-shadow: 0 15px 30px var(--ombre-legere);
      height: 100%;
      transition: all 0.3s ease;
      border: 1px solid rgba(212,175,55,0.1);
      text-align: center;
    }
    .info-card:hover {
      transform: translateY(-10px);
      border-color: var(--or-eclatant);
      box-shadow: 0 25px 45px var(--ombre-doree);
    }
    .info-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--or-eclatant), #b8960f);
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1.5rem;
      color: var(--rouge-profond);
      margin: 0 auto 1rem;
      box-shadow: 0 10px 20px rgba(212,175,55,0.3);
    }
    .info-card h3 {
      font-size: 1.1rem;
      color: var(--rouge-profond);
      margin-bottom: 0.5rem;
    }
    .info-card p {
      font-size: 0.85rem;
      color: #555;
      margin-bottom: 0;
    }
    
    /* Formulaire amélioré - maintenant pleine largeur (carte supprimée) */
    .contact-form {
      background: white;
      padding: 30px;
      border-radius: 30px;
      box-shadow: 0 20px 40px var(--ombre-legere);
      border: 1px solid rgba(212,175,55,0.1);
    }
    .contact-form h2 {
      color: var(--rouge-profond);
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }
    .form-control, .form-select {
      padding: 10px 15px;
      border: 2px solid rgba(212,175,55,0.1);
      border-radius: 15px;
      transition: all 0.3s;
      font-size: 0.9rem;
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--or-eclatant);
      box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.25);
    }
    .form-label {
      font-weight: 600;
      color: var(--rouge-profond);
      font-size: 0.85rem;
      margin-bottom: 0.2rem;
    }
    
    /* FAQ améliorée */
    .faq-item {
      background: white;
      padding: 20px;
      border-radius: 20px;
      margin-bottom: 15px;
      border: 1px solid rgba(212,175,55,0.1);
      transition: all 0.3s ease;
      box-shadow: 0 8px 20px var(--ombre-legere);
    }
    .faq-item:hover {
      border-color: var(--or-eclatant);
      box-shadow: 0 15px 30px var(--ombre-doree);
      transform: translateX(5px);
    }
    .faq-item h4 {
      color: var(--rouge-profond);
      font-size: 1.1rem;
      margin-bottom: 0.3rem;
      display: flex;
      align-items: center;
    }
    .faq-item h4 i {
      color: var(--or-eclatant);
      margin-right: 10px;
      font-size: 1.2rem;
    }
    .faq-item p {
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 0;
      padding-left: 2rem;
    }
    
    /* WhatsApp flottant amélioré */
    .whatsapp-float {
      position: fixed;
      bottom: 30px;
      left: 30px;
      background: #25d366;
      width: 55px;
      height: 55px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-size: 1.8rem;
      box-shadow: 0 10px 25px rgba(37,211,102,0.4);
      cursor: pointer;
      z-index: 1000;
      transition: all 0.3s;
      animation: pulse 2s infinite;
      text-decoration: none;
    }
    .whatsapp-float:hover {
      transform: scale(1.15) rotate(5deg);
      background: #20ba57;
      box-shadow: 0 15px 35px rgba(37,211,102,0.5);
    }
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(37,211,102,0.5); }
      70% { box-shadow: 0 0 0 15px rgba(37,211,102,0); }
      100% { box-shadow: 0 0 0 0 rgba(37,211,102,0); }
    }
    
    /* Sections - espacement réduit */
    section {
      padding: 40px 0;
    }
    .section-title {
      font-size: 2rem;
      color: var(--rouge-profond);
      margin-bottom: 0.3rem;
    }
    .section-subtitle {
      font-size: 0.95rem;
      color: #666;
      margin-bottom: 2rem;
    }
    .divider {
      width: 50px;
      height: 2px;
      background: var(--or-eclatant);
      margin: 0.5rem 0 1.2rem;
    }
    
    /* Footer compact */
    footer {
      background: var(--rouge-profond);
      color: var(--blanc-casse);
      padding: 40px 0 15px;
      border-top: 2px solid var(--or-eclatant);
      margin-top: 40px;
    }
    .footer-title {
      color: var(--or-eclatant);
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 12px;
    }
    .social-links a {
      width: 35px;
      height: 35px;
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
      font-size: 1rem;
    }
    .social-links a:hover {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      transform: translateY(-3px) rotate(360deg);
    }
    .footer-links a {
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      transition: color 0.2s;
      font-size: 0.85rem;
      line-height: 1.8;
    }
    .footer-links a:hover {
      color: var(--or-eclatant);
    }
    
    /* Container */
    .container {
      max-width: 1140px;
    }
  </style>
</head>
<body>
  <!-- Navigation compacte avec logo image -->
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">
        <div class="logo-njeeygu">
          <!-- Logo image (utilisez votre propre URL d'image) -->
            <img src="images/logo ndar lum.png" alt="NJEEYGU Logo" class="logo-image">
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

  <!-- Hero Contact - texte centré -->
  <div class="hero-contact">
    <div class="container">
      <span class="hero-badge"><i class="fas fa-crown me-2"></i>PRÊT À OPTIMISER ?</span>
      <h1 class="fw-bold">Contactez-nous</h1>
      <p>Prêt à sécuriser votre réseau et éliminer vos pénalités ? Notre équipe est à votre écoute pour conseiller et faire de votre performance industrielle une réalité.</p>
      <div class="d-flex gap-3 mt-3">
        <a href="#form" class="btn btn-or">Envoyer un message</a>
        <a href="tel:+221775449795" class="btn btn-rouge">Appeler</a>
      </div>
    </div>
  </div>

  <!-- Coordonnées améliorées -->
  <section>
    <div class="container">
      <div class="row g-3">
        <div class="col-md-3">
          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3>Adresse</h3>
            <p>Pharmacie Alhamdoulillah, Pikine St-Louis</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <h3>Téléphone</h3>
            <p> +221 77 674 21 46</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <div class="info-icon">
              <i class="far fa-clock"></i>
            </div>
            <h3>Horaires</h3>
            <p>Lun-Sam : 09h - 20h</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info-card">
            <div class="info-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <h3>Email</h3>
            <p> contact@ndarluminairedeco.com</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Formulaire SEUL (carte itinéraire supprimée) -->
  <section id="form">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="contact-form">
            <h2>Envoyez-nous un message</h2>
            <div class="divider"></div>
            <form id="contactForm" onsubmit="sendViaWhatsApp(event)">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nom complet</label>
                  <input type="text" class="form-control" id="nom" placeholder="Votre nom" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="votre@email.com" required>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Téléphone</label>
                  <input type="tel" class="form-control" id="telephone" placeholder="+221 77 XXX XX XX" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Type d'événement</label>
                  <select class="form-select" id="evenement">
                    <option selected>Choisissez</option>
                    <option>Mariage</option>
                    <option>Baptême</option>
                    <option>Anniversaire</option>
                    <option>Événement professionnel</option>
                    <option>Réception privée</option>
                    <option>Autre</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Date prévue</label>
                  <input type="date" class="form-control" id="date">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nombre d'invités</label>
                  <input type="number" class="form-control" id="invites" placeholder="Ex: 100">
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Votre message</label>
                <textarea class="form-control" id="message" rows="4" placeholder="Parlez-nous de votre projet, de vos envies, de votre budget..." required></textarea>
              </div>
              <button type="submit" class="btn btn-rouge w-100 py-2">
                <i class="fab fa-whatsapp me-2"></i>Envoyer 
              </button>
            </form>
            <p class="small text-muted mt-2"><i class="fas fa-lock me-1" style="color: var(--or-eclatant);"></i> Vos données sont confidentielles</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Section FAQ améliorée -->
  <section class="bg-white">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Questions fréquentes</h2>
        <p class="section-subtitle">Tout ce que vous devez savoir avant de nous contacter</p>
      </div>
      <div class="row g-3">
        <div class="col-md-6">

<div class="faq-item">
            <h4><i class="fas fa-question-circle"></i>Où se trouve exactement votre boutique à Saint-Louis ?</h4>
            <p>Notre showroom Ndar Luminaire Déco est situé en plein cœur de Saint-Louis, idéalement placé juste en face de la Pharmacie Alhamdoulillah.
               C'est une adresse facile d'accès où vous pouvez venir découvrir directement nos verrières, essayer nos luminaires et choisir votre matériel de quincaillerie.
            </p>
          </div>


          <div class="faq-item">
            <h4><i class="fas fa-question-circle"></i>Proposez-vous des devis gratuits pour les grands projets ?</h4>
            <p>Oui, absolument ! Que ce soit pour l'équipement complet d'un chantier de construction (BTP) ou pour un projet global de décoration d'intérieur, nous étudions vos listes de besoins et vous fournissons un devis gratuit, détaillé et transparent dans les meilleurs délais.</p>
          </div>
          <div class="faq-item">
            <h4><i class="fas fa-question-circle"></i>Vos matériels et luminaires sont-ils sous garantie ?</h4>
            <p>Tout à fait. Tous nos équipements électriques, solutions LED et articles de premier choix bénéficient d’une garantie de conformité pour vous assurer une tranquillité d'esprit totale. Nous sélectionnons nos produits pour leur durabilité face au climat local.</p>
          </div>
          
        </div>
        <div class="col-md-6">
          <div class="faq-item">
            <h4><i class="fas fa-question-circle"></i> Comment fonctionne votre service de décoration d'intérieur ?</h4>
            <p>C'est un service sur-mesure ! Notre équipe dédiée se déplace chez vous ou dans vos locaux professionnels à Saint-Louis pour analyser l'espace, l'éclairage naturel et vos goûts, afin de vous proposer un projet d'aménagement complet et harmonieux.</p>
          </div>
          <div class="faq-item">
            <h4><i class="fas fa-question-circle"></i> Vendez-vous également aux particuliers au détail ?</h4>
            <p>Oui, notre quincaillerie et nos rayons décoration/luminaire sont ouverts à tout le monde. Nous accueillons avec plaisir les particuliers pour leurs petits besoins du quotidien (ampoules, outils, objets déco) ainsi que les professionnels pour des achats en grande quantité.</p>
          </div>
          


          
        </div>
      </div>
    </div>
  </section>

  <!-- Section contact direct -->
  <section class="py-3" style="background: linear-gradient(135deg, var(--rouge-profond), #5e5454);">
    <div class="container text-center text-white">
      <h4 class="fw-bold mb-2">Besoin d'une réponse immédiate ?</h4>
      <p class="mb-3 small">Appelez-nous directement ou écrivez-nous sur WhatsApp</p>
      <div class="d-flex justify-content-center gap-3">
        <a href="tel:+221 775654122" class="btn btn-or btn-sm"><i class="fas fa-phone-alt me-2"></i> +221 77 565 41 22</a>
        <a href="https://wa.me/221775654122" class="btn btn-or btn-sm" style="background: #25d366; color: white;"><i class="fab fa-whatsapp me-2"></i> WhatsApp</a>
      </div>
    </div>
  </section>

  <!-- WhatsApp flottant 
  <a href="https://wa.me/221775449795" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
  </a> -->

  <!-- Footer compact avec logo image -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-2">
          <div class="logo-njeeygu mb-2">
            <img src="images/logo ndar lum.png" alt="NJEEYGU Logo" class="logo-image">
            <span style="color: var(--or-eclatant); font-weight: 600; font-size: 1rem;">REGILEC</span>
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
        <div class="col-lg-4 mb-2">
          <h5 class="footer-title">Liens rapides</h5>
          <div class="footer-links">
            <div><a href="index.html">Accueil</a></div>
            <div><a href="boutique.html">Boutique</a></div>
            <div><a href="services.html">Services</a></div>
            <div><a href="apropos.html">À propos</a></div>
            <div><a href="{{ route('contact') }}">Contact</a></div>
          </div>
        </div>
        <div class="col-lg-4 mb-2">
          <h5 class="footer-title">Suivez-nous</h5>
          <div class="social-links mb-2">
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

  <!-- Script pour l'envoi via WhatsApp -->
  <script>
    function sendViaWhatsApp(event) {
      event.preventDefault();
      
      // Récupérer les valeurs du formulaire
      const nom = document.getElementById('nom').value;
      const email = document.getElementById('email').value;
      const telephone = document.getElementById('telephone').value;
      const evenement = document.getElementById('evenement').value;
      const date = document.getElementById('date').value;
      const invites = document.getElementById('invites').value;
      const message = document.getElementById('message').value;
      
      // Numéro WhatsApp (à remplacer par votre numéro)
      const phoneNumber = '221775654122'; // Format international sans le +
      
      // Construire le message
      let whatsappMessage = `*Nouvelle demande de contact - NJEEYGU*%0A%0A`;
      whatsappMessage += `*Nom :* ${nom}%0A`;
      whatsappMessage += `*Email :* ${email}%0A`;
      whatsappMessage += `*Téléphone :* ${telephone}%0A`;
      whatsappMessage += `*Événement :* ${evenement}%0A`;
      
      if (date) {
        whatsappMessage += `*Date prévue :* ${date}%0A`;
      }
      
      if (invites) {
        whatsappMessage += `*Nombre d'invités :* ${invites}%0A`;
      }
      
      whatsappMessage += `*Message :* ${message}%0A%0A`;
      whatsappMessage += `_Message envoyé depuis le site web NJEEYGU_`;
      
      // Ouvrir WhatsApp avec le message pré-rempli
      const whatsappURL = `https://wa.me/${phoneNumber}?text=${whatsappMessage}`;
      window.open(whatsappURL, '_blank');
      
      // Optionnel : Afficher un message de confirmation
      alert('Vous allez être redirigé vers WhatsApp pour envoyer votre demande.');
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>