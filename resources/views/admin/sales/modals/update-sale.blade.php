<!-- Modal -->
<div class="modal fade" id="saleUpdateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="saleUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="saleUpdateModalLabel">Modifier une vente</h1>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('admin.sales.update') }}" id="updateSaleProductForm">
                        <!--begin::Body-->
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="sale_id" id="sale_id">
                            <input type="hidden" name="saler_id" id="saler_id">
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nomClient" class="form-label">Nom du client</label>
                                        <input type="text" name="nom_client" required class="form-control" id="nomClient">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prenom_client" class="form-label">Prénom du client</label>
                                        <input type="text" name="prenom_client" required class="form-control" id="prenom_client">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="telephone_client" class="form-label">Téléphone du client</label>
                                        <input type="text" name="telephone_client" required class="form-control" id="telephone_client">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code du marchand</label>
                                        <input type="text" name="code" required class="form-control" id="code" aria-describedby="codeHelp">
                                        <div id="codeHelp" class="form-text">
                                        Code du manager.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="marchandName" class="form-label">Nom du marchand</label>
                                        <input type="text" name="nom_marchand" disabled class="form-control" id="marchandName">
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="quantity" class="form-label">Nombre de produit acheté</label>
                                        <input type="number" name="quantite" min="1" required class="form-control" id="quantity">
                                    </div> --}}
                                </div>
                                <div class="col-md-4">
                                    <label for="amount_received" class="form-label">Montant reçu</label>
                                    <div class="input-group mb-3">
                                        {{-- <span class="input-group-text">Montant reçu</span> --}}
                                        <input type="text" name="montant_recu" id="amount_received" required class="form-control" aria-label="Amount (to the nearest dollar)">
                                        <span class="input-group-text">F CFA</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Prix unitaire</label>
                                        <div class="input-group mb-3">
                                            <input type="text" readonly name="price" class="form-control" id="price">
                                            <span class="input-group-text">F CFA</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Nombre de produit acheté</label>
                                        <input type="number" name="quantite" min="1" required class="form-control" id="quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="total" class="form-label">Montant Total</label>
                                        <div class="input-group mb-3">    
                                            <input type="text" name="total" readonly class="form-control" id="total">
                                            <span class="input-group-text">F CFA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- <div class="input-group mb-3">
                                <span class="input-group-text">Montant reçu</span>
                                <input type="text" name="montant_recu" id="amount_received" required class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">F CFA</span>
                            </div> --}}
                        </div>
                        <!--end::Body-->
                        {{-- <!--begin::Footer-->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!--end::Footer--> --}}
                    </form>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saleProductBtn">Modifier la vente</button>
            </div>
        </div>
    </div>
</div>