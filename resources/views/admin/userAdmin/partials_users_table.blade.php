
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <select name="role_id" class="role-selector form-control" data-user="{{ $user->id }}">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="is_active" class="active-selector form-control" data-user="{{ $user->id }}">
                            <option value="1" {{ $user->is_active ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </td>
                    <td>
                        <!-- Botón de Editar -->
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow editBtn" data-id="{{ $user->id }}" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>

                        <!-- Botón de Eliminar -->
                        <button type="button" class="btn btn-xs btn-default text-danger mx-1 shadow deleteBtn" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteConfirmationModal" title="Eliminar">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach


