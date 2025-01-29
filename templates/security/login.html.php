<?php $layout = 'base.html.php'; ?>
<div class="container py-5">
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=nom_de_ta_bdd;charset=utf8", "root", "");
    echo "Connexion réussie !";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}?>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">

            <h1>Connexion</h1>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form action="/login" method="post">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="username" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="text-center">
                <p class="text-muted">Vous n'avez pas de compte ? <a href="/register">Inscrivez-vous</a></p>
            </div>

        </div>
    </div>




</div>