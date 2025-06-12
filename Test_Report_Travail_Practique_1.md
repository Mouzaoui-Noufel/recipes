# Travail Pratique N1 : Conception et Exécution d'un Test Logiciel

## 1. Exigences Fonctionnelles de l'Application

L'application testée est un site web Laravel de gestion et partage de recettes.  
Fonctionnalités principales :  
- Inscription et connexion des utilisateurs  
- Création, lecture, mise à jour et suppression (CRUD) des recettes  
- Notation et commentaires sur les recettes  
- Interface responsive avec Tailwind CSS  
- API pour les recettes  

## 2. Cas de Test

### 2.1 Test d'Inscription et Connexion Utilisateur

| Entrée | Action | Résultat Attendu |
|--------|--------|------------------|
| Données valides d'inscription | Soumettre le formulaire d'inscription | Compte créé, redirection vers la page d'accueil |
| Données invalides (email déjà utilisé) | Soumettre le formulaire d'inscription | Message d'erreur affiché |
| Identifiants valides | Soumettre le formulaire de connexion | Connexion réussie, redirection vers la page d'accueil |
| Identifiants invalides | Soumettre le formulaire de connexion | Message d'erreur affiché |

### 2.2 Test CRUD Recettes

| Entrée | Action | Résultat Attendu |
|--------|--------|------------------|
| Données valides de recette | Créer une nouvelle recette | Recette ajoutée et visible dans la liste |
| Modification des données | Modifier une recette existante | Recette mise à jour avec succès |
| Suppression d'une recette | Supprimer une recette | Recette supprimée de la liste |

### 2.3 Test Notation et Commentaires

| Entrée | Action | Résultat Attendu |
|--------|--------|------------------|
| Note valide | Ajouter une note à une recette | Note enregistrée et affichée |
| Commentaire valide | Ajouter un commentaire | Commentaire enregistré et affiché |

## 3. Exécution des Tests et Observations

Les tests ont été exécutés manuellement selon le plan de test.  
Observations principales :

### 3.1 Inscription et Connexion Utilisateur
- Inscription avec données valides : succès, compte créé.
- Inscription avec email déjà utilisé : message d'erreur "The email has already been taken."
- Connexion avec identifiants valides : succès, connexion réussie.
- Connexion avec identifiants invalides : message d'erreur "The provided credentials do not match our records."

### 3.2 Gestion des Recettes (CRUD)
- Création d'une nouvelle recette avec données valides : succès, message "Recipe created!"
- Modification d'une recette existante : succès, message "Recipe updated!"
- Suppression d'une recette : succès, message "Recipe deleted successfully."
- Recettes listées correctement.

### 3.3 Notation et Commentaires
- Notes et commentaires apparaissent correctement.

### 3.4 Déconnexion
- Déconnexion réussie.

Aucune anomalie majeure détectée.

## 4. Rapport d'Anomalies et Recommandations

Aucune anomalie majeure détectée lors des tests manuels.  
L'application fonctionne conformément aux exigences fonctionnelles.  
