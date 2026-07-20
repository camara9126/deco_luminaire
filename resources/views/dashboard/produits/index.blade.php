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
              <h4>Produits</h4>
              <a href="#"  class="btn btn-or btn-sm" data-bs-toggle="modal"  data-bs-target="#produitModal">Nouveau produit</a>
            </div>
            <table class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Produit</th>
                  <th>Categorie</th>
                  <th>Prix</th>
                  <th>Stock</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody >
                @foreach($produits as $p)
                  <tr>
                      <!--<td>
                          <div class="product-info">
                              <img src="{{asset('storage/'. $p->image)}}" width="50" alt="">
                          </div>
                      </td>-->
                      <td>
                          <div class="product-info">
                              <div style="font-weight: 600;">{{$p->code}}</div>
                          </div>
                      </td>
                      <td>{{$p->nom}}</td>
                      <td>{{$p->categorie->nom ?? '-'}}</td>
                      <td><strong>{{$p->prix_vente}} FCFA</strong></td>
                      <td>
                          @if($p->stock_min >= $p->stock)
                              <span class="badge bg-danger">Stock faible({{ $p->stock }})</span>
                          @else
                               <span class="badge-success">{{$p->stock}} en stock</span>
                          @endif
                      </td>
                      <!--<td>{{$p->etiquette ?? 'Pas d"etiquette'}}</td>-->
                      <td><span class="badge-{{$p->statut ? 'success' : 'warning'}}">{{$p->statut ? 'Publié' : 'En attente'}}</span></td>
                      <td>
                          <div class="action-buttons">
                              <a href="" class="action-btn" title="Modifier"  data-bs-toggle="modal" data-id="{{ $p->id }}" data-name="{{ $p->nom }}" data-categorie="{{ $p->categorie_id }}" data-price="{{ $p->prix_vente }}" data-image="{{ asset('storage/'.$p->image) }}" data-bs-target="#produitEditModal">
                                  <i class="fas fa-edit"></i>
                              </a>
                              <form action="{{route('produit.destroy', $p->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
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
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Nouveau produit -->
        <div class="modal fade" id="produitModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="post" action="{{route('produit.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nouveau produit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Nom produit</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Prix Achat</label>
                                        <input type="number" name="prix_achat" class="form-control">
                                    </div>
                                   
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Prix Vente (par unite)</label>
                                        <input type="number" name="prix_vente" class="form-control">
                                    </div>  
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Quantite Totale</label>
                                <input type="number" name="stock" class="form-control">
                            </div>   

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Categorie</label>
                                        <input type="text" name="categorie" class="form-control" placeholder="Nouveau categorie">
                                        <select name="categorie_id" class="form-control">
                                                <option value="">-- Selectionner --</option>
                                            @foreach($categories as $m)
                                                <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Fournisseur</label>
                                        <input type="text" name="fournisseur" class="form-control" placeholder="Nouveau fournisseur">
                                        <select name="fournisseur_id" class="form-control">
                                                <option value="">-- Selectionner --</option>
                                            @foreach($fournisseurs as $f)
                                                <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                                    
                                </div>  
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit produit -->
        <div class="modal fade" id="produitEditModal" tabindex="-1">
            <div class="modal-dialog">

                <form method="post" id="editProduitForm" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modification produit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" name="id" id="produit_id">
                            <input type="hidden" name="categorie_id" id="categorie_id">

                            <div class="mb-3">
                                <label>Image</label>
                                <img src="image" id="image" width="100" alt="">
                                
                            </div>

                            <div class="mb-3">
                                <label>Nom produit</label>
                                <input type="text" name="nom" id="name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Prix</label>
                                <input type="text" name="prix_vente" id="price" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Categorie</label>
                                        <select name="" class="form-control">
                                            @foreach($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Fournisseur</label>
                                        <select name="fournisseur_id" class="form-control">
                                            @foreach($fournisseurs as $f)
                                                <option value="{{ $f->id }}">{{ $f->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>         
                                </div>
                            </div>         

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Donnees Formulaire Edit -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('produitEditModal');
            const form = document.getElementById('editProduitForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = button.getAttribute('data-price');
                const image = button.getAttribute('data-image');
                const categorie_id = button.getAttribute('data-categorie');
                
                // Remplir le formulaire
                modal.querySelector('#produit_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#price').value = price;
                modal.querySelector('#image').src = image;
                modal.querySelector('#categorie_id').value = categorie_id;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/produit/${id}`;
                form.action = updateUrl;
            });
        });
    </script>
       
@include('partials.footer')
