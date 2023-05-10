<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'alpina_digital');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8I!Z>E8vbQPCDqKu#cpyC.hH&0-tJhw1:t/BHhX$ru1Q$>-5.w=A*{$RqFQHV*wb');
define('SECURE_AUTH_KEY',  ');qYs<0JEc#,5{zHX)V~oP!(:p:s8r5S{_ .x);j[Wx)Ir1;|@Nsoq@3Fg*X;_Vp');
define('LOGGED_IN_KEY',    ';Oc~Ge?^*/<9O&D5K;fuNiRb;D-1zJ7`wH4OFV~u7q|@^2EGvP+Q)vfk+>q)zpi!');
define('NONCE_KEY',        'TYz;w{$v@[?D*3c<`u:Ic}td7!3Scxjff4Fay>2Qz2,`X7@@>Xao6foo6(iNh{fq');
define('AUTH_SALT',        '6bjaT7nd*ik[GAjxSK[!},hHV/xgf#CIW|`CdAO7x}`EJ@N7Sf6p nLcKCPC9k>:');
define('SECURE_AUTH_SALT', 'h`wrHb,7IJ9V*z?-VB-JdE4N%*}b5:Z&N CWYxkQdCcOO/nB{w0|M#+Q3f)*fHRR');
define('LOGGED_IN_SALT',   ':Cl,j^{*YfP@8kY;)hr-{rt)~43}8^2Ixe4lWM3z!05+62EbNM^0ugyTx,@kJ(OJ');
define('NONCE_SALT',       '_{XP(:mk):NC?9$>`ZxH6NamZ>+ ##9@-#7rxl_.f:j~IcelD,>w2LR1l$%z#M92');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'fr_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
