<!-- Modal -->
<div class="modal fade" id="saleUpdateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="saleUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="saleUpdateModalLabel">Modifier une vente</h1>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">

                    <form method="POST" action="{{ route('admin.business.sale.product') }}" id="updateSaleProductForm">
                        <!--begin::Body-->
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Code du marchand</label>
                                        <input type="text" name="code" required class="form-control" id="code" aria-describedby="codeHelp">
                                        <div id="codeHelp" class="form-text">
                                        Ceci correspond au code du manager.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Nombre de produit acheté</label>
                                        <input type="number" name="quantity" min="1" required class="form-control" id="quantity">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="input-group mb-3">
                                <span class="input-group-text">Montant reçu</span>
                                <input type="text" name="amount_received" required class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">F CFA</span>
                            </div>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saleProductBtn">Effectuer la vente</button>
            </div>
        </div>
    </div>
</div>