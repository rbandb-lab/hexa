## Motivation[![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#motivation)

- Notre panel technique fait face à un spectre large de besoins, qui sont d'un degré de complexité très variable
- Il nous faut donc outils et méthodes appropriées pour y répondre

> 💡 Il s'agit de tester comment on peut répondre à des besoins simples mais aussi quand on a plus
plus de règles métier et qu'il devient plus difficile de concevoir et maintenir une application.


## Que propose ce repo ? [![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#roadmap)

Api platform. Un bref rappel historique:
- v1, approche "MakerBundle" et on parvenait [à grands coups d'add-ons] à dépasser FOS_rest_bundle,à appliquer les normes REST, (modèle de maturité de Ridchardson).
- v2, la DX s'améliore et il est facile et rapide de créer une resource et son CRUD, une API conforme aux standards du Web.
- v3, API-P propose des moyens de se plugger entre la Request et la Response pour faire du custom

> 💡 Pour illustrer la proposition du framework, nous allons construire une mini-application en partant du besoin
le plus simple pour aller vers un projet plus élaboré.

## Versionning: [![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#branches)

Branche main:
0. Main projet vide + Readme


### CRUD:

1. Une TodoList\
   Une table "task" (id, name, created_at, updated_at), exposée via Api Platform en ApiResource
   et mappée via les annotations doctrine

2. **Un Kanban**\
   On ajoute une relation "task" - "status"

3. Ajoutons un timer\
   On ajoute une resource timer pour pouvoir mesurer le temps passé par Task
   Pour terminer le CRUD, des tests d'intégration


### Hexa + cqrs:

4. Decouplage
   Utilisation des DataProvider et DataPersister d'API-P pour se découpler du fmwk

5. Ajoutons des stats\
   Restons sur du très basique pour la demo. \
   Somme des temps passés par task. \
   Moyenne du temps passé par task. \
   On pense aussi à ajouter une colonne "estimate" à task

6. Technique [Pomodoro](./Pomodoro.md)

7. Pomodoro from scratch
