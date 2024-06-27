<div>
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="text-center table table-bordered border-primary">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Fecha de registro</th>
                        <th width="3%">...</th>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>
                                <td>
                                    <a wire:click="$dispatch('delete',{id: {{ $user->id }}, eventName: 'destroyUser'})" class="pointer btn btn-danger btn-sm" title="Eliminar">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">Sin registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            {{ $users->links() }}
        </div>
    </div>

</div>