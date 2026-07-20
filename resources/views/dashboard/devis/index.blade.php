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
              <h4>Devis</h4>
              <a href="{{route('devis.create') }}"  class="btn btn-or btn-sm">Nouveau Devis</a>
            </div>
            <div class="table-responsive">
                <table class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Client</th>
                            <th>Total Devis</th>
                            <th>Date de devis</th>
                            <th>Date d'expiration</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($devis as $d)
                        <tr>
                            <td>{{$d->reference}}</td>
                            <td>{{$d->client->nom ?? 'Client supprimee'}}</td>
                            <td>{{number_format($d->total, 0, ',',' ')}} XOF</td>
                            <td>{{$d->date_devis}}</td>
                            <td>{{$d->date_expiration}}</td>
                            <td>
                                @if($d->statut == 'valide')
                                    <span class="status-badge badge-success">{{$d->statut}}</span>
                                @elseif($d->statut == 'en_attente')
                                    <span class="status-badge badge-warning">{{$d->statut}}</span>
                                @else
                                    <span class="status-badge badge-danger">{{$d->statut}}</span>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="{{route('devis.show', $d->id)}}" class="btn btn-outline-warning mr-2" title="afficher le devis">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('devis.edit', $d->id)}}" class="btn btn-outline-info mr-2" title="modifier le devis">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('devis.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger">
                                               <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">Donnee vide !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-4">
                    {{$devis->links()}}
                </div>
            </div>
        </div>
    </div>

@include('partials.footer')