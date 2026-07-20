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
            @include('partials.stats')
          
          <!-- Alerte stock faible -->
          <div  class="low-stock-alert" style="display: none;">
            <strong><i class="fas fa-exclamation-triangle me-2" style="color: #856404;"></i>Produits avec stock faible :</strong>
            <span id="lowStockCount">0</span> produit(s) nécessitent une attention
          </div>
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          
          @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
              </div>
          @elseif(Session::has('danger'))
              <div class="alert alert-danger" role="alert">
                  {{ Session::get('danger') }}
              </div>
          @endif

          <!-- Dernières demandes de devis -->
          <div class="admin-table">
            <div class="table-header">
              <h4>Mouvement Stock</h4>
              <a href="#"  class="btn btn-or btn-sm" data-bs-toggle="modal"  data-bs-target="#exampleModal">Nouveau Stock</a>
            </div>
            <div class="table-responsive">
                <table class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Quantite</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mouvements as $m)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <div>
                                        <div style="font-weight: 600;">{{$m->reference}}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{$m->produit->nom ?? $m->designation}}</td>
                            <td>{{$m->type}}</td>
                            <td><strong>{{$m->quantite}}</strong></td>
                            <td>{{$m->created_at->format('d/m/Y')}}</td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">Donnee vide !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif 
            <!-- Modal Nouveau mouvement stck-->
            <div class="modal fade" id="exampleModal" tabindex="-1">
                <div class="modal-dialog">
                    <form method="post" action="{{route('stock.store')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mouvement Stock</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Produit</label>
                                    <select class="form-control" name="produit_id" id="exampleFormControlSelect1">
                                        <option value="">-- Veuillez choisir un produit --</option>
                                        @foreach($produits as $a)
                                        <option value="{{$a->id}}">{{$a->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Type</label>
                                    <select class="form-control" name="type" id="exampleFormControlSelect1">
                                        <option value="">-- Veuillez choisir le type de mouvement --</option>
                                        <option value="entree">Entree</option>
                                        <option value="sortie">Sortie</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Quantite</label>
                                    <input type="number" name="quantite" id="qty" min="1" class="form-control" readonly>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
          </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


       
@include('partials.footer')
