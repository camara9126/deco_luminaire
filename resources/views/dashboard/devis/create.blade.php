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
              <h4>Devis</h4>
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

                       <form action="{{ route('devis.store') }}" method="POST">
                            @csrf

                            <!-- CLIENT -->
                             <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label>Client</label>
                                        <select name="client_id" class="form-control">
                                            <option value="">-- Choisir un client --</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                
                                </div>
                                <div class="col-md-2">
                                    <div class="mt-4 mb-2">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#clientModal" style="padding: 6px 12px;">
                                            + Nouveau client
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-4 mb-2">
                                        <input type="text" id="search" class="form-control" placeholder="rechercher produit...">
                                    </div>
                                </div>
                             </div>


                            <!-- PRODUITS -->
                            <div class="list-group" id="results">
                                                    
                            </div>
                            <table class="" id="table-produits">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <!-- <select name="designation[0][produit_id]" class="form-control produit-select">
                                                <option value="">Choisir</option>
                                                @foreach($produits as $produit)
                                                    <option value="{{ $produit->id }}" data-prix_vente="{{ $produit->prix_vente }}">
                                                        {{ $produit->nom }}
                                                    </option>
                                                @endforeach
                                            </select> -->
                                            <input type="text" name="designation[0][nom]" class="form-control nom">
                                        </td>

                                        <td>
                                            <input type="number" name="designation[0][prix_vente]" class="form-control prix_vente" >
                                        </td>

                                        <td>
                                            <input type="number" name="designation[0][quantite]" class="form-control quantite" value="1">
                                        </td>

                                        <td>
                                            <input type="number" class="form-control total-ligne" readonly>
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger remove">X</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <button type="button" id="addRow" class="btn btn-primary">+ Ajouter produit</button>

                            <!-- TOTAL -->
                            <div class="mt-3">
                                <h4>Total : <span id="total-global">0</span> FCFA</h4>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                        </form>

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



<script>
    let index = 1;

    // Ajouter ligne
    document.getElementById('addRow').addEventListener('click', function () {

        let row = `
        <tr>
            <td>
                <input type="text" name="designation[${index}][nom]" class="form-control  produit-select">
            </td>

            <td>
                <input type="number" name="designation[${index}][prix_vente]" class="form-control prix_vente" >
            </td>

            <td>
                <input type="number" name="designation[${index}][quantite]" class="form-control quantite" value="1">
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

    // Auto remplir prix_vente
    document.addEventListener('change', function(e){
        if(e.target.classList.contains('produit-select')){
            let prix_vente = e.target.selectedOptions[0].dataset.prix_vente;
            let row = e.target.closest('tr');
            row.querySelector('.prix_vente').value = prix_vente;
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
        let prix_vente = row.querySelector('.prix_vente').value || 0;
        let quantite = row.querySelector('.quantite').value || 0;

        let total = prix_vente * quantite;
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

<!-- Recherche produit -->
<script>
    document.getElementById('search').addEventListener('keyup', function() {

        let query = this.value;

        if (query.length < 2) return;

        fetch(`/devSearch?q=${query}`)
            .then(res => res.json())
            .then(data => {

                let results = document.getElementById('results');
                results.innerHTML = '';

                data.forEach(produit => {
                    results.innerHTML += `
                        <a href="#" class="list-group-item" onclick="selectproduit(${produit.id}, '${produit.nom}', ${produit.prix_vente})">
                            ${produit.nom} - ${produit.prix_vente} FCFA
                        </a>
                    `;
                });
            });
    });
</script>

<script>
    function selectproduit(id, nom, prix_vente) {
        console.log("Produit sélectionné :", nom);
        
        // Chercher une ligne vide
        let selectElement = document.querySelector('#table-produits select');
        
        if(selectElement && selectElement.value === "") {
            // Remplir la première ligne vide
            let row = selectElement.closest('tr');
            selectElement.value = id;
            row.querySelector('.prix_vente').value = prix_vente;
            row.querySelector('.quantite').value = 1;
            calculLigne(row);
        } else {
            // Vérifier si le produit existe déjà
            let existingProductRow = null;
            document.querySelectorAll('.produit-select').forEach(select => {
                if(select.value == id) {
                    existingProductRow = select.closest('tr');
                }
            });
            
            if(existingProductRow) {
                // Augmenter la quantité
                let qteInput = existingProductRow.querySelector('.quantite');
                let nouvelleQte = (parseFloat(qteInput.value) || 0) + 1;
                qteInput.value = nouvelleQte;
                calculLigne(existingProductRow);
            } else {
                // Ajouter une nouvelle ligne manuellement
                let row = `
                    <tr>
                        <td>

                            <input type="text" name="designation[${index}][nom]" class="form-control  produit-select">
                        </td>
                        <td>
                            <input type="number" name="designation[${index}][prix_vente]" class="form-control prix_vente" value="${prix_vente}">
                        </td>
                        <td>
                            <input type="number" name="designation[${index}][quantite]" class="form-control quantite" value="1">
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
                
                let newRow = document.querySelector('#table-produits tbody tr:last-child');
                let select = newRow.querySelector('.produit-select');
                select.value = id;
                calculLigne(newRow);
                
                index++;
            }
        }
        
        // Nettoyer
        document.getElementById('results').innerHTML = '';
        document.getElementById('search').value = '';
    }
</script>
@include('partials.footer')