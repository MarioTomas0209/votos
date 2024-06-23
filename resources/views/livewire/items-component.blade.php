<div>
    <div class="card">
        <div class="card-body">

            <div class="card-header">
                <a 
                    class="pointer float-right btn btn-primary" 
                    data-toggle="modal" 
                    wire:click='clear' 
                    data-target="#modalItems">
                    Registrar
                </a>
            </div>

            <div class="table-responsive">
                <table class="text-center table table-bordered border-primary">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th><i class="fas fa-image"></i></th>
                        <th width="3%">...</th>
                        <th width="3%">...</th>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-capitalize">{{ $item->type }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}"
                                    style="width: 4rem">
                            </td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="far fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm" title="Eliminar"><i
                                        class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $items->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalItems" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Registrar Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control @error('name') border-danger @enderror" id="name" wire:model='name'>
                            @error('name')
                                <p class="mt-2 text-danger">{{ $message }}</p>    
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select class="form-control @error('type') border-danger @enderror"" wire:model='type'>
                                <option value="">Seleccione una opción</option>
                                <option value="bebida">Bebida</option>
                                <option value="comida">Comida</option>
                            </select>
                            @error('type')
                                <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Imagen</label><br>
                            <input id="image" wire:model='image_url' type="file" accept="image/*">
                            @error('image_url')
                                <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                        
                            @if ($image_url)
                                <div class="mt-2">
                                    <p>Previsualización de la imagen:</p>
                                    <img src="{{ $image_url->temporaryUrl() }}" alt="Previsualización de la imagen" width="150">
                                </div>
                            @endif
                        </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" wire:click='store' @if(!$image_url) disabled @endif>Guardar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

</div>