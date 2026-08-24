<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Idade - Aplicação em Nuvem</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="number"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.1);
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        .result {
            margin-top: 30px;
            padding: 20px;
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            border-radius: 5px;
            display: none;
        }

        .result.show {
            display: block;
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-text {
            color: #333;
            font-size: 18px;
            font-weight: 600;
        }

        .error {
            color: #d32f2f;
            background-color: #ffebee;
            border-left-color: #d32f2f;
        }

        .success {
            color: #388e3c;
            background-color: #e8f5e9;
            border-left-color: #388e3c;
        }

        .warning {
            color: #f57f17;
            font-size: 14px;
            margin-top: 8px;
            display: none;
        }

        .warning.show {
            display: block;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: #999;
            font-size: 12px;
        }

        .info-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎂 Calculadora de Idade</h1>
        <p class="info-badge">Aplicação executada em nuvem com sucesso!</p>

        <form id="ageForm" method="POST" action="">
            <div class="form-group">
                <label for="birthYear">Ano de Nascimento:</label>
                <input 
                    type="number" 
                    id="birthYear" 
                    name="birthYear" 
                    min="1900" 
                    max="<?php echo date('Y'); ?>" 
                    placeholder="Ex: 1995"
                    required
                >
            </div>

            <div class="form-group">
                <label for="name">Seu Nome (Opcional):</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Ex: João Silva"
                    maxlength="100"
                >
            </div>

            <button type="submit">Calcular Idade</button>
            <div class="warning" id="warning"></div>
        </form>

        <div class="result" id="result">
            <div class="result-text" id="resultText"></div>
        </div>
    </div>

    <footer>
        <p>© <?php echo date('Y'); ?> - Computação em Nuvem | Desenvolvido com PHP</p>
    </footer>

    <script>
        document.getElementById('ageForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const birthYear = parseInt(document.getElementById('birthYear').value);
            const name = document.getElementById('name').value.trim();
            const resultDiv = document.getElementById('result');
            const resultText = document.getElementById('resultText');
            const warningDiv = document.getElementById('warning');

            // Validação do ano de nascimento
            const currentYear = new Date().getFullYear();
            if (birthYear > currentYear) {
                resultDiv.classList.add('error');
                resultDiv.classList.remove('success');
                resultText.textContent = '❌ Erro: O ano de nascimento não pode ser maior que o ano atual.';
                resultDiv.classList.add('show');
                return;
            }

            if (birthYear < 1900) {
                resultDiv.classList.add('error');
                resultDiv.classList.remove('success');
                resultText.textContent = '❌ Erro: Por favor, insira um ano de nascimento válido.';
                resultDiv.classList.add('show');
                return;
            }

            // Cálculo da idade
            const age = currentYear - birthYear;

            // Montar mensagem
            let message = `✅ Você tem <strong>${age} ano${age !== 1 ? 's' : ''}</strong> de idade`;
            if (name) {
                message = `✅ Olá <strong>${name}</strong>! Você tem <strong>${age} ano${age !== 1 ? 's' : ''}</strong> de idade`;
            }

            // Avisos
            if (age > 120) {
                warningDiv.textContent = '⚠️ Aviso: A idade calculada parece incomum. Verifique o ano de nascimento.';
                warningDiv.classList.add('show');
            } else {
                warningDiv.classList.remove('show');
            }

            // Mostrar resultado
            resultDiv.classList.remove('error');
            resultDiv.classList.add('success');
            resultText.innerHTML = message;
            resultDiv.classList.add('show');

            // Limpar foco
            this.reset();
            document.getElementById('birthYear').focus();
        });

        // Focar no campo de ano ao carregar a página
        window.addEventListener('load', function() {
            document.getElementById('birthYear').focus();
        });
    </script>
</body>
</html>
