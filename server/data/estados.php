<?php
// Lista canônica de estados do Brasil. Usar em formulários e exibição.
$estados_brasil = [
    'ac' => 'Acre',
    'al' => 'Alagoas',
    'ap' => 'Amapá',
    'am' => 'Amazonas',
    'ba' => 'Bahia',
    'ce' => 'Ceará',
    'df' => 'Distrito Federal',
    'es' => 'Espírito Santo',
    'go' => 'Goiás',
    'ma' => 'Maranhão',
    'mt' => 'Mato Grosso',
    'ms' => 'Mato Grosso do Sul',
    'mg' => 'Minas Gerais',
    'pa' => 'Pará',
    'pb' => 'Paraíba',
    'pr' => 'Paraná',
    'pe' => 'Pernambuco',
    'pi' => 'Piauí',
    'rj' => 'Rio de Janeiro',
    'rn' => 'Rio Grande do Norte',
    'rs' => 'Rio Grande do Sul',
    'ro' => 'Rondônia',
    'rr' => 'Roraima',
    'sc' => 'Santa Catarina',
    'sp' => 'São Paulo',
    'se' => 'Sergipe',
    'to' => 'Tocantins'
];

function renderEstadoOptions($selecionado = '') {
    global $estados_brasil;
    $out = '';
    foreach ($estados_brasil as $sigla => $nome) {
        // Comparar pelo nome armazenado (mais provável) ou por sigla
        $isSelected = (trim($selecionado) !== '' && (mb_strtolower(trim($selecionado)) === mb_strtolower($nome) || mb_strtolower(trim($selecionado)) === mb_strtolower($sigla)));
        $out .= '<option value="' . htmlspecialchars($nome) . '"' . ($isSelected ? ' selected' : '') . '>' . htmlspecialchars($nome) . '</option>' . "\n";
    }
    return $out;
}

?>