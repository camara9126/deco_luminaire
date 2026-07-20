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
              <h4>Clients</h4>
              <a href="#"  class="btn btn-or btn-sm" data-bs-toggle="modal"  data-bs-target="#clientModal">Nouveau client</a>
            </div>
            <div class="table-responsive">
                <table class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $c)
                        <tr>
                            <td>{{$c->nom}}</td>
                            <td>{{$c->telephone ?? 'Vide'}}</td>
                            <td>{{$c->email ?? 'Vide'}}</td>
                            <td>{{$c->adresse ?? 'Vide'}}</td>
                            <td>
                            <div class="action-buttons">
                                <a href="" class="action-btn" data-bs-toggle="modal" data-id="{{ $c->id }}" data-name="{{ $c->nom }}" data-phone="{{ $c->telephone }}" data-email="{{ $c->email }}" data-adress="{{$c->adresse }}" data-bs-target="#clientEditModal" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{route('client.destroy', $c->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete" title="Supprimer">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                <!--<a href="" class="action-btn" title="Dupliquer"><i class="fas fa-copy"></i></a>-->
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


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 

                <!-- Nouveau client -->
                <div class="modal fade" id="clientModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post" action="{{route('client.store')}}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Nouveau client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nom du client</label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" name="telephone" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Adresse</label>
                                        <textarea name="adresse"  class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                    <!-- Edit client -->
                <div class="modal fade" id="clientEditModal" tabindex="-1">
                    <div class="modal-dialog">

                        <form method="post" id="editClientForm" action="">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="id" id="client_id">

                                    <div class="mb-3">
                                        <label>Nom du client</label>
                                        <input type="text" name="nom" id="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" name="telephone" id="phone" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Adresse</label>
                                        <textarea name="adresse" id="adress" class="form-control" rows="3"></textarea>
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
        </div>
      </div>
    </div>
  </div>
  

      <!--Recuperation des donnees client pour l'Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('clientEditModal');
            const form = document.getElementById('editClientForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const adress = button.getAttribute('data-adress');
                
                // Remplir le formulaire
                modal.querySelector('#client_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#phone').value = phone;
                modal.querySelector('#email').value = email;
                modal.querySelector('#adress').value = adress;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/client/${id}`;
                form.action = updateUrl;
            });
        });
    </script>

@include('partials.footer')