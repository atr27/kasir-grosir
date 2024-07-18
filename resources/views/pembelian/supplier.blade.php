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
                   <table class="table table-striped table-bordered tabel-supplier">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>{{ $value->telepon }}</td>
                                    <td>{{ $value->alamat }}</td>
                                    <td>
                                        <a href="{{ route('pembelian.create', $value->id_supplier) }}" class="btn btn-success btn-sm">
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
