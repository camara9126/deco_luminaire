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
              <h4>Factures</h4>
              <a href="{{ route('devis.create') }}"  class="btn btn-or btn-sm">Nouveau devis</a>
            </div>
            
            <div class="table-responsive">
                <table class="display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Client</th>
                            <th>Montant TVA</th>
                            <th>Montant Total</th>
                            <!-- <th>Montant Payer</th> -->
                            <!-- <th>Montant Restant</th> -->
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Facture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($factures as $v)
                        @if($v->montant_restant == 0)
                            <tr>
                                <td><strong>FAC-{{$v->reference}}</strong></td>
                                <td>{{$v->client->nom ?? 'Anonyme'}}</td>
                                <td>{{number_format($v->total_tva, 0, ',',' ')}} XOF</td>
                                <td>{{number_format($v->total_ttc, 0, ',',' ')}} XOF</td>
                                <!-- <td>{{number_format($v->montant_paye, 0, ',', ' ')}} XOF</td> -->
                                <!-- <td>{{number_format($v->montant_restant, 0, ',',' ')}} XOF</td> -->
                                <td>{{$v->created_at->format('d/m/y')}}</td>
                                <td>
                                    @if($v->statut == 'payee')
                                        <span class="status-badge badge bg-success">{{$v->statut}}</span>
                                    @elseif($v->statut == 'partielle')
                                        <span class="status-badge badge-pending">{{$v->statut}}</span>
                                    @else
                                        <span class="status-badge badge bg-danger">{{$v->statut}}</span>
                                    @endif
                                </td>
                                <!--<td>
                                    @if($v->montant_restant == 0)
                                        <button type="button" class="status-badge badge bg-secondary">
                                            Payée
                                        </button>
                                    @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-id="{{$v->id}}" data-bs-target="#paiementModal">Payer
                                    </button>
                                    @endif
                                </td>-->
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{route('vente.show', $v->id)}}" class="action-btn text-primary mr-2" title="afficher la facture">
                                                <i class="fas fa-file-invoice"></i>
                                            </a>
                                        </div>  
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('vente.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-outline-danger">
                                               <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                </td>
                            </tr>
                        @endif
                        @empty
                            <tr>
                                <td colspan="7" align="center">Donnee vide !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{$factures->links()}}
            </div>
        
            <!-- Modal paiement -->
            <div class="modal fade" id="paiementModal" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('paiement.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Paiement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="vente_id" id="vente_id">

                                <div class="mb-3">
                                    <label>Montant à payer</label>
                                    <input type="number" name="montant" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Mode de paiement</label>
                                    <select name="mode_paiement" class="form-select" required>
                                        <option value="cash">Cash</option>
                                        <option value="wave">Wave</option>
                                        <option value="orange_money">Orange Money</option>
                                        <option value="banque">Banque</option>
                                    </select>
                                </div>

                                <button class="btn btn-success">
                                    Enregistrer le paiement
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>     
          </div>
        </div>
    </div>
</div>
           
<script>
    // Recuperation de l'ID de la vente
    document.addEventListener('DOMContentLoaded', function () {

        const modal = document.getElementById('paiementModal');

        modal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');

            modal.querySelector('#vente_id').value = id;
        });
    });

    
</script>


    @include('partials.footer')
