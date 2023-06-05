<!DOCTYPE html>
<html>
<head>
    <title>Criar Usuário</title>
</head>
<body>
    <h1>Criar Usuário</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
            <br>
        </div>
    @endif

    @if (session('warning'))
        <div>
            {{ session('warning') }}
        </div>
        <br>
    @endif

    <form method="POST" action="{{ route('usuarios.store') }}" onsubmit="return validateForm()">
        @csrf

        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" onchange="atualizarCidades()" required>
                <option value="">Selecione um estado</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">{{ $estado->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="cidade_id">Cidade:</label>
            <select name="cidade_id" id="cidade_id" required>
                <option value="">Selecione um estado primeiro</option>
            </select>
        </div>

        <div>
            <label for="hobbies">Hobbies:</label>
            @foreach ($hobbies as $hobbie)
                <div>
                    <input type="checkbox" name="hobbies[]" id="hobbie_{{ $hobbie->id }}" value="{{ $hobbie->id }}">
                    <label for="hobbie_{{ $hobbie->id }}">{{ $hobbie->nome }}</label>
                </div>
            @endforeach
        </div>


        <button type="submit">Criar</button>
    </form>

    <hr>

    <h1>Lista de Usuários</h1>
    @if(count($usuarios) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->cidade->nome }}</td>
                        <td>{{ $usuario->cidade->estado->nome }}</td>
                        <td>
                            @php
                                $usuariohobbies = app('App\Http\Controllers\UsuarioHobbieController')->buscarPorUsuarioId($usuario->id);
                            @endphp
                            @foreach ($usuariohobbies as $usuariohobbie)
                                {{ $usuariohobbie->hobbie->nome }},
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                        </td>
                        <td>
                            <a href="{{ route('usuarios.destroy', $usuario->id) }}">Apagar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum usuário cadastrado.</p>
    @endif
</body>


</html>

<script>
    function atualizarCidades() {
        var estadoId = document.getElementById('estado').value;
        var cidadeSelect = document.getElementById('cidade_id');
        cidadeSelect.innerHTML = '<option value="">Carregando...</option>';
        // Substitua a URL pela rota ou endpoint correto em seu aplicativo
        fetch('/cidadesestados/' + estadoId)
            .then(response => response.json())
            .then(cidades => {
                cidadeSelect.innerHTML = '<option value="">Selecione uma cidade</option>';
                cidades.forEach(cidade => {
                    var option = document.createElement('option');
                    option.value = cidade.id;
                    option.text = cidade.nome;
                    cidadeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Ocorreu um erro:', error);
            });
    }

    function validateForm() {
        var nomeInput = document.getElementById('nome');
        var emailInput = document.getElementById('email');
        var estadoSelect = document.getElementById('estado');
        var cidadeSelect = document.getElementById('cidade_id');
        var checkboxes = document.querySelectorAll('input[name="hobbies[]"]');
        var checked = false;

        if (nomeInput.value === '') {
            alert('Preencha o campo Nome.');
            return false;
        }

        if (emailInput.value === '') {
            alert('Preencha o campo E-mail.');
            return false;
        }

        if (estadoSelect.value === '') {
            alert('Selecione um estado.');
            return false;
        }

        if (cidadeSelect.value === '') {
            alert('Selecione uma cidade.');
            return false;
        }

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = true;
                break;
            }
        }

        if (!checked) {
            alert('Selecione pelo menos um hobby.');
            return false;
        }

        return true;
    }
    

    
</script>