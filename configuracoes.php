<?php
require_once 'config.php';
require_once 'models/Auth.php';
require_once 'dao/UserDaoMysql.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'config';

$userDao = new UserDaoMysql($pdo);

require 'partials/header.php';
require 'partials/menu.php';
?>
<section class="feed mt-10">

    <h1>Configurações</h1>
    <form method="POST" class="config-form" enctype="multipart/form-data" action="configuracoes_action.php">
        <label>
            Novo Avatar:<br/>
            <input type="file" name="avatar" />
        </label>
        <label>
            Nova Capa:<br/>
            <input type="file" name="cover" />
        </label>
        <hr/>
        <label>
            Nome Completo:<br/>
            <input type="text" name="name" />
        </label>
        <label>
            E-mail:<br/>
            <input type="email" name="email" />
        </label>
        <label>
            Data de Nascimento:<br/>
            <input type="text" name="birthdate" />
        </label>
        <label>
            Cidade:<br/>
            <input type="text" name="city" />
        </label>
        <label>
            Trabalho:<br/>
            <input type="text" name="work" />
        </label>
        <hr/>
        <label>
            Nova Senha:<br/>
            <input type="password" name="password" />
        </label>
        <label>
            Confirmar Nova Senha:<br/>
            <input type="password" name="password_confirmations" />
        </label>
        <button class="button">Salvar</button>        
    </form>
</section>
<?php
require 'partials/footer.php';
?>