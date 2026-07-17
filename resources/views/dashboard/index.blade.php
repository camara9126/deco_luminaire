@include('partials.header')
  <!-- Interface Admin -->
  <div id="adminInterface">
    <div class="admin-wrapper">
      <!-- Sidebar -->
      @include('partials.sidebar')
      
      <!-- Main Content -->
      <div class="admin-main">
        <!-- Top Bar -->
        <div class="admin-topbar">
          <h2 id="pageTitle">Tableau de bord</h2>
          <div class="admin-user">
            <div class="admin-user-info">
              <div class="name" >{{ Auth::user()->name}}</div>
              <!-- <div class="role" >Administrateur</div> -->
            </div>
            
            <div class="dropdown">
                <button class="d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        <img src="images/logo ndar lum.png" alt="Admin" onerror="this.src='https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=2069&auto=format&fit=crop&w=200&h=200&fit=crop';">
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2 text-primary"></i> Mon profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                                    @csrf    
                            <a class="dropdown-item" href="{{route('logout')}}"onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt me-2 text-danger"></i> Déconnexion</a>
                        </form>
                    </li>
                </ul>
            </div>  
          </div>
        </div>
        
        <!-- Notification Toast -->
        <div id="notificationToast" class="notification-toast" style="display: none; position: fixed; top: 20px; right: 20px; z-index: 9999; background: white; border-radius: 15px; padding: 15px 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); border-left: 4px solid var(--or-eclatant);">
          <div class="d-flex align-items-center">
            <i class="fas fa-shopping-cart me-2" style="color: var(--or-eclatant);"></i>
            <div>
              <strong id="notificationTitle">Nouvelle demande</strong>
              <p id="notificationMessage" class="small mb-0">Une nouvelle demande a été reçue</p>
            </div>
            <button class="btn-close ms-3" onclick="closeNotification()"></button>
          </div>
        </div>
        
        <!-- ==================== DASHBOARD ==================== -->
        <div id="section-dashboard" class="admin-section">
          <!-- Stats Cards -->
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statDevis">0</h3>
                  <p>Demandes de devis</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statProduits">0</h3>
                  <p>Produits</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statFactures">0</h3>
                  <p>Factures</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statClients">0</h3>
                  <p>Clients</p>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Alerte stock faible -->
          <div id="lowStockAlert" class="low-stock-alert" style="display: none;">
            <strong><i class="fas fa-exclamation-triangle me-2" style="color: #856404;"></i>Produits avec stock faible :</strong>
            <span id="lowStockCount">0</span> produit(s) nécessitent une attention
          </div>
          
          <!-- Dernières demandes de devis -->
          <div class="admin-table">
            <div class="table-header">
              <h4>Dernières demandes de devis</h4>
              <a href="#" onclick="showSection('devis', event)" class="btn btn-or btn-sm">Voir tout</a>
            </div>
            <table id="recentDevisTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Référence</th>
                  <th>Client</th>
                  <th>Produit</th>
                  <th>Téléphone</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="recentDevisList">
                <!-- Les devis seront insérés ici dynamiquement -->
              </tbody>
            </table>
          </div>
          
          <!-- Dernières factures -->
          <div class="admin-table">
            <div class="table-header">
              <h4>Dernières factures</h4>
              <a href="#" onclick="showSection('factures', event)" class="btn btn-or btn-sm">Voir tout</a>
            </div>
            <table id="recentInvoicesTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>N° Facture</th>
                  <th>Client</th>
                  <th>Montant TTC</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="recentInvoicesList">
                <!-- Les factures seront insérées ici -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- ==================== DEMANDES DE DEVIS ==================== -->
        <div id="section-devis" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="filterDevis('all', event)">Toutes (<span id="devisCountAll">0</span>)</div>
            <div class="admin-tab" onclick="filterDevis('pending', event)">En attente (<span id="devisCountPending">0</span>)</div>
            <div class="admin-tab" onclick="filterDevis('sent', event)">Devis envoyés (<span id="devisCountSent">0</span>)</div>
            <div class="admin-tab" onclick="filterDevis('converted', event)">Converties (<span id="devisCountConverted">0</span>)</div>
            <div class="admin-tab" onclick="filterDevis('cancelled', event)">Annulées (<span id="devisCountCancelled">0</span>)</div>
          </div>
          
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalDevis">0</h3>
                  <p>Total demandes</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-clock" style="color: #ffc107;"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statPendingDevis">0</h3>
                  <p>En attente</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-check-circle" style="color: #28a745;"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statSentDevis">0</h3>
                  <p>Devis envoyés</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statConversionRate">0%</h3>
                  <p>Taux de conversion</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="admin-table">
            <div class="table-header">
              <h4>Gestion des demandes de devis</h4>
              <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div class="search-box">
                  <i class="fas fa-search"></i>
                  <input type="text" id="searchDevis" class="form-control" placeholder="Rechercher..." style="width: 250px;">
                </div>
                <button class="btn btn-or btn-sm" onclick="exportDevis()">
                  <i class="fas fa-download me-1"></i> Exporter
                </button>
                <button class="btn btn-rouge btn-sm" onclick="generateDevisReport()">
                  <i class="fas fa-file-pdf me-1"></i> Rapport
                </button>
              </div>
            </div>
            <table id="devisTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Référence</th>
                  <th>Date</th>
                  <th>Client</th>
                  <th>Téléphone</th>
                  <th>Email</th>
                  <th>Produit</th>
                  <th>Quantité</th>
                  <th>Date événement</th>
                  <th>Budget</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="devisList">
                <!-- Les demandes de devis seront insérées ici -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- ==================== PRODUITS ==================== -->
        <div id="section-produits" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="showProductsTab('list', event)">Liste des produits</div>
            <div class="admin-tab" onclick="showProductsTab('add', event)">Ajouter un produit</div>
            <div class="admin-tab" onclick="showProductsTab('categories', event)">Catégories</div>
          </div>
          
          <div id="products-list" class="products-tab-content">
            <div class="admin-table">
              <div class="table-header">
                <h4>Tous les produits (<span id="totalProducts">0</span>) <span class="tva-badge">TVA 18% incluse</span></h4>
                <div class="search-box">
                  <i class="fas fa-search"></i>
                  <input type="text" id="searchProduct" class="form-control" placeholder="Rechercher un produit..." style="width: 250px;">
                </div>
              </div>
              <table id="productsTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix HT</th>
                    <th>TVA (18%)</th>
                    <th>Prix TTC</th>
                    <th>Stock</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="productsList">
                  <!-- Les produits seront insérés ici -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div id="products-add" class="products-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Ajouter un nouveau produit <span class="tva-badge">TVA 18%</span></h4>
              <form id="addProductForm" onsubmit="addProduct(event)">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nom du produit *</label>
                      <input type="text" class="form-control" id="productName" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Catégorie *</label>
                      <select class="form-select" id="productCategory" required>
                        <option value="">Sélectionnez</option>
                        <option value="table">Art de la table</option>
                        <option value="lumiere">Lumières</option>
                        <option value="mariage">Mariage</option>
                        <option value="ballon">Ballons</option>
                        <option value="deco">Décoration</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Prix HT (FCFA) *</label>
                      <input type="number" class="form-control" id="productPriceHT" required onchange="updatePriceTTC()">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>TVA (18%)</label>
                      <input type="text" class="form-control" id="productTVA" value="18%" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Prix TTC (FCFA)</label>
                      <input type="text" class="form-control" id="productPriceTTC" readonly>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Stock initial *</label>
                      <input type="number" class="form-control" id="productStock" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Stock minimum d'alerte</label>
                      <input type="number" class="form-control" id="productMinStock" value="5">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Emplacement/Rangement</label>
                      <input type="text" class="form-control" id="productLocation" placeholder="Ex: Aisle 3, Rayon 2">
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Statut</label>
                      <select class="form-select" id="productStatus">
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-rouge">Ajouter le produit</button>
              </form>
            </div>
          </div>
          
          <div id="products-categories" class="products-tab-content" style="display: none;">
            <div class="admin-table">
              <div class="table-header">
                <h4>Catégories</h4>
                <button class="btn btn-or btn-sm" onclick="showAddCategoryModal()">
                  <i class="fas fa-plus me-1"></i> Ajouter
                </button>
              </div>
              <table id="categoriesTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Nombre de produits</th>
                    <th>Valeur totale du stock</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="categoriesList">
                  <!-- Les catégories seront insérées ici -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- ==================== GESTION DES STOCKS ==================== -->
        <div id="section-stock" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="filterStock('all', event)">Tous les stocks (<span id="stockCountAll">0</span>)</div>
            <div class="admin-tab" onclick="filterStock('critical', event)">Stock critique (<span id="stockCountCritical">0</span>)</div>
            <div class="admin-tab" onclick="filterStock('low', event)">Stock faible (<span id="stockCountLow">0</span>)</div>
            <div class="admin-tab" onclick="filterStock('medium', event)">Stock moyen (<span id="stockCountMedium">0</span>)</div>
            <div class="admin-tab" onclick="filterStock('high', event)">Stock élevé (<span id="stockCountHigh">0</span>)</div>
          </div>
          
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-boxes"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalStock">0</h3>
                  <p>Unités en stock</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-exclamation-triangle" style="color: #dc3545;"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statCriticalStock">0</h3>
                  <p>Stock critique</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statStockValue">0</h3>
                  <p>Valeur totale TTC</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-truck"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statMouvements">0</h3>
                  <p>Mouvements (30j)</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="admin-table">
            <div class="table-header">
              <h4>Gestion des stocks <span class="tva-badge">TVA 18% incluse</span></h4>
              <div style="display: flex; gap: 10px;">
                <button class="btn btn-emeraude btn-sm" onclick="showAddStockModal()">
                  <i class="fas fa-plus me-1"></i> Nouveau stock
                </button>
                <button class="btn btn-or btn-sm" onclick="exportStockReport()">
                  <i class="fas fa-download me-1"></i> Exporter
                </button>
                <button class="btn btn-rouge btn-sm" onclick="showBulkStockModal()">
                  <i class="fas fa-edit me-1"></i> Mise à jour groupée
                </button>
              </div>
            </div>
            <table id="stockTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Produit</th>
                  <th>Catégorie</th>
                  <th>Prix HT</th>
                  <th>Prix TTC</th>
                  <th>Stock actuel</th>
                  <th>Stock minimum</th>
                  <th>Statut stock</th>
                  <th>Emplacement</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="stockList">
                <!-- Les produits seront insérés ici -->
              </tbody>
            </table>
          </div>
          
          <!-- Historique des mouvements de stock -->
          <div class="admin-table">
            <div class="table-header">
              <h4>Derniers mouvements de stock</h4>
              <button class="btn btn-or btn-sm" onclick="showStockMovementModal()">
                <i class="fas fa-plus me-1"></i> Nouveau mouvement
              </button>
            </div>
            <table id="stockMovementsTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Produit</th>
                  <th>Type</th>
                  <th>Quantité</th>
                  <th>Stock après</th>
                  <th>Raison</th>
                  <th>Utilisateur</th>
                </tr>
              </thead>
              <tbody id="stockMovementsList">
                <!-- Les mouvements seront insérés ici -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- ==================== FACTURES ==================== -->
        <div id="section-factures" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="filterInvoices('all', event)">Toutes les factures (<span id="invoicesCountAll">0</span>)</div>
            <div class="admin-tab" onclick="filterInvoices('paid', event)">Payées (<span id="invoicesCountPaid">0</span>)</div>
            <div class="admin-tab" onclick="filterInvoices('unpaid', event)">Impayées (<span id="invoicesCountUnpaid">0</span>)</div>
          </div>
          
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalInvoices">0</h3>
                  <p>Total factures</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-check-circle" style="color: #28a745;"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statPaidInvoices">0</h3>
                  <p>Payées</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-clock" style="color: #ffc107;"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statUnpaidInvoices">0</h3>
                  <p>Impayées</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalAmount">0</h3>
                  <p>Montant total TTC</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="admin-table">
            <div class="table-header">
              <h4>Gestion des factures <span class="tva-badge">TVA 18%</span></h4>
              <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div class="search-box">
                  <i class="fas fa-search"></i>
                  <input type="text" id="searchInvoice" class="form-control" placeholder="Rechercher..." style="width: 250px;">
                </div>
                <button class="btn btn-or btn-sm" onclick="showAddInvoiceModal()">
                  <i class="fas fa-plus me-1"></i> Nouvelle facture
                </button>
                <button class="btn btn-rouge btn-sm" onclick="generateInvoiceReport()">
                  <i class="fas fa-file-pdf me-1"></i> Rapport
                </button>
              </div>
            </div>
            <table id="invoicesTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>N° Facture</th>
                  <th>Client</th>
                  <th>Téléphone</th>
                  <th>Email</th>
                  <th>Montant HT</th>
                  <th>TVA (18%)</th>
                  <th>Montant TTC</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="invoicesList">
                <!-- Les factures seront insérées ici -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- ==================== CLIENTS ==================== -->
        <div id="section-clients" class="admin-section" style="display: none;">
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalClients">0</h3>
                  <p>Total clients</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statClientsWithDevis">0</h3>
                  <p>Avec demandes</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statClientsWithInvoices">0</h3>
                  <p>Avec factures</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statTotalSpent">0</h3>
                  <p>Total dépensé</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="admin-table">
            <div class="table-header">
              <h4>Liste des clients</h4>
              <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <div class="search-box">
                  <i class="fas fa-search"></i>
                  <input type="text" id="searchClient" class="form-control" placeholder="Rechercher un client..." style="width: 250px;">
                </div>
                <button class="btn btn-or btn-sm" onclick="showAddClientModal()">
                  <i class="fas fa-user-plus me-1"></i> Nouveau client
                </button>
                <button class="btn btn-rouge btn-sm" onclick="exportClients()">
                  <i class="fas fa-download me-1"></i> Exporter
                </button>
              </div>
            </div>
            <table id="clientsTable" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Nom</th>
                  <th>Téléphone</th>
                  <th>Email</th>
                  <th>Demandes devis</th>
                  <th>Factures</th>
                  <th>Total dépensé</th>
                  <th>Dernière activité</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="clientsList">
                <!-- Les clients seront insérés ici -->
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- ==================== SERVICES ==================== -->
        <div id="section-services" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="showServicesTab('list', event)">Liste des services</div>
            <div class="admin-tab" onclick="showServicesTab('add', event)">Ajouter un service</div>
          </div>
          
          <div id="services-list" class="services-tab-content">
            <div class="admin-table">
              <div class="table-header">
                <h4>Services proposés</h4>
                <button class="btn btn-or btn-sm" onclick="showServicesTab('add', event)">
                  <i class="fas fa-plus me-1"></i> Nouveau service
                </button>
              </div>
              <table id="servicesTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Service</th>
                    <th>Description</th>
                    <th>Prix HT</th>
                    <th>TVA (18%)</th>
                    <th>Prix TTC</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="servicesList">
                  <!-- Les services seront insérés ici -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div id="services-add" class="services-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Ajouter un service</h4>
              <form id="addServiceForm" onsubmit="addService(event)">
                <div class="form-group">
                  <label>Nom du service *</label>
                  <input type="text" class="form-control" id="serviceName" required>
                </div>
                
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" id="serviceDescription" rows="3"></textarea>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Prix HT (FCFA) *</label>
                      <input type="number" class="form-control" id="servicePriceHT" required onchange="updateServicePriceTTC()">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Prix TTC (FCFA)</label>
                      <input type="text" class="form-control" id="servicePriceTTC" readonly>
                    </div>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-rouge">Ajouter le service</button>
              </form>
            </div>
          </div>
        </div>
        
        <!-- ==================== ÉQUIPE ==================== -->
        <div id="section-equipe" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="showTeamTab('list', event)">Membres de l'équipe</div>
            <div class="admin-tab" onclick="showTeamTab('add', event)">Ajouter un membre</div>
          </div>
          
          <div id="team-list" class="team-tab-content">
            <div class="admin-table">
              <div class="table-header">
                <h4>Membres de l'équipe</h4>
                <button class="btn btn-or btn-sm" onclick="showTeamTab('add', event)">
                  <i class="fas fa-user-plus me-1"></i> Ajouter un membre
                </button>
              </div>
              <table id="teamTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Bio</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="teamList">
                  <!-- Les membres de l'équipe seront insérés ici -->
                </tbody>
              </table>
            </div>
          </div>
          
          <div id="team-add" class="team-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Ajouter un membre à l'équipe</h4>
              <form id="addTeamMemberForm" onsubmit="addTeamMember(event)">
                <div class="form-group">
                  <label>Nom complet *</label>
                  <input type="text" class="form-control" id="memberName" required>
                </div>
                
                <div class="form-group">
                  <label>Poste *</label>
                  <input type="text" class="form-control" id="memberPosition" required>
                </div>
                
                <div class="form-group">
                  <label>Bio / Description</label>
                  <textarea class="form-control" id="memberBio" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                  <label>Photo URL</label>
                  <input type="url" class="form-control" id="memberPhoto" placeholder="https://...">
                </div>
                
                <button type="submit" class="btn btn-rouge">Ajouter le membre</button>
              </form>
            </div>
          </div>
        </div>
        
        <!-- ==================== SALAIRES ==================== -->
        <div id="section-salaires" class="admin-section" style="display: none;">
          <!-- En-tête avec statistiques -->
          <div class="row g-4 mb-4">
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statEmployes">0</h3>
                  <p>Employés</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statMasseSalariale">0</h3>
                  <p>Masse salariale</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statPaiementsMois">0</h3>
                  <p>Paiements ce mois</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat-card">
                <div class="stat-icon">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                  <h3 id="statProchainPaiement">0</h3>
                  <p>Jours avant paie</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Tabs de navigation -->
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="showSalariesTab('liste', event)">Liste des employés</div>
            <div class="admin-tab" onclick="showSalariesTab('paiements', event)">Historique des paiements</div>
            <div class="admin-tab" onclick="showSalariesTab('ajouter', event)">Ajouter un employé</div>
            <div class="admin-tab" onclick="showSalariesTab('bulletins', event)">Bulletins de salaire</div>
          </div>

          <!-- Onglet : Liste des employés -->
          <div id="salaries-liste" class="salaries-tab-content">
            <div class="admin-table">
              <div class="table-header">
                <h4>Gestion des employés et salaires</h4>
                <div style="display: flex; gap: 10px;">
                  <button class="btn btn-or btn-sm" onclick="exportSalaries()">
                    <i class="fas fa-download me-1"></i> Exporter
                  </button>
                  <button class="btn btn-rouge btn-sm" onclick="generatePayroll()">
                    <i class="fas fa-calculator me-1"></i> Générer la paie
                  </button>
                </div>
              </div>
              
              <table id="salariesTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Photo</th>
                    <th>Employé</th>
                    <th>Poste</th>
                    <th>Salaire de base</th>
                    <th>Prime</th>
                    <th>Salaire total</th>
                    <th>Date d'embauche</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="salariesList">
                  <!-- Les employés seront insérés ici dynamiquement -->
                </tbody>
              </table>
            </div>

            <!-- Graphique de répartition des salaires -->
            <div class="row g-4 mt-2">
              <div class="col-md-6">
                <div class="chart-container">
                  <h4 style="color: var(--rouge-profond); margin-bottom: 15px;">Répartition des salaires</h4>
                  <canvas id="salariesChart" style="width: 100%; height: 220px;"></canvas>
                </div>
              </div>
              <div class="col-md-6">
                <div class="chart-container">
                  <h4 style="color: var(--rouge-profond); margin-bottom: 15px;">Évolution masse salariale</h4>
                  <canvas id="payrollEvolutionChart" style="width: 100%; height: 220px;"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Onglet : Historique des paiements -->
          <div id="salaires-paiements" class="salaries-tab-content" style="display: none;">
            <div class="admin-table">
              <div class="table-header">
                <h4>Historique des paiements</h4>
                <div class="d-flex gap-2">
                  <select class="form-select form-select-sm" style="width: 150px;" id="paymentMonthFilter" onchange="filterPaymentsByMonth()">
                    <option value="">Tous les mois</option>
                    <option value="2026-01">Janvier 2026</option>
                    <option value="2026-02">Février 2026</option>
                    <option value="2026-03">Mars 2026</option>
                  </select>
                  <button class="btn btn-or btn-sm" onclick="exportPayments()">
                    <i class="fas fa-download me-1"></i> Exporter
                  </button>
                </div>
              </div>
              
              <table id="paymentsTable" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Employé</th>
                    <th>Poste</th>
                    <th>Période</th>
                    <th>Salaire de base</th>
                    <th>Prime</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="paymentsList">
                  <!-- Les paiements seront insérés ici -->
                </tbody>
              </table>
            </div>
          </div>

          <!-- Onglet : Ajouter un employé -->
          <div id="salaires-ajouter" class="salaries-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Ajouter un nouvel employé</h4>
              <form id="addEmployeeForm" onsubmit="addEmployee(event)">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nom complet *</label>
                      <input type="text" class="form-control" id="employeeName" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Poste *</label>
                      <input type="text" class="form-control" id="employeePosition" required>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Salaire de base (FCFA) *</label>
                      <input type="number" class="form-control" id="employeeBaseSalary" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Prime par défaut (FCFA)</label>
                      <input type="number" class="form-control" id="employeeDefaultBonus" value="0">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Date d'embauche *</label>
                      <input type="date" class="form-control" id="employeeHireDate" required>
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Téléphone</label>
                      <input type="text" class="form-control" id="employeePhone" placeholder="77 123 45 67">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" id="employeeEmail" placeholder="employe@email.com">
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Numéro de compte bancaire</label>
                      <input type="text" class="form-control" id="employeeBankAccount" placeholder="SN 12345 67890">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Statut</label>
                      <select class="form-select" id="employeeStatus">
                        <option value="actif">Actif</option>
                        <option value="inactif">Inactif</option>
                        <option value="conge">En congé</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label>Notes / Commentaires</label>
                  <textarea class="form-control" id="employeeNotes" rows="2"></textarea>
                </div>
                
                <button type="submit" class="btn btn-rouge">Ajouter l'employé</button>
              </form>
            </div>
          </div>

          <!-- Onglet : Bulletins de salaire -->
          <div id="salaires-bulletins" class="salaries-tab-content" style="display: none;">
            <div class="admin-table">
              <div class="table-header">
                <h4>Génération des bulletins de salaire</h4>
                <button class="btn btn-or btn-sm" onclick="generateAllPayslips()">
                  <i class="fas fa-file-pdf me-1"></i> Générer tous les bulletins
                </button>
              </div>
              
              <table class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>Période</th>
                    <th>Employé</th>
                    <th>Salaire</th>
                    <th>Date génération</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="payslipsList">
                  <!-- Les bulletins seront insérés ici dynamiquement -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- ==================== PARAMÈTRES ==================== -->
        <div id="section-parametres" class="admin-section" style="display: none;">
          <div class="admin-tabs">
            <div class="admin-tab active" onclick="showSettingsTab('general', event)">Général</div>
            <div class="admin-tab" onclick="showSettingsTab('users', event)">Utilisateurs</div>
            <div class="admin-tab" onclick="showSettingsTab('notifications', event)">Notifications</div>
            <div class="admin-tab" onclick="showSettingsTab('payments', event)">Paiements</div>
          </div>
          
          <div id="settings-general" class="settings-tab-content">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Paramètres généraux</h4>
              <form id="settingsForm" onsubmit="saveSettings(event)">
                <div class="form-group">
                  <label>Nom de l'entreprise</label>
                  <input type="text" class="form-control" id="companyName" value="NJEEYGU - Le Grand Jour">
                </div>
                
                <div class="form-group">
                  <label>Email de contact</label>
                  <input type="email" class="form-control" id="companyEmail" value="contact@njeeygu.sn">
                </div>
                
                <div class="form-group">
                  <label>Téléphone</label>
                  <input type="text" class="form-control" id="companyPhone" value="+221 77 544 97 95">
                </div>
                
                <div class="form-group">
                  <label>Adresse</label>
                  <input type="text" class="form-control" id="companyAddress" value="123 Rue Principale, Saint-Louis">
                </div>
                
                <div class="form-group">
                  <label>Numéro WhatsApp</label>
                  <input type="text" class="form-control" id="companyWhatsapp" value="221775449795">
                </div>
                
                <div class="form-group">
                  <label>Devise</label>
                  <select class="form-select" id="companyCurrency">
                    <option value="FCFA" selected>FCFA</option>
                    <option value="EUR">Euro</option>
                    <option value="USD">Dollar</option>
                  </select>
                </div>
                
                <div class="form-group">
                  <label>Taux de TVA (%)</label>
                  <input type="number" class="form-control" id="tvaRate" value="18" readonly>
                  <small class="text-muted">Taux fixe à 18%</small>
                </div>
                
                <div class="form-group">
                  <label>Seuil d'alerte stock par défaut</label>
                  <input type="number" class="form-control" id="defaultStockAlert" value="5">
                </div>
                
                <button type="submit" class="btn btn-rouge">Enregistrer les modifications</button>
              </form>
            </div>
          </div>
          
          <div id="settings-users" class="settings-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Gestion des utilisateurs</h4>
              <p class="text-muted">Fonctionnalité à venir...</p>
            </div>
          </div>
          
          <div id="settings-notifications" class="settings-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Paramètres des notifications</h4>
              <p class="text-muted">Fonctionnalité à venir...</p>
            </div>
          </div>
          
          <div id="settings-payments" class="settings-tab-content" style="display: none;">
            <div class="admin-form">
              <h4 style="color: var(--rouge-profond); margin-bottom: 20px;">Paramètres de paiement</h4>
              <p class="text-muted">Fonctionnalité à venir...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Détails Devis -->
  <div class="modal fade" id="devisDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Détails de la demande de devis <span id="modalDevisId"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <h6 style="color: var(--rouge-profond);">Informations client</h6>
              <p><strong>Nom :</strong> <span id="modalDevisName"></span></p>
              <p><strong>Téléphone :</strong> <span id="modalDevisPhone"></span></p>
              <p><strong>Email :</strong> <span id="modalDevisEmail"></span></p>
            </div>
            <div class="col-md-6">
              <h6 style="color: var(--rouge-profond);">Détails de la demande</h6>
              <p><strong>Date demande :</strong> <span id="modalDevisDate"></span></p>
              <p><strong>Quantité :</strong> <span id="modalDevisQuantity"></span></p>
              <p><strong>Date événement :</strong> <span id="modalDevisEventDate"></span></p>
              <p><strong>Budget :</strong> <span id="modalDevisBudget"></span></p>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-12">
              <h6 style="color: var(--rouge-profond);">Produit concerné</h6>
              <div id="modalDevisProduct" class="p-3" style="background: #f8f1e0; border-radius: 10px;">
                <!-- Informations produit -->
              </div>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-12">
              <h6 style="color: var(--rouge-profond);">Message du client</h6>
              <p id="modalDevisMessage" class="p-3" style="background: #f9f9f9; border-radius: 10px;"></p>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-6">
              <label><strong>Statut du devis :</strong></label>
              <select id="modalDevisStatusSelect" class="form-select" onchange="updateDevisStatus(this.value)">
                <option value="pending">En attente</option>
                <option value="sent">Devis envoyé</option>
                <option value="converted">Convertie en facture</option>
                <option value="cancelled">Annulée</option>
              </select>
            </div>
            <div class="col-md-6">
              <label><strong>Notes internes :</strong></label>
              <textarea id="modalDevisNotes" class="form-control" rows="2" placeholder="Ajouter une note..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-emeraude" onclick="convertDevisToInvoice()">
            <i class="fas fa-file-invoice-dollar me-2"></i>Générer facture
          </button>
          <button type="button" class="btn btn-or" onclick="sendDevisQuote()">
            <i class="fab fa-whatsapp me-2"></i>Envoyer devis
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ajouter Facture -->
  <div class="modal fade" id="addInvoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Créer une nouvelle facture</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addInvoiceForm" onsubmit="addInvoice(event)">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Client *</label>
                  <select class="form-select" id="invoiceClient" required onchange="updateClientInfo()">
                    <option value="">Sélectionnez un client</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nouveau client ?</label>
                  <button type="button" class="btn btn-or btn-sm" onclick="showAddClientModal()">
                    <i class="fas fa-user-plus me-1"></i> Ajouter
                  </button>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Téléphone</label>
                  <input type="text" class="form-control" id="invoicePhone" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="invoiceEmail" readonly>
                </div>
              </div>
            </div>
            
            <h5 class="mt-4" style="color: var(--rouge-profond);">Articles</h5>
            <div id="invoiceItems">
              <div class="row mb-3 invoice-item">
                <div class="col-md-5">
                  <select class="form-select" name="productId" required onchange="updateItemPrice(this)">
                    <option value="">Sélectionnez un produit</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <input type="number" class="form-control" name="quantity" placeholder="Quantité" min="1" value="1" required>
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" name="price" placeholder="Prix HT" readonly>
                </div>
                <div class="col-md-1">
                  <button type="button" class="action-btn delete" onclick="removeInvoiceItem(this)">
                    <i class="fas fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
            
            <button type="button" class="btn btn-or btn-sm mb-4" onclick="addInvoiceItem()">
              <i class="fas fa-plus me-1"></i> Ajouter un article
            </button>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date de facture</label>
                  <input type="date" class="form-control" id="invoiceDate">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date d'échéance</label>
                  <input type="date" class="form-control" id="invoiceDueDate">
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Statut de paiement</label>
                  <select class="form-select" id="invoicePaymentStatus">
                    <option value="unpaid">Impayée</option>
                    <option value="paid">Payée</option>
                    <option value="partial">Paiement partiel</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mode de paiement</label>
                  <select class="form-select" id="invoicePaymentMethod">
                    <option value="especes">Espèces</option>
                    <option value="carte">Carte bancaire</option>
                    <option value="virement">Virement</option>
                    <option value="wave">Wave</option>
                    <option value="orange_money">Orange Money</option>
                    <option value="free_money">Free Money</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="text-end mt-4">
              <button type="submit" class="btn btn-rouge">Créer la facture</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ajouter Client -->
  <div class="modal fade" id="addClientModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un nouveau client</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addClientForm" onsubmit="addClient(event)">
            <div class="form-group">
              <label>Nom complet *</label>
              <input type="text" class="form-control" id="clientName" required>
            </div>
            
            <div class="form-group">
              <label>Téléphone *</label>
              <input type="text" class="form-control" id="clientPhone" placeholder="77 123 45 67" required>
            </div>
            
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" id="clientEmail" placeholder="client@email.com">
            </div>
            
            <div class="form-group">
              <label>Adresse</label>
              <textarea class="form-control" id="clientAddress" rows="2"></textarea>
            </div>
            
            <button type="submit" class="btn btn-rouge">Ajouter le client</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ajouter Membre Équipe -->
  <div class="modal fade" id="addTeamMemberModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter un membre à l'équipe</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addTeamMemberForm" onsubmit="addTeamMember(event)">
            <div class="form-group">
              <label>Nom complet *</label>
              <input type="text" class="form-control" id="memberName" required>
            </div>
            
            <div class="form-group">
              <label>Poste *</label>
              <input type="text" class="form-control" id="memberPosition" required>
            </div>
            
            <div class="form-group">
              <label>Bio / Description</label>
              <textarea class="form-control" id="memberBio" rows="3"></textarea>
            </div>
            
            <div class="form-group">
              <label>Photo URL</label>
              <input type="url" class="form-control" id="memberPhoto" placeholder="https://...">
            </div>
            
            <button type="submit" class="btn btn-rouge">Ajouter le membre</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Gestion Stock -->
  <div class="modal fade" id="stockManagementModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Gérer le stock - <span id="stockModalProductName"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="stockModalProductId">
          
          <div class="form-group">
            <label>Stock actuel</label>
            <input type="number" class="form-control" id="stockModalCurrentStock" readonly>
          </div>
          
          <div class="form-group">
            <label>Stock minimum d'alerte</label>
            <input type="number" class="form-control" id="stockModalMinStock">
          </div>
          
          <div class="form-group">
            <label>Type d'opération</label>
            <select class="form-select" id="stockModalOperation" onchange="toggleStockOperationFields()">
              <option value="add">Ajouter au stock</option>
              <option value="remove">Retirer du stock</option>
              <option value="set">Définir une nouvelle valeur</option>
            </select>
          </div>
          
          <div class="form-group" id="stockModalQuantityGroup">
            <label>Quantité</label>
            <input type="number" class="form-control" id="stockModalQuantity" min="1" value="1">
          </div>
          
          <div class="form-group" id="stockModalNewValueGroup" style="display: none;">
            <label>Nouvelle valeur du stock</label>
            <input type="number" class="form-control" id="stockModalNewValue" min="0" value="0">
          </div>
          
          <div class="form-group">
            <label>Raison du mouvement</label>
            <select class="form-select" id="stockModalReason">
              <option value="reception">Réception fournisseur</option>
              <option value="ajustement">Ajustement inventaire</option>
              <option value="retour">Retour</option>
              <option value="autre">Autre</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Commentaires</label>
            <textarea class="form-control" id="stockModalComment" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-rouge" onclick="updateStock()">Mettre à jour</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Mouvement de stock -->
  <div class="modal fade" id="stockMovementModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nouveau mouvement de stock</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Produit</label>
            <select class="form-select" id="movementProductId">
              <option value="">Sélectionnez un produit</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Type de mouvement</label>
            <select class="form-select" id="movementType">
              <option value="entree">Entrée en stock</option>
              <option value="sortie">Sortie de stock</option>
              <option value="ajustement">Ajustement</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Quantité</label>
            <input type="number" class="form-control" id="movementQuantity" min="1" value="1">
          </div>
          
          <div class="form-group">
            <label>Raison</label>
            <select class="form-select" id="movementReason">
              <option value="reception">Réception fournisseur</option>
              <option value="retour_fournisseur">Retour fournisseur</option>
              <option value="inventaire">Ajustement inventaire</option>
              <option value="perte">Perte/Détérioration</option>
              <option value="autre">Autre</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Commentaires</label>
            <textarea class="form-control" id="movementComment" rows="2"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-rouge" onclick="addStockMovementFromModal()">Enregistrer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Visualisation Facture avec le même style que la première version -->
  <div class="modal fade" id="invoiceModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, var(--rouge-profond), var(--or-eclatant));">
          <h5 class="modal-title">
            <i class="fas fa-file-invoice me-2"></i>Facture <span id="invoiceModalNumber"></span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="invoiceContent" style="background: white; max-width: 800px; margin: 0 auto;">
            <!-- Le contenu de la facture sera injecté ici -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Fermer
          </button>
          <button type="button" class="btn btn-or" onclick="downloadInvoicePDF()">
            <i class="fas fa-download me-1"></i> Télécharger PDF
          </button>
          <button type="button" class="btn btn-rouge" onclick="printInvoice()">
            <i class="fas fa-print me-1"></i> Imprimer
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Visualisation Bulletin de Salaire (même style que la facture) -->
  <div class="modal fade" id="payslipModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, var(--rouge-profond), var(--vert-emeraude));">
          <h5 class="modal-title">
            <i class="fas fa-file-pdf me-2"></i>Bulletin de Salaire <span id="payslipModalNumber"></span>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="payslipContent" style="background: white; max-width: 800px; margin: 0 auto;">
            <!-- Le contenu du bulletin sera injecté ici -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> Fermer
          </button>
          <button type="button" class="btn btn-or" onclick="downloadPayslipPDF()">
            <i class="fas fa-download me-1"></i> Télécharger PDF
          </button>
          <button type="button" class="btn btn-rouge" onclick="printPayslip()">
            <i class="fas fa-print me-1"></i> Imprimer
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Ajouter Catégorie -->
  <div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une catégorie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nom de la catégorie</label>
            <input type="text" class="form-control" id="newCategoryName" placeholder="Ex: Art de la table">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" class="btn btn-rouge" onclick="addCategory()">Ajouter</button>
        </div>
      </div>
    </div>
  </div>


@include('partials.footer')
