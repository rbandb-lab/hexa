# DDD, Hexa et CQRS

- DDD: voir le livre fondateur d'Eric Evans
Grand nombre de ressources sur le [web](https://github.com/heynickc/awesome-ddd#php)
On peut retenir que le focus est sur la conception du point de vue du métier
pour tacler la complexité et parler le même langage. Le code exprime le métier et non le framework utilisé.

- Hexagone: onion architecture ou "ports et adatpers"
1. Utilisation massive d'interfaces pour se découpler du framework. Adapters primaires et secondaires.
2. La notion d'hexagone ou d'oignon renvoie à la présence de "couches" applicatives.
Chaque couche ne peut communiquer qu'avec la couche inférieure. Typiquement:
  - Infrastructure (dont controllers) -> Domaine
  - Domaine -> Infrastructure (dont couche de persistence)
3. L'image est peu parlante, on pourrait comparer le trajet de la requete et de la reponse
à un aéroport et un avion dans le business du voyage ...

- CQRS: séparation entre Write (command) et Read (query)\
Cette ségrégation permet d'articuler l'application et d'avoir un code plus facile à comprendre
car plus aligné sur les actions
1. Le bus de command procède aux mutations de l'état de l'app
2. le bus de query est read-only et permet d'avoir une logique de "views"
3. un event bus est souvent ajouté pour les effets de bords désirés = ex envoi d'email

Attention, l'état de l'application n'est pas équivalent à l'état de la base de données.

En base de données on enregistre des tables, liées à des entities. Une entité est une représentation objet
qui représente une structure de données à persister dans un storage.

Dans le domaine on manipule des 'models'. Un model est une représentation abstraite qui permet 
de résoudre un problème.

Les points d'API peuvent notamment exposer des "verbs" qui reflètent des actions métier
et pas simplement la création d'entities.

Ce changement de focus permet d'abstraire la logique du framework, qui n'est pas la logique de l'application

# Api Platform

A) Api P propose une arborescence orientée framework par defaut. Il nous faut donc
distinguer d'abord comment nommer les choses ("nommer c'est faire exister") et enfin comment isoler
notre logique.
- Le dossier sources contient donc :
1. Un dossier "Domain" (a renommer en fonction du contexte). Les services appelés par le domaine
sont représentés par leur interface. Il peut y avoir plusieurs "Domain". Dans le cas d'une billeterie on pourrait
avoir "Booking", "Payment", etc.
2. Un dossier "Infrastructure". Il contient le tooling, les implémentations des services appelés dans le domaine.
3. Un dossier "Shared". Outils communs.

4. "Application" est un dossier facultatif, qui permet de séparer pour plus de clarté une sous-partie du domaine.
Dans notre cas, les Command et les Queries

B) Les tests. 
- L'intérêt premier d'un domaine isolé et protégé est de n'y trouver que du métier. Cela permet
de concentrer les tests d'acceptance, unitaires et fonctionnels sur cette partie.
On privilégie l'utilisation de repositories "in-memory" pour exécuter les tests rapidement.
Attention on teste les cas d'utilisation, les comportements métier.
- Dans le cas d'une API il peut être souhaitable d'ajouter des tests d'entrée sortie de payloads et de réponses
