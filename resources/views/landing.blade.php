<!DOCTYPE html>
<html>
<head>
    <title>Contador Pro</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #1e293b;
            padding: 40px;
            border-radius: 16px;
            width: 420px;
            text-align: center;
            color: white;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        h1 {
            margin-bottom: 20px;
        }

        .counter {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
        }

        .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .increment {
            background: #22c55e;
            color: white;
        }

        .increment:hover {
            background: #16a34a;
        }

        .save {
            background: #3b82f6;
            color: white;
        }

        .save:hover {
            background: #2563eb;
        }

        ul {
            margin-top: 25px;
            padding: 0;
            list-style: none;
            max-height: 150px;
            overflow-y: auto;
        }

        li {
            background: #334155;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Contador Laravel</h1>

    <div id="counter" class="counter">0</div>

    <div class="buttons">
        <button class="increment" onclick="increment()">Subir</button>
        <button class="save" onclick="save()">Guardar</button>
    </div>

    <h3>Valores guardados</h3>

    <ul id="list">
        @foreach($counters as $counter)
            <li>{{ $counter->value }}</li>
        @endforeach
    </ul>
</div>

<script>
    let currentValue = 0;

    function increment() {
        currentValue++;
        document.getElementById('counter').innerText = currentValue;
    }

    async function save() {
        if(currentValue === 0) return;

        const response = await fetch('/save', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                value: currentValue
            })
        });

        const data = await response.json();

        const li = document.createElement('li');
        li.innerText = data.value;

        document.getElementById('list').prepend(li);

        currentValue = 0;
        document.getElementById('counter').innerText = 0;
    }
</script>

</body>
</html>
