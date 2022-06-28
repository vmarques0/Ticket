<?= $this->extend("layouts/app"); ?>
<?= $this->section("body"); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card panel-primary">
                <div class="card-header">Administrar</div>
                <div class="card-body">
                    <h1>Olá, <?= session()->get('name'); ?>!</h1>
                    <h3><a href="<?= site_url('logout') ?>">Sair</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>