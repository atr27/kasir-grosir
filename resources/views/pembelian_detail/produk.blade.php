<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" role="dialog">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <table class="table table-striped table-bordered tabel-produk">
                        <thead>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->kode_produk }}</td>
                                    <td>{{ $value->nama_produk }}</td>
                                    <td>{{ $value->harga_beli }}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" onclick="pilihProduk('{{ $value->id_produk }}', '{{ $value->kode_produk }}')">
                                            <i class="fa fa-check-circle"></i>
                                            Select
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
    </div>
</div>
