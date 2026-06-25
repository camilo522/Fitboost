@php
    $fechaGeneracion = now()->format('d/m/y');
    
    // Calcular el IMC actual para la cabecera si existe valoración
    $imcActual = 'N/A';
    if ($ultimaValoracion && $ultimaValoracion->peso && $ultimaValoracion->altura) {
        $imcActual = round($ultimaValoracion->peso / (($ultimaValoracion->altura / 100) ** 2), 1);
    }

    // Calcular porcentajes para la gráfica de macros si existe el plan
    $pctProteina = 0;
    $pctCarbos = 0;
    $pctGrasas = 0;
    if ($planNutricional) {
        $totalGramos = $planNutricional->proteinas_gramos + $planNutricional->carbohidratos_gramos + $planNutricional->grasas_gramos;
        if ($totalGramos > 0) {
            $pctProteina = round(($planNutricional->proteinas_gramos / $totalGramos) * 100);
            $pctCarbos = round(($planNutricional->carbohidratos_gramos / $totalGramos) * 100);
            $pctGrasas = round(($planNutricional->grasas_gramos / $totalGramos) * 100);
        }
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte FitBoost - {{ $usuario->nombre }}</title>
    <style>
        @page {
            margin: 40px 30px;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #2c3e50;
            background: #ffffff;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }

        /* Estructuras de bloque seguras para dompdf */
        .table-layout {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 20px;
        }
        .table-layout td {
            padding: 0;
            vertical-align: top;
        }

        /* Cabecera Principal */
        .header-bg {
            background-color: #102a43;
            padding: 25px;
            border-radius: 12px;
            color: #ffffff;
            margin-bottom: 25px;
        }
        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .header-subtitle {
            font-size: 12px;
            color: #9fb3c8;
            margin-top: 4px;
            margin-bottom: 0;
        }

        /* Contenedores / Tarjetas */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            background: #ffffff;
        }
        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #102a43;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 2px solid #39A900;
            padding-bottom: 5px;
        }

        /* Detalles de Filas de Información */
        .info-grid {
            width: 100%;
            margin-bottom: 5px;
        }
        .info-grid td {
            padding: 6px 0;
            font-size: 13px;
            border-bottom: 1px dashed #f1f5f9;
        }
        .label {
            font-weight: 600;
            color: #627d98;
            width: 40%;
        }
        .value {
            color: #102a43;
            font-weight: bold;
        }

        /* Imagen de Perfil */
        .profile-box {
            text-align: right;
            width: 100px;
        }
        .profile-image {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            border: 3px solid #39A900;
        }

        /* Tablas de Datos del Historial */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th {
            background-color: #f8fafc;
            color: #486581;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            padding: 10px;
            border-bottom: 2px solid #cbd5e1;
            text-align: center;
        }
        .data-table td {
            padding: 10px;
            font-size: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #334e68;
            text-align: center;
        }
        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* GRÁFICAS DE BARRAS NATIVAS (CSS seguro para dompdf) */
        .chart-container {
            margin-top: 15px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        .chart-row {
            margin-bottom: 12px;
        }
        .chart-label {
            font-size: 11px;
            font-weight: 600;
            color: #486581;
            margin-bottom: 4px;
        }
        .bar-bg {
            background: #e2e8f0;
            border-radius: 20px;
            width: 100%;
            height: 14px;
            overflow: hidden;
        }
        .bar-fill {
            height: 14px;
            border-radius: 20px;
        }
        .bg-proteina { background-color: #39A900; } /* Verde SENA / FitBoost */
        .bg-carbos { background-color: #243b53; }    /* Azul Oscuro */
        .bg-grasas { background-color: #f5a623; }    /* Naranja Cálido */

        .badge {
            background-color: #e1f9e5;
            color: #107c10;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #9fb3c8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header-bg">
        <table class="table-layout">
            <tr>
                <td>
                    <h1 class="header-title">FITBOOST REPORT</h1>
                    <p class="header-subtitle">Informe Macrológico y Antropométrico Integral</p>
                    <p class="header-subtitle" style="color: #39A900; font-weight: bold; margin-top: 8px;">
                        Fecha de Emisión: {{ $fechaGeneracion }} 
                    </p>
                </td>
                <td style="text-align: right; color: #ffffff; font-size: 12px; padding-top: 5px;">
                    <strong>Estado del Plan:</strong> <span class="badge" style="background-color: #39A900; color: #fff;">ACTIVO</span><br>
                    <span style="display: block; margin-top: 8px;">IMC Actual: <strong>{{ $imcActual }}</strong></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="card">
        <h2 class="section-title">Información del Atleta</h2>
        <table class="table-layout">
            <tr>
                <td>
                    <table class="info-grid">
                        <tr>
                            <td class="label">Nombre Completo:</td>
                            <td class="value">{{ $usuario->nombre }}</td>
                        </tr>
                        <tr>
                            <td class="label">Correo Electrónico:</td>
                            <td class="value">{{ $usuario->email }}</td>
                        </tr>
                        <tr>
                            <td class="label">Fecha de Incorporación:</td>
                            <td class="value">{{ $usuario->fechaRegistro?->format('d/m/Y') ?? 'No registrada' }}</td>
                        </tr>
                    </table>
                </td>
                @if($usuario->foto)
                    <td class="profile-box">
                        <img src="{{ public_path('storage/' . $usuario->foto) }}" class="profile-image" alt="User">
                    </td>
                @endif
            </tr>
        </table>
    </div>

    <div class="card">
        <h2 class="section-title">Estructura Nutricional Actual</h2>
        @if($planNutricional)
            <table class="table-layout" style="margin-bottom: 5px;">
                <tr>
                    <td style="width: 50%;">
                        <table class="info-grid" style="width: 90%;">
                            <tr>
                                <td class="label">Objetivo Calórico:</td>
                                <td class="value" style="color: #39A900; font-size: 15px;">{{ $planNutricional->calorias_diarias }} kcal</td>
                            </tr>
                            <tr>
                                <td class="label">Proteínas (g):</td>
                                <td class="value">{{ $planNutricional->proteinas_gramos }} g</td>
                            </tr>
                            <tr>
                                <td class="label">Carbohidratos (g):</td>
                                <td class="value">{{ $planNutricional->carbohidratos_gramos }} g</td>
                            </tr>
                            <tr>
                                <td class="label">Grasas Totales (g):</td>
                                <td class="value">{{ $planNutricional->grasas_gramos }} g</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <div class="chart-container">
                            <div style="font-size: 12px; font-weight: bold; color: #102a43; margin-bottom: 10px; text-align: center;">
                                Balance de Macronutrientes (%)
                            </div>
                            
                            <div class="chart-row">
                                <div class="chart-label">Proteínas: {{ $pctProteina }}%</div>
                                <div class="bar-bg"><div class="bar-fill bg-proteina" style="width: {{ $pctProteina }}%;"></div></div>
                            </div>
                            
                            <div class="chart-row">
                                <div class="chart-label">Carbohidratos: {{ $pctCarbos }}%</div>
                                <div class="bar-bg"><div class="bar-fill bg-carbos" style="width: {{ $pctCarbos }}%;"></div></div>
                            </div>
                            
                            <div class="chart-row" style="margin-bottom: 0;">
                                <div class="chart-label">Grasas: {{ $pctGrasas }}%</div>
                                <div class="bar-bg"><div class="bar-fill bg-grasas" style="width: {{ $pctGrasas }}%;"></div></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div style="font-size: 11px; color: #486581; background: #f0f4f8; padding: 10px; border-radius: 6px; margin-top: 10px;">
                <strong>Directrices del Asesor:</strong> {{ $planNutricional->consejos_adicionales ?? 'Seguir las pautas calóricas normadas.' }}
            </div>
        @else
            <p style="font-size: 12px; color: #627d98;">El usuario no cuenta con un plan de nutrición asignado actualmente.</p>
        @endif
    </div>

    <div class="card">
        <h2 class="section-title">Métricas Antropométricas Recientes</h2>
        @if($ultimaValoracion)
            <table class="table-layout" style="margin-bottom: 0;">
                <tr>
                    <td style="width: 50%;">
                        <table class="info-grid" style="width: 90%;">
                            <tr><td class="label">Peso Corporal:</td><td class="value">{{ $ultimaValoracion->peso }} kg</td></tr>
                            <tr><td class="label">Estatura:</td><td class="value">{{ $ultimaValoracion->altura }} cm</td></tr>
                            <tr><td class="label">Perímetro Pecho:</td><td class="value">{{ $ultimaValoracion->pecho }} cm</td></tr>
                            <tr><td class="label">Perímetro Cintura:</td><td class="value">{{ $ultimaValoracion->cintura }} cm</td></tr>
                            <tr><td class="label">Perímetro Cadera:</td><td class="value">{{ $ultimaValoracion->cadera }} cm</td></tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <table class="info-grid" style="width: 100%;">
                            <tr><td class="label">Brazo (Der/Izq):</td><td class="value">{{ $ultimaValoracion->brazoDerecho }} / {{ $ultimaValoracion->brazoIzquierdo }} cm</td></tr>
                            <tr><td class="label">Antebrazo (Der/Izq):</td><td class="value">{{ $ultimaValoracion->antebrazoDerecho }} / {{ $ultimaValoracion->antebrazoIzquierdo }} cm</td></tr>
                            <tr><td class="label">Muslo (Der/Izq):</td><td class="value">{{ $ultimaValoracion->piernaDerecha }} / {{ $ultimaValoracion->piernaIzquierda }} cm</td></tr>
                            <tr><td class="label">Pantorrilla (Der/Izq):</td><td class="value">{{ $ultimaValoracion->pantorrillaDerecha }} / {{ $ultimaValoracion->pantorrillaIzquierda }} cm</td></tr>
                            <tr><td class="label">Fecha Medición:</td><td class="value">{{ $ultimaValoracion->fecha->format('d/m/Y') }}</td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        @else
            <p style="font-size: 12px; color: #627d98;">No existen valoraciones registradas para este atleta.</p>
        @endif
    </div>

    <div class="card" style="page-break-inside: avoid;">
        <h2 class="section-title">Evolución Histórica</h2>
        @if(isset($historialValoraciones) && $historialValoraciones->isNotEmpty())
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Fecha de Control</th>
                        <th>Peso Registrado</th>
                        <th>Estatura</th>
                        <th>Índice IMC</th>
                        <th>Origen del Registro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historialValoraciones as $historial)
                        <tr>
                            <td><strong>{{ $historial->fecha?->format('d/m/Y') }}</strong></td>
                            <td>{{ $historial->peso }} kg</td>
                            <td>{{ $historial->altura }} cm</td>
                            <td>
                                <strong>
                                    {{ $historial->peso && $historial->altura ? round($historial->peso / (($historial->altura / 100) ** 2), 1) : 'N/A' }}
                                </strong>
                            </td>
                            <td>{{ $historial->tipo_accion ?? 'Evaluación Periódica' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="font-size: 12px; color: #627d98;">Sin registros previos en el historial clínico.</p>
        @endif
    </div>

    <div class="footer">
        FitBoost Management System • Documento confidencial generado de forma automatizada.
    </div>

</body>
</html>