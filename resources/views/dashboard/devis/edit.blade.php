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

            <form method="post" action="{{ route('devis.update', $devis) }}">
                @csrf
                @method('PUT')
                
                <!-- CLIENT -->
                <div class="mb-3">
                    <label>Client</label>
                    <select name="client_id" class="form-control" required>
                        @if($devis->client !== null)
                            <option value="{{$devis->client->id}}">{{$devis->client->nom}}</option>
                        @endif
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- PRODUITS -->
                <table class="table table-bordered" id="table-produits">
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
                        @foreach($devis->details as $index => $detail)
                        <tr id="row-{{ $index }}">
                            <td>
                                
                                <input type="text" name="designation[{{ $index }}][nom]" value="{{ $detail->designation }}" class="form-control nom">

                            </td>
                            <td>
                                <input type="number" name="designation[{{ $index }}][prix_vente]" value="{{ $detail->prix_unitaire }}" class="form-control prix_vente" required step="any">
                            </td>
                            <td>
                                <input type="number" name="designation[{{ $index }}][quantite]" value="{{ $detail->quantite }}" class="form-control quantite" required min="1">
                            </td>
                            <td>
                                <input type="number" class="form-control total-ligne" value="{{ $detail->total }}" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove">X</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" id="addRow" class="btn btn-primary">+ Ajouter produit</button>

                <!-- TOTAL -->
                <div class="mt-3">
                    <h4>Total : <span id="total-global">0</span> FCFA</h4>
                </div>

                <button type="submit" class="btn btn-success mt-3">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<script>
    let rowIndex = {{ $devis->details->count() }}; // Commencer après le dernier index existant

    // Ajouter ligne (CORRIGÉ)
    document.getElementById('addRow').addEventListener('click', function () {
        // Générer les options des produits
        let options = '';
        @foreach($produits as $produit)
            options += `<option value="{{ $produit->id }}" data-prix_vente="{{ $produit->prix_vente }}">{{ $produit->nom }}</option>`;
        @endforeach
        
        let row = `
            <tr id="row-new-${rowIndex}">
                <input type="text" name="designation[${rowIndex}][nom]" class="form-control nom">
                <td>
                    <input type="number" name="designation[${rowIndex}][prix_vente]" class="form-control prix_vente" required step="any">
                </td>
                <td>
                    <input type="number" name="designation[${rowIndex}][quantite]" class="form-control quantite" value="1" required min="1">
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
        rowIndex++;
    });

    // Supprimer ligne
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('remove')){
            e.target.closest('tr').remove();
            calculTotal();
        }
    });

    // Auto remplir prix_vente et calculer
    document.addEventListener('change', function(e){
        if(e.target.classList.contains('produit-select')){
            let selectedOption = e.target.selectedOptions[0];
            let prix_vente = selectedOption.dataset.prix_vente;
            let row = e.target.closest('tr');
            let prixInput = row.querySelector('.prix_vente');
            
            if(prixInput) {
                prixInput.value = prix_vente;
            }
            calculLigne(row);
        }
    });

    // Calcul ligne (déclenché par quantité ou prix)
    document.addEventListener('input', function(e){
        if(e.target.classList.contains('quantite') || e.target.classList.contains('prix_vente')){
            let row = e.target.closest('tr');
            calculLigne(row);
        }
    });

    function calculLigne(row){
        let prix_vente = parseFloat(row.querySelector('.prix_vente').value) || 0;
        let quantite = parseFloat(row.querySelector('.quantite').value) || 0;

        let total = prix_vente * quantite;
        let totalInput = row.querySelector('.total-ligne');
        
        if(totalInput) {
            totalInput.value = total.toFixed(2);
        }
        
        calculTotal();
    }

    // Calcul global
    function calculTotal(){
        let total = 0;

        document.querySelectorAll('.total-ligne').forEach(function(input){
            let val = parseFloat(input.value);
            if(!isNaN(val)) {
                total += val;
            }
        });

        let totalSpan = document.getElementById('total-global');
        if(totalSpan) {
            totalSpan.innerText = total.toLocaleString('fr-FR', {minimumFractionDigits: 0, maximumFractionDigits: 0});
        }
    }

    // Initialiser le total au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        calculTotal();
    });
</script>
@include('partials.footer')