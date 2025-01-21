# TODOLIST

## BUGS

* Les utilisateurs peuvent se connecter sans mot de passe
on récup en :   $username = htmlspecialchars(trim($_POST['username'] ?? ''));
                $password = htmlspecialchars(trim($_POST['password'] ?? ''));
on vérif le mdp mais il vaudrait mieux le hacher 
 $password === $user->getPassword(

* Des utilsateurs non admin ont des accès à l'interface de gestion des utilisateurs
rajouter "guard": "App\\Guard\\AdminGuard" sur les routes qui ne sont pas protégé
* Problème de redirection après l'ajout d'un nouveau ticket
TicketController ligne 50 : header('Location: /user/ticket');
* Erreur au niveau de l'API

## FAILLES

Faire un audit des failles présentes dans l'application et fournir des préconisations pour chacune d'entre elles.

Proposer un correctif si cela est possible et le déployer.
