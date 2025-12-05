<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>Perfil - {{ $usuario->nombre }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* --- Estilos para impresión (dompdf) --- */
    body { font-family: DejaVu Sans, Arial, sans-serif; color: #111; font-size: 12px; }
    .container { padding: 18px; }
    .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
    .title { color:#1f8f3a; font-size:18px; font-weight:700; }
    .muted { color:#666; font-size:11px; }
    .card { border: 1px solid #eee; padding:10px; border-radius:6px; margin-bottom:10px; }
    .row { display:flex; gap:12px; }
    .col { flex:1; }
    .label { font-weight:700; color:#222; margin-bottom:6px; }
    .small { font-size:11px; color:#444; }
    .badge { display:inline-block; padding:4px 8px; border-radius:12px; font-weight:700; font-size:11px; }
    .badge-normal { background:#d4edda; color:#1f8f3a; }
    .badge-sobre { background:#fff3cd; color:#b88600; }
    .badge-obeso { background:#f8d7da; color:#b50000; }
    .badge-bajo  { background:#dbf0ff; color:#005d8f; }

    /* Barra IMC */
    .imc-bar { width:100%; height:10px; border-radius:6px; background:#eee; overflow:hidden; margin-top:8px; }
    .imc-fill { height:100%; background:#1f8f3a; }

    /* Mini gráfica (SVG) */
    .mini-chart { width:100%; height:60px; }

    /* Medallas */
    .medals { display:flex; gap:8px; margin-top:6px; }
    .medal { padding:6px 8px; border-radius:8px; border:1px solid #ddd; font-weight:700; font-size:12px; }

    /* Tabla resumen */
    table { width:100%; border-collapse: collapse; font-size:12px; }
    th, td { padding:6px 8px; border:1px solid #eee; text-align:left; }
    .text-right { text-align:right; }

    /* Footer */
    .footer { margin-top:12px; font-size:11px; color:#666; text-align:center; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div>
        <div class="title">Perfil: {{ $usuario->nombre }}</div>
        <div class="muted">Email: {{ $usuario->email }} • Registrado: {{ $usuario->fechaRegistro }}</div>
      </div>

      <div style="text-align:right">
        <div class="small">ID: {{ $usuario->id }}</div>
      </div>
    </div>

    {{-- MINI RESUMEN --}}
    <div class="row">
      <div class="col card">
        <div class="label">Última valoración</div>
        <div class="small">
          Peso: <strong>{{ $ultimaValoracion->peso }} kg</strong><br>
          Altura: <strong>{{ $ultimaValoracion->altura }} cm</strong><br>
          Fecha: <strong>{{ $ultimaValoracion->created_at->format('d/m/Y') }}</strong>
        </div>
        <div style="margin-top:6px;">
          IMC: <strong>{{ $ultimaValoracion->imc }}</strong>
          @php
            $imc = $ultimaValoracion->imc;
            if ($imc < 18.5) $clas = 'badge-bajo';
            elseif ($imc < 25) $clas = 'badge-normal';
            elseif ($imc < 30) $clas = 'badge-sobre';
            else $clas = 'badge-obeso';
          @endphp
          <span class="badge {{ $clas }}">{{ ucfirst($clas) }}</span>
        </div>

        <div class="imc-bar">
          @php
            $porcentaje = min(100, ($imc / 30) * 100);
          @endphp
          <div class="imc-fill" style="width: {{ $porcentaje }}%;"></div>
        </div>
      </div>

      <div class="col card">
        <div class="label">Plan nutricional</div>
        @if($planNutricional)
          <div class="small">
            Calorías: <strong>{{ $planNutricional->calorias_diarias }} kcal</strong><br>
            Proteínas: <strong>{{ $planNutricional->proteinas_gramos }} g</strong><br>
            Carbohidratos: <strong>{{ $planNutricional->carbohidratos_gramos }} g</strong><br>
            Grasas: <strong>{{ $planNutricional->grasas_gramos }} g</strong>
          </div>
        @else
          <div class="small">Sin plan nutricional asignado.</div>
        @endif
      </div>

      <div class="col card">
        <div class="label">Medallas</div>
        <div class="medals">
          {{-- Ejemplo de medallas simples --}}
          <div class="medal" style="background:#eafaf1; color:#0a7a33">🏆 IMC Saludable</div>
          <div class="medal" style="background:#fff7e6; color:#b88600">🔥 Consistencia</div>
          <div class="medal" style="background:#f6eff7; color:#5b2b8a">💪 Constancia</div>
        </div>
      </div>
    </div>

    {{-- COMPARACIÓN: PRIMERA vs ÚLTIMA VALORACIÓN --}}
    <div class="card" style="margin-top:10px;">
      <div class="label">Comparación primera vs última valoración</div>

      @php
        $valoraciones = $usuario->valoraciones()->orderBy('created_at','asc')->get();
        $primera = $valoraciones->first();
        $ultima = $valoraciones->last();
      @endphp

      <table>
        <thead>
          <tr>
            <th>Campo</th>
            <th>Primera ({{ $primera->created_at->format('d/m/Y') }})</th>
            <th>Última ({{ $ultima->created_at->format('d/m/Y') }})</th>
            <th class="text-right">Diferencia</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Peso (kg)</td>
            <td>{{ $primera->peso }}</td>
            <td>{{ $ultima->peso }}</td>
            <td class="text-right">{{ $ultima->peso - $primera->peso }}</td>
          </tr>
          <tr>
            <td>IMC</td>
            <td>{{ $primera->imc }}</td>
            <td>{{ $ultima->imc }}</td>
            <td class="text-right">{{ number_format($ultima->imc - $primera->imc, 2) }}</td>
          </tr>
          {{-- Puedes agregar más filas si quieres --}}
        </tbody>
      </table>
    </div>

    {{-- MINI GRÁFICA (SVG) --}}
    <div class="card" style="margin-top:10px;">
      <div class="label">Gráfica IMC (últimos valores)</div>

      {{-- SVG line chart: construimos puntos desde $valoracionesHistorico --}}
      @php
        $vals = $valoracionesHistorico->toArray();
        if(count($vals) < 2) {
            $vals = array_pad($vals, 6, end($vals) ?: 0);
        }
        $max = max($vals);
        $min = min($vals);
        $range = max(1, $max - $min);
        $pointsArr = [];
        $step = 120 / (count($vals)-1);
        foreach($vals as $i => $v){
            $x = $i * $step + 10;
            $y = 60 - ( ($v - $min) / $range * 40 );
            $pointsArr[] = "{$x},{$y}";
        }
        $points = implode(' ', $pointsArr);
      @endphp

      <svg class="mini-chart" viewBox="0 0 140 70" xmlns="http://www.w3.org/2000/svg">
        <polyline fill="none" stroke="#1f8f3a" stroke-width="2" points="{{ $points }}" />
      </svg>
      <small class="small">IMC a lo largo del tiempo</small>
    </div>

    {{-- TABLA DETALLADA DE ÚLTIMAS 6 VALORACIONES --}}
    <div class="card" style="margin-top:10px;">
      <div class="label">Últimas valoraciones</div>

      <table>
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>IMC</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuario->valoraciones()->orderBy('created_at','desc')->take(6)->get() as $v)
            <tr>
              <td>{{ $v->created_at->format('d/m/Y') }}</td>
              <td>{{ $v->peso }} kg</td>
              <td>{{ $v->altura }} cm</td>
              <td>{{ $v->imc }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="footer">
      Generado por FitBoost — {{ now()->format('d/m/Y H:i') }}
    </div>

  </div>
</body>
</html>
