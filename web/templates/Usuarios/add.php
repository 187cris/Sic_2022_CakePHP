<div class = "row">
    <aside class = "column">
        <div clas = "side-nav">
            <?= $this->Html->link("Voltar", ["action" => "login"],
            ["class" => "side-nav-item"]) ?>
        </div>
    </aside>

    <div class = "column-responsive column-80">
        <div class = "form content">
            <?= $this->Form->create($usuario) ?>
            
            <fieldset>
                <legend>Criar usuário</legend>
                <?php
                    echo $this->Form->control('nome');
                    echo $this->Form->control('usuario', ["label" => "usuario"]);
                    echo $this->Form->control('senha', ["type" => "password",
                    "label" => "senha"]);
                ?>
            </fieldset>

            <?= $this->Form->button("Enviar") ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>