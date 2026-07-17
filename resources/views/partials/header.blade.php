<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ndar Luminaire Déco · Administration - Gestion complète</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <!-- Icon Logo -->
  <link rel="shortcut icon" href="images/logo ndar lum.png"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!-- Chart.js pour les statistiques -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <!-- DataTables pour les tableaux avancés -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <!-- jsPDF pour générer des PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
  <!-- html2canvas pour capture d'écran -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    :root {
      --rouge-profond: #18019b;
      --or-eclatant: #f46e0f;
      --vert-emeraude: #006B54;
      --blanc-casse: #FDF5E6;
      --gris-elegant: #2c2c2c;
      --ombre-legere: rgba(0, 0, 0, 0.03);
      --ombre-doree: rgba(212, 175, 55, 0.15);
      --admin-bg: #f4f4f4;
      --admin-sidebar: #1e1e2d;
      --admin-sidebar-hover: #2c2c3f;
    }
    
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: var(--admin-bg);
      color: var(--gris-elegant);
      line-height: 1.6;
      overflow-x: hidden;
    }
    
    h1, h2, h3, h4 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      letter-spacing: -0.02em;
    }
    
    /* Layout Admin */
    .admin-wrapper {
      display: flex;
      min-height: 100vh;
    }
    
    /* Sidebar */
    .admin-sidebar {
      width: 280px;
      background: var(--admin-sidebar);
      color: white;
      position: fixed;
      height: 100vh;
      overflow-y: auto;
      transition: all 0.3s;
      z-index: 1000;
    }
    
    .admin-sidebar::-webkit-scrollbar {
      width: 5px;
    }
    
    .admin-sidebar::-webkit-scrollbar-track {
      background: #2c2c3f;
    }
    
    .admin-sidebar::-webkit-scrollbar-thumb {
      background: var(--or-eclatant);
      border-radius: 10px;
    }
    
    .sidebar-header {
      padding: 20px 15px;
      border-bottom: 1px solid rgba(212,175,55,0.2);
      text-align: center;
    }
    
    .sidebar-header h3 {
      color: var(--or-eclatant);
      font-size: 1.3rem;
      margin-bottom: 0.2rem;
    }
    
    .sidebar-header p {
      font-size: 0.7rem;
      opacity: 0.7;
      letter-spacing: 1px;
    }
    
    .sidebar-menu {
      padding: 20px 0;
    }
    
    .sidebar-menu a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      transition: all 0.3s;
      border-left: 3px solid transparent;
      position: relative;
    }
    
    .sidebar-menu a:hover, 
    .sidebar-menu a.active {
      background: var(--admin-sidebar-hover);
      color: var(--or-eclatant);
      border-left-color: var(--or-eclatant);
    }
    
    .sidebar-menu a i {
      width: 30px;
      font-size: 1.1rem;
    }
    
    .sidebar-menu a span {
      font-size: 0.9rem;
      font-weight: 500;
    }
    
    .notification-badge {
      position: absolute;
      right: 15px;
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      font-size: 0.7rem;
      padding: 2px 6px;
      border-radius: 20px;
      font-weight: bold;
    }
    
    .sidebar-menu .menu-divider {
      height: 1px;
      background: rgba(212,175,55,0.1);
      margin: 15px 20px;
    }
    
    /* Main Content */
    .admin-main {
      flex: 1;
      margin-left: 280px;
      padding: 20px 30px;
    }
    
    /* Top Bar */
    .admin-topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: white;
      padding: 15px 25px;
      border-radius: 20px;
      box-shadow: 0 5px 15px var(--ombre-legere);
      margin-bottom: 25px;
    }
    
    .admin-topbar h2 {
      font-size: 1.5rem;
      color: var(--rouge-profond);
      margin: 0;
    }
    
    .admin-user {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    
    .admin-user img {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border: 2px solid var(--or-eclatant);
      object-fit: cover;
    }
    
    .admin-user-info {
      text-align: right;
    }
    
    .admin-user-info .name {
      font-weight: 600;
      color: var(--rouge-profond);
    }
    
    .admin-user-info .role {
      font-size: 0.8rem;
      color: #666;
    }
    
    /* Stats Cards */
    .stat-card {
      background: white;
      border-radius: 20px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 15px;
      box-shadow: 0 5px 15px var(--ombre-legere);
      transition: all 0.3s;
      height: 100%;
    }
    
    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px var(--ombre-doree);
    }
    
    .stat-icon {
      width: 60px;
      height: 60px;
      background: rgba(212,175,55,0.1);
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      color: var(--or-eclatant);
    }
    
    .stat-info h3 {
      font-size: 1.5rem;
      color: var(--rouge-profond);
      margin-bottom: 0;
    }
    
    .stat-info p {
      margin: 0;
      color: #666;
      font-size: 0.85rem;
    }
    
    /* Tables */
    .admin-table {
      background: white;
      border-radius: 20px;
      padding: 20px;
      box-shadow: 0 5px 15px var(--ombre-legere);
      margin-bottom: 20px;
    }
    
    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .table-header h4 {
      color: var(--rouge-profond);
      font-size: 1.2rem;
      margin: 0;
    }
    
    .admin-table table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .admin-table th {
      text-align: left;
      padding: 12px 10px;
      color: var(--rouge-profond);
      font-weight: 600;
      font-size: 0.85rem;
      border-bottom: 2px solid rgba(212,175,55,0.2);
    }
    
    .admin-table td {
      padding: 12px 10px;
      border-bottom: 1px solid #eee;
      font-size: 0.9rem;
      vertical-align: middle;
    }
    
    .admin-table tr:last-child td {
      border-bottom: none;
    }
    
    .admin-table tr:hover td {
      background: rgba(212,175,55,0.05);
    }
    
    .badge-status {
      padding: 5px 12px;
      border-radius: 30px;
      font-size: 0.7rem;
      font-weight: 600;
      display: inline-block;
    }
    
    .badge-pending {
      background: #fff3cd;
      color: #856404;
    }
    
    .badge-confirmed {
      background: #d4edda;
      color: #155724;
    }
    
    .badge-shipped {
      background: #cce5ff;
      color: #004085;
    }
    
    .badge-delivered {
      background: #d1e7dd;
      color: #0f5132;
    }
    
    .badge-cancelled {
      background: #f8d7da;
      color: #721c24;
    }
    
    .badge-active {
      background: #d4edda;
      color: #155724;
    }
    
    .badge-inactive {
      background: #f8d7da;
      color: #721c24;
    }
    
    .badge-paid {
      background: #d4edda;
      color: #155724;
    }
    
    .badge-unpaid {
      background: #fff3cd;
      color: #856404;
    }
    
    .badge-devis {
      background: #cce5ff;
      color: #004085;
    }
    
    .badge-devis-pending {
      background: #fff3cd;
      color: #856404;
    }
    
    .badge-devis-sent {
      background: #d4edda;
      color: #155724;
    }
    
    .badge-devis-cancelled {
      background: #f8d7da;
      color: #721c24;
    }
    
    .badge-devis-converted {
      background: #d1e7dd;
      color: #0f5132;
    }
    
    /* Badges de stock */
    .badge-stock {
      padding: 5px 12px;
      border-radius: 30px;
      font-size: 0.7rem;
      font-weight: 600;
      display: inline-block;
    }
    
    .badge-stock-critical {
      background: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }
    
    .badge-stock-low {
      background: #fff3cd;
      color: #856404;
      border: 1px solid #ffeeba;
    }
    
    .badge-stock-medium {
      background: #d1ecf1;
      color: #0c5460;
      border: 1px solid #bee5eb;
    }
    
    .badge-stock-high {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    
    .action-btn {
      width: 32px;
      height: 32px;
      border-radius: 8px;
      border: none;
      background: transparent;
      color: #666;
      transition: all 0.2s;
      margin: 0 2px;
    }
    
    .action-btn:hover {
      background: rgba(212,175,55,0.1);
      color: var(--or-eclatant);
      transform: scale(1.1);
    }
    
    .action-btn.delete:hover {
      background: #fee;
      color: #dc3545;
    }
    
    .action-btn.whatsapp:hover {
      background: #25d36620;
      color: #25d366;
    }
    
    .action-btn.pdf:hover {
      background: #dc354520;
      color: #dc3545;
    }
    
    .action-btn.add-stock:hover {
      background: #d4edda;
      color: #28a745;
    }
    
    .action-btn.convert:hover {
      background: #d4edda;
      color: #28a745;
    }
    
    .action-btn.invoice:hover {
      background: #cce5ff;
      color: #004085;
    }
    
    /* Forms */
    .admin-form {
      background: white;
      border-radius: 20px;
      padding: 25px;
      box-shadow: 0 5px 15px var(--ombre-legere);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      font-weight: 600;
      color: var(--rouge-profond);
      font-size: 0.85rem;
      margin-bottom: 5px;
      display: block;
    }
    
    .form-control, .form-select {
      padding: 10px 15px;
      border: 2px solid rgba(212,175,55,0.1);
      border-radius: 15px;
      width: 100%;
      transition: all 0.3s;
    }
    
    .form-control:focus, .form-select:focus {
      border-color: var(--or-eclatant);
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(212,175,55,0.25);
    }
    
    /* Stock Input Group */
    .stock-input-group {
      display: flex;
      align-items: center;
      gap: 5px;
    }
    
    .stock-input-group input {
      width: 70px;
      text-align: center;
      padding: 5px;
      border: 1px solid #ddd;
      border-radius: 8px;
    }
    
    .stock-input-group button {
      width: 30px;
      height: 30px;
      border-radius: 8px;
      border: none;
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s;
    }
    
    .stock-input-group button:hover {
      background: var(--rouge-profond);
      color: white;
    }
    
    /* Progress Bar Stock */
    .stock-progress {
      width: 100px;
      height: 8px;
      background: #eee;
      border-radius: 4px;
      overflow: hidden;
      margin-top: 5px;
    }
    
    .stock-progress-bar {
      height: 100%;
      transition: width 0.3s ease;
    }
    
    .stock-progress-bar.critical {
      background: #dc3545;
    }
    
    .stock-progress-bar.low {
      background: #ffc107;
    }
    
    .stock-progress-bar.medium {
      background: #17a2b8;
    }
    
    .stock-progress-bar.high {
      background: #28a745;
    }
    
    /* Modal */
    .modal-content {
      border-radius: 25px;
      border: none;
    }
    
    .modal-header {
      background: linear-gradient(135deg, var(--rouge-profond), #6b0000);
      color: white;
      border-radius: 25px 25px 0 0;
      padding: 20px 25px;
    }
    
    .modal-header .btn-close {
      filter: brightness(0) invert(1);
    }
    
    .modal-body {
      padding: 25px;
    }
    
    .modal-footer {
      padding: 20px 25px;
      border-top: 1px solid rgba(212,175,55,0.1);
    }
    
    /* Tabs */
    .admin-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .admin-tab {
      padding: 10px 20px;
      background: white;
      border-radius: 40px;
      cursor: pointer;
      transition: all 0.3s;
      border: 1px solid rgba(212,175,55,0.1);
    }
    
    .admin-tab:hover {
      border-color: var(--or-eclatant);
    }
    
    .admin-tab.active {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      font-weight: 600;
    }
    
    /* Login Page */
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, var(--rouge-profond), #2c2c2c);
    }
    
    .login-box {
      background: white;
      border-radius: 30px;
      padding: 40px;
      width: 400px;
      max-width: 90%;
      box-shadow: 0 25px 50px rgba(0,0,0,0.3);
    }
    
    .login-box .logo {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .login-box .logo img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 3px solid var(--or-eclatant);
      object-fit: cover;
    }
    
    .login-box h2 {
      color: var(--rouge-profond);
      text-align: center;
      margin-bottom: 10px;
    }
    
    .login-box p {
      text-align: center;
      color: #666;
      margin-bottom: 30px;
    }
    
    /* Order Details */
    .order-details {
      background: #f9f9f9;
      border-radius: 15px;
      padding: 15px;
      margin-top: 15px;
    }
    
    .order-product-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 0;
      border-bottom: 1px dashed #ddd;
    }
    
    .order-product-item:last-child {
      border-bottom: none;
    }
    
    .order-product-img {
      width: 50px;
      height: 50px;
      border-radius: 10px;
      object-fit: cover;
    }
    
    /* Invoice - Style optimisé pour mobile */
    .invoice-pdf-mobile {
      width: 100%;
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background: white;
      font-family: 'Montserrat', sans-serif;
      color: #000;
      font-size: 12px;
      line-height: 1.4;
    }
    
    .invoice-header-mobile {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid var(--or-eclatant);
    }
    
    .company-info-mobile {
      width: 100%;
    }
    
    .company-logo-mobile {
      font-size: 18px;
      font-weight: bold;
      color: var(--rouge-profond);
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .company-logo-mobile i {
      color: var(--or-eclatant);
    }
    
    .company-contact-mobile {
      font-size: 10px;
      color: #666;
      line-height: 1.3;
    }
    
    .invoice-title-mobile {
      width: 100%;
    }
    
    .invoice-title-mobile h1 {
      font-size: 22px;
      font-weight: bold;
      color: var(--rouge-profond);
      margin: 0 0 10px 0;
    }
    
    .invoice-number-mobile {
      font-size: 13px;
      font-weight: bold;
      margin-bottom: 5px;
      color: var(--or-eclatant);
    }
    
    .invoice-details-mobile {
      margin: 15px 0;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    
    .client-info-mobile, .order-info-mobile {
      width: 100%;
      background: #f8f1e0;
      padding: 12px;
      border-radius: 10px;
    }
    
    .section-title-mobile {
      font-size: 13px;
      font-weight: bold;
      color: var(--rouge-profond);
      margin-bottom: 8px;
      padding-bottom: 4px;
      border-bottom: 1px solid var(--or-eclatant);
    }
    
    .invoice-table-mobile {
      width: 100%;
      border-collapse: collapse;
      margin: 15px 0;
      font-size: 10px;
    }
    
    .invoice-table-mobile thead {
      background: var(--rouge-profond);
    }
    
    .invoice-table-mobile th {
      padding: 8px 6px;
      text-align: left;
      color: white;
      font-weight: bold;
      border: none;
      font-size: 10px;
    }
    
    .invoice-table-mobile td {
      padding: 6px;
      border-bottom: 1px solid #ddd;
      font-size: 10px;
    }
    
    .invoice-table-mobile .text-right {
      text-align: right;
    }
    
    .invoice-table-mobile .text-center {
      text-align: center;
    }
    
    .totals-section-mobile {
      margin-top: 20px;
      padding: 15px;
      background: #f8f9fa;
      border-radius: 10px;
      border: 1px solid var(--or-eclatant);
    }
    
    .total-row-mobile {
      display: flex;
      justify-content: space-between;
      margin-bottom: 5px;
      padding: 4px 0;
      font-size: 11px;
    }
    
    .grand-total-mobile {
      font-size: 14px;
      font-weight: bold;
      color: var(--rouge-profond);
      border-top: 2px solid var(--or-eclatant);
      border-bottom: none;
      padding-top: 8px;
      margin-top: 8px;
    }
    
    .footer-mobile {
      margin-top: 25px;
      padding-top: 15px;
      border-top: 1px solid #ddd;
      text-align: center;
      font-size: 9px;
      color: #666;
      line-height: 1.3;
    }
    
    .stamp-mobile {
      text-align: center;
      margin: 20px auto;
      padding: 15px 25px;
      border: 2px solid var(--or-eclatant);
      border-radius: 3px;
      display: inline-block;
      transform: rotate(-5deg);
      background: rgba(212, 175, 55, 0.05);
      font-size: 10px;
    }
    
    .conditions-mobile {
      margin-top: 15px;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 3px;
      font-size: 9px;
      line-height: 1.3;
    }
    
    .btn-rouge {
      background: var(--rouge-profond);
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 10px;
      transition: all 0.3s;
    }
    
    .btn-rouge:hover {
      background: #6b0000;
      color: white;
      transform: translateY(-2px);
    }
    
    .btn-or {
      background: var(--or-eclatant);
      color: var(--rouge-profond);
      border: none;
      padding: 8px 20px;
      border-radius: 10px;
      transition: all 0.3s;
    }
    
    .btn-or:hover {
      background: #c4a030;
      color: var(--rouge-profond);
      transform: translateY(-2px);
    }
    
    .btn-emeraude {
      background: var(--vert-emeraude);
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 10px;
      transition: all 0.3s;
    }
    
    .btn-emeraude:hover {
      background: #004c3a;
      color: white;
      transform: translateY(-2px);
    }
    
    /* TVA Badge */
    .tva-badge {
      background: var(--vert-emeraude);
      color: white;
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.7rem;
      font-weight: 600;
      margin-left: 10px;
    }
    
    .price-without-tva {
      color: #666;
      font-size: 0.8rem;
      text-decoration: line-through;
      margin-right: 5px;
    }
    
    .price-with-tva {
      color: var(--rouge-profond);
      font-weight: bold;
      font-size: 1.1rem;
    }

    /* Table des stocks faibles */
    .low-stock-alert {
      background: #fff3cd;
      border-left: 4px solid #ffc107;
      padding: 10px 15px;
      margin-bottom: 20px;
      border-radius: 8px;
    }
    
    /* Responsive pour mobile */
    @media (max-width: 768px) {
      .admin-sidebar {
        width: 70px;
      }
      
      .sidebar-header h3,
      .sidebar-header p,
      .sidebar-menu a span {
        display: none;
      }
      
      .sidebar-menu a i {
        width: 100%;
        text-align: center;
        font-size: 1.3rem;
      }
      
      .notification-badge {
        right: 5px;
        font-size: 0.6rem;
        padding: 1px 4px;
      }
      
      .admin-main {
        margin-left: 70px;
        padding: 15px;
      }
      
      .invoice-pdf-mobile {
        padding: 15px;
        font-size: 11px;
      }
      
      .invoice-table-mobile {
        font-size: 9px;
      }
      
      .invoice-table-mobile th,
      .invoice-table-mobile td {
        padding: 5px 4px;
        font-size: 9px;
      }
      
      .invoice-title-mobile h1 {
        font-size: 20px;
      }
    }
    
    @media (max-width: 576px) {
      .admin-main {
        padding: 10px;
      }
      
      .admin-topbar {
        flex-direction: column;
        gap: 10px;
        text-align: center;
      }
      
      .admin-user {
        width: 100%;
        justify-content: center;
      }
      
      .invoice-pdf-mobile {
        padding: 10px;
        font-size: 10px;
      }
      
      .invoice-table-mobile {
        font-size: 8px;
      }
      
      .invoice-title-mobile h1 {
        font-size: 18px;
      }
    }
    
    /* Print styles */
    @media print {
      body * {
        visibility: hidden;
      }
      .invoice-pdf-mobile, .invoice-pdf-mobile * {
        visibility: visible;
      }
      .invoice-pdf-mobile {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 10mm !important;
        margin: 0 !important;
        max-width: 100% !important;
        font-size: 10px !important;
      }
      
      .invoice-table-mobile {
        font-size: 9px !important;
      }
      
      .invoice-table-mobile th,
      .invoice-table-mobile td {
        padding: 4px 3px !important;
        font-size: 9px !important;
      }
    }
  </style>
</head>
<body>
