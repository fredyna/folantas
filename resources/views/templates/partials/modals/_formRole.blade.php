<div class="modal fade" id="form-role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel-2">Form Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-input-role" action="" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" id="id">
                    <input type="hidden" id="url">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama Role</label>
                        <div class="col-sm-9">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Nama Role...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea id="description" name="description" type="text" class="form-control" placeholder="Deskripsi..."></textarea>
                        </div>
                    </div>
                    </div>
                        <div class="modal-footer">
                            <button id="btn-simpan" type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
