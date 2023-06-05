<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>

    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" onsubmit="return validateForm()">
        @csrf
        @method('PUT')
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $usuario->nome }}" required>
        </div>

        <div>
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>
        </div>

        <div>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" onchange="atualizarCidades(false)" required>
                <option value="">Selecione um estado</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}" {{ $estado->id == $usuario->cidade->estado_id ? 'selected' : '' }}>{{ $estado->nome }}</option>
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
            <input type="checkbox" name="hobbies[]" id="hobbie_{{ $hobbie->id }}" value="{{ $hobbie->id }}" {{ in_array($hobbie->id, $hobbieIds) ? 'checked' : '' }}>
            <label for="hobbie_{{ $hobbie->id }}">{{ $hobbie->nome }}</label>
        </div>
    @endforeach
</div>


        <button type="submit">Atualizar</button>
    </form>
</body>
</html>

<script>
    atualizarCidades(true);

    function atualizarCidades(pegacidade) {
        var estadoId = document.getElementById('estado').value;
        var cidadeSelect = document.getElementById('cidade_id');
        cidadeSelect.innerHTML = '<option value="">Carregando...</option>';

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
                if(pegacidade){
                    cidadeSelect.value = '{{ $usuario->cidade_id }}';
                }
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