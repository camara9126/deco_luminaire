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
                        <img src="{{ asset('images/logo ndar lum.png') }}" alt="Admin">
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

          <!-- Dernières demandes de devis -->
          <div class="admin-table">
            <div class="table-header">
              <h4>Modification Devis</h4>
              <a href="{{route('devis.index') }}"  class="btn btn-or btn-sm">Retour</a>
            </div>
            
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif

                    <div class="card-body">
                        @if ($errors->any())
                            <div style="color: red; margin-bottom: 10px;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                            <!-- INFOS ENTREPRISE -->
                            <div class="mb-4">
                                <h4>{{ $devis->entreprise->nom ?? 'Entreprise' }}</h4>
                                <p>Date : {{ $devis->date_devis }}</p>
                                <p>Référence : {{ $devis->reference }}</p>

                                <p>
                                    Statut :
                                    @if($devis->statut == 'en_attente')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($devis->statut == 'valide')
                                        <span class="badge bg-success">Validé</span>
                                    @else
                                        <span class="badge bg-danger">Refusé</span>
                                    @endif
                                </p>
                            </div>

                            <!-- CLIENT -->
                            <div class="mb-4">
                                @if($devis->client !== null)
                                    <h5>Client</h5>
                                    <p>Nom : {{ $devis->client->nom }}</p>
                                    <p>Téléphone : {{ $devis->client->telephone ?? '-' }}</p>
                                @endif
                            </div>

                            <!-- TABLE PRODUITS -->
                            <table class="">
                                <thead>
                                    <tr>
                                        <th>Designation</th>
                                        <th>Quantité</th>
                                        <th>Prix unitaire</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($devis->details as $detail)
                                        <tr>
                                            <td>{{ $detail->designation ?? '-' }}</td>
                                            <td>{{ $detail->quantite }}</td>
                                            <td>{{ number_format($detail->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ number_format($detail->total, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- TOTAL -->
                            <div class="text-end mt-3">
                                <h4>Total : {{ number_format($devis->total, 0, ',', ' ') }} FCFA</h4>
                            </div>

                            <!-- ACTIONS -->
                            <div class="mt-4 d-flex gap-2">

                                @if($devis->statut == 'en_attente')
                                    <a href="{{ route('devis.valider', $devis->id) }}" class="btn btn-success">
                                        Valider
                                    </a>

                                    <a href="{{ route('devis.refuser', $devis->id) }}" class="btn btn-danger">
                                        Refuser
                                    </a>
                                    <a href="{{ route('devis.facture', $devis->id) }}" class="btn btn-info">
                                        Generer la facture
                                    </a>
                                @endif

                                @if($devis->statut == 'valide')
                                    <a href="{{ route('devis.convertir', $devis->id) }}" class="btn btn-info">
                                        Convertir en vente
                                    </a>
                                    <a href="{{ route('devis.facture', $devis->id) }}" class="btn btn-warning">
                                        Generer la facture
                                    </a>
                                @elseif($devis->statut == 'refuse')
                                    <form action="{{route('devis.destroy', $devis->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Supprimer">
                                            <i class="fa fa-trash"></i>Supprimer le devis
                                        </button>
                                    </form>
                                @endif
                                
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <script>
        let index = 1;

        // Ajouter ligne
        document.getElementById('addRow').addEventListener('click', function () {

            let row = `
            <tr>
                <td>
                    <select name="produits[${index}][produit_id]" class="form-control produit-select">
                        <option value="">Choisir</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}">
                                {{ $produit->nom }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <input type="number" name="produits[${index}][prix]" class="form-control prix" readonly>
                </td>

                <td>
                    <input type="number" name="produits[${index}][quantite]" class="form-control quantite" value="1">
                </td>

                <td>
                    <input type="number" class="form-control total-ligne" readonly>
                </td>

                <td>
                    <button type="button" class="btn btn-danger remove">X</button>
                </td>
            </tr>
            `;

            document.querySelector('#table-produits tbody').insertAdjacentHTML('beforeend', row);
            index++;
        });

        // Supprimer ligne
        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove')){
                e.target.closest('tr').remove();
                calculTotal();
            }
        });

        // Auto remplir prix
        document.addEventListener('change', function(e){
            if(e.target.classList.contains('produit-select')){
                let prix = e.target.selectedOptions[0].dataset.prix;
                let row = e.target.closest('tr');
                row.querySelector('.prix').value = prix;
                calculLigne(row);
            }
        });

        // Calcul ligne
        document.addEventListener('input', function(e){
            if(e.target.classList.contains('quantite')){
                let row = e.target.closest('tr');
                calculLigne(row);
            }
        });

        function calculLigne(row){
            let prix = row.querySelector('.prix').value || 0;
            let quantite = row.querySelector('.quantite').value || 0;

            let total = prix * quantite;
            row.querySelector('.total-ligne').value = total;

            calculTotal();
        }

        // Calcul global
        function calculTotal(){
            let total = 0;

            document.querySelectorAll('.total-ligne').forEach(function(input){
                total += parseFloat(input.value) || 0;
            });

            document.getElementById('total-global').innerText = total.toLocaleString();
        }
    </script>
@include('partials.footer')