<div>
    <div class="card">
        <div class="card-body">

            <div class="card-header">
                <a class="pointer float-right btn btn-primary" data-toggle="modal" wire:click='clear'
                    data-target="#modalItemsComparison">
                    Registrar
                </a>
            </div>

            <div class="table-responsive">
                <table class="text-center table table-bordered border-primary">
                    <thead>
                        <th>ID</th>
                        <th>Item 1</th>
                        <th>Item 2</th>
                        <th>Votos item 1</th>
                        <th>Votos item 2</th>
                        <th width="3%">...</th>
                    </thead>

                    <tbody>
                        @foreach($comparisons as $comparison)
                        @php
                        $item1Wins = $comparison->votes_item1 > $comparison->votes_item2;
                        @endphp
                        <tr>
                            <td>{{ $comparison->id }}</td>
                            <td>
                                <span class="badge {{ $item1Wins ? 'badge-success' : 'badge-danger' }}">
                                    {{ $comparison->item1 ? $comparison->item1->name : 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ !$item1Wins ? 'badge-success' : 'badge-danger' }}">
                                    {{ $comparison->item2 ? $comparison->item2->name : 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $item1Wins ? 'badge-success' : 'badge-danger' }}">
                                    {{ $comparison->votes_item1 }}%
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ !$item1Wins ? 'badge-success' : 'badge-danger' }}">
                                    {{ $comparison->votes_item2 }}%
                                </span>
                            </td>
                            {{-- <td>
                                imagen
                                <img src="{{ $item->image_url ? asset('storage/' . $item->image_url) : asset('no-image.png') }}"
                                    alt="{{ $item->name }}" style="width: 4rem">

                            </td> --}}
                           
                            <td>
                                <a wire:click="$dispatch('delete',{id: {{ $comparison->id }}, eventName: 'destroyComparison'})" class="pointer btn btn-danger btn-sm" title="Eliminar">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{-- {{ $items->links() }} --}}
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalItemsComparison" data-backdrop="static" data-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Comparar Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="type">Item 1</label>
                            <select class="form-control @error('item1_id') border-danger @enderror"
                                wire:model='item1_id'>
                                <option value="">Seleccione una opción</option>
                                @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item1_id')
                            <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="item2_id">Item 2</label>
                            <select class="form-control @error('item2_id') border-danger @enderror"
                                wire:model='item2_id'>
                                <option value="">Seleccione una opción</option>
                                @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('item2_id')
                            <p class="mt-2 text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn {{ $Id == 0 ? 'btn-primary' : 'btn-warning' }}"
                            wire:click="{{ $Id == 0 ? 'store' : 'update' }}" wire:loading.attr="disabled"
                            wire:target="store, update">
                            {{ $Id == 0 ? 'Guardar' : 'Actualizar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>