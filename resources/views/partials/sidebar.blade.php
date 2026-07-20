      <div class="admin-sidebar">
        <div class="sidebar-header">
          <h3>Ndar Luminaire Deco</h3>
          <p>ADMIN PANEL</p>
        </div>
        
        <div class="sidebar-menu">
          <a href="{{ route('dashboard') }}" class="active" onclick="showSection('dashboard', event)">
            <i class="fas fa-tachometer-alt"></i>
            <span>Tableau de bord</span>
          </a>
          <a href="{{ route('devis.index') }}">
            <i class="fas fa-file-invoice"></i>
            <span>Demandes de devis</span>
            <span class="notification-badge" id="devisPendingBadge"><span id="statTotalDevis">0</span></span>
          </a>
          <a href="{{ route('produit.index') }}">
            <i class="fas fa-box"></i>
            <span>Produits</span>
            <span class="notification-badge" ><span>0</span></span>
          </a>
          <a href="{{ route('categorie.index') }}">
            <i class="fas fa-box"></i>
            <span>Categories</span>
            <span class="notification-badge" ><span>0</span></span>
          </a>
          <a href="{{ route('stock.index') }}">
            <i class="fas fa-warehouse"></i>
            <span>Gestion Stock</span>
            <span class="notification-badge"><span >0</span></span>
          </a>
          <a href="{{ route('factures') }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Factures</span>
          </a>
          <a href="{{ route('client.index') }}">
            <i class="fas fa-users"></i>
            <span>Clients</span>
          </a>
          <a href="#" onclick="showSection('services', event)">
            <i class="fas fa-crown"></i>
            <span>Services</span>
          </a>
          <!-- <a href="#" onclick="showSection('equipe', event)">
            <i class="fas fa-user-tie"></i>
            <span>Équipe</span>
          </a>
          <a href="#" onclick="showSection('salaires', event)">
            <i class="fas fa-money-bill-wave"></i>
            <span>Salaires</span>
            <span class="notification-badge" id="salariesBadge">0</span>
          </a> -->
          
          <div class="menu-divider"></div>
          
          <a href="{{ route('profile.edit') }}" onclick="showSection('parametres', event)">
            <i class="fas fa-cog"></i>
            <span>Paramètres</span>
          </a>
          <form method="POST" action="{{ route('logout') }}">
                @csrf    
              <a class="" href="{{route('logout')}}"onclick="event.preventDefault(); this.closest('form').submit();"><i class="fas fa-sign-out-alt me-2 text-danger"></i> Déconnexion</a>
          </form>
        </div>
      </div>