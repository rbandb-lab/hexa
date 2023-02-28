## Motivation[![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#motivation)

- Notre panel technique fait face à un spectre large de besoins, qui sont d'un degré de complexité très variable
- Il nous faut donc des outils et des méthodes appropriés

> Dans ce repo, on veut donc tester comment on peut répondre à des besoins simples mais aussi quand on a plus
plus de règles métier et avec l'objectif de concevoir et maintenir une application.


## Que propose ce repo ? [![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#roadmap)

Api platform. Un bref rappel historique:
- v1, approche "MakerBundle" qui permettait [à grands coups d'add-ons] de dépasser FOS_rest_bundle, et d'appliquer les normes REST, cf [modèle de maturité de Richardson](https://martinfowler.com/articles/richardsonMaturityModel.html).
- v2, la DX s'améliore et il est facile et rapide de créer une ressource, son CRUD avec une API conforme aux standards du Web.
- v3, API-P propose de nouveaux moyens de se plugger entre la Request et la Response pour faire du custom

> 💡 Pour illustrer la proposition du framework, nous allons construire une mini-app en partant du besoin
le plus simple pour aller vers un projet plus élaboré.

## Versionning: [![](https://raw.githubusercontent.com/aregtech/areg-sdk/master/docs/img/pin.svg)](#branches)

**Branche main:**
0. Projet initial vide + Readme

Branche crud:

1. Une TodoList
2. Un Kanban
3. Ajoutons un timer
4. Ajoutons des stats

Branches hexa + [CQRS](https://www.martinfowler.com/bliki/CQRS.html) :
5. Technique Pomodoro
