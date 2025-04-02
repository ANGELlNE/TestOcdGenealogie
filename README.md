#  Test O'CD : site de généalogie

## Description du projet

L’objectif de ce projet est créer un site de généalogie avec le framework Laravel dans le cadre d'une candidature pour un stage de développement full stack.

## Roadmap

- [x] Partie 1
- [x] Partie 2
- [x] Partie 3
- [ ] Optimisation du code & Correction des bugs

## Partie 3

### 1. Concevez la structure d'une base de données répondant au problème. Répondez sous forme d'image ou en mettant un lien dans votre fichier README vers un générateur de schéma tel que dbdiagram.io :

https://dbdiagram.io./d/Diagram-Partie-3-67edc7164f7afba184265a38

### 2. Décrivez comment les données évolues (insertions, updates) au fil des cas "Propositions de Modifications" et "Validation des Modifications" pour montrer que votre structure répond bien au problème :

Lorsqu'un utilisateur propose une modification (par exemple, ajouter une relation parent-enfant), une entrée est insérée dans la table `modification_proposals` :

```sql
INSERT INTO modification_proposals (user_id, target_type, target_id, proposal_description, status, created_at)
VALUES (rose03.id, 'relation', 123, 'Ajout relation parent-enfant entre Jean PERRET et Rose PERRET', 'pending', NOW());
```

Les utilisateurs votent pour accepter ou rejeter la proposition. Chaque vote est enregistré dans la table modification_approvals :

```sql
INSERT INTO modification_approvals (modification_proposal_id, user_id, vote, created_at)
VALUES (123, jean01.id, 'accepted', NOW());
```

Si 3 utilisateurs acceptent la proposition, elle est validée et son statut passe à accepted :

```sql
UPDATE modification_proposals SET status = 'accepted' WHERE id = 123;
```

Si 3 utilisateurs rejettent la proposition, elle est rejetée et son statut passe à rejected :

```sql
UPDATE modification_proposals SET status = 'rejected' WHERE id = 123;
```

Une fois la proposition validée, la modification est appliquée. Par exemple, si la relation est acceptée, elle est ajoutée dans la table relationships :

```sql
INSERT INTO relationships (created_by, parent_id, child_id, created_at)
VALUES (rose03.id, jean01.id, rose03.id, NOW());
```

Si la proposition est rejetée (3 votes rejetés), aucune modification n'est appliquée et le statut dans modification_proposals est mis à jour à rejected :

```sql
UPDATE modification_proposals SET status = 'rejected' WHERE id = 123;
```
