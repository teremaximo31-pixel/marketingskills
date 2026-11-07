<?php
/* Cópia de segurança das aplicações das mentorias da página /links.
 * O e-mail para o Rene sai pelo FormSubmit (o mail() do PHP está desligado nesta hospedagem).
 * Cada aplicação fica guardada em dados/aplicacoes.csv (pasta bloqueada para o navegador). */

header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo '{"success":false}'; exit; }

$dados = json_decode(file_get_contents('php://input'), true);
if (!is_array($dados)) { http_response_code(400); echo '{"success":false}'; exit; }
if (!empty($dados['site'])) { echo '{"success":true}'; exit; } // robô

$limpa = fn($v, $max = 2000) => mb_substr(trim(str_replace(["\r", "\0"], '', (string)$v)), 0, $max);
$linhas = [];
foreach ($dados as $k => $v) {
  if (str_starts_with((string)$k, '_')) continue;
  $linhas[$limpa($k, 80)] = $limpa($v);
}
$nome  = preg_replace('/[\n\t]+/', ' ', $linhas['Nome'] ?? '');
$email = preg_replace('/[\n\t]+/', ' ', $linhas['email'] ?? '');
$produto = preg_replace('/[\n\t]+/', ' ', $linhas['Produto'] ?? 'Mentoria');
if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(422); echo '{"success":false}'; exit;
}

date_default_timezone_set('America/Sao_Paulo');
$quando = date('d/m/Y H:i');
$linhas['Data'] = $quando;

$pasta = __DIR__ . '/dados';
if (!is_dir($pasta)) { @mkdir($pasta, 0750, true); }
if (!file_exists($pasta . '/.htaccess')) { @file_put_contents($pasta . '/.htaccess', "Require all denied\n"); }
$ok = false;
if ($h = @fopen($pasta . '/aplicacoes.csv', 'a')) {
  $ok = fputcsv($h, [json_encode($linhas, JSON_UNESCAPED_UNICODE)]) !== false;
  fclose($h);
}
echo json_encode(['success' => $ok]);
