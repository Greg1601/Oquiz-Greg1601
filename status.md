###Liste des tâches###

**GLOBAL** *TODO*
	Reste à faire le traitement des résultats ainsi que finaliser la création des questions.

#1 Page d'accueil -
		*TODO*

		**DONE**
	- Création du QuizModel avec les attributs de quiz, les getters et setters (utilisation du package Atom "PHP getters and setters" et la méthode permettant de récupérer la liste des quiz en BDD
	- Création d'une méthode de controller 'indexAction' (ici ce sera home)
	- Création du template de la home pour afficher la liste des quiz
	- Ajouter les quiz créés par un utilisateur à sa page de profil (attente Authentification)
	- affichage du nom de l'auteur d'un quiz à la place de son ID

#2 Consulter Quiz -
		*TODO*

		**DONE**
	- Ajout de la route /quiz/[id] pour afficher le détail d'un quiz
			Créer route et méthode de controller
			création du template front/quiz
			création de la méthode de QuizModel pour récupérer un quiz par son id
			créer le QuestionModel (propriétés, getters, setters etc...)
			créer méthode de QuestionModel pour récup les questions d'un Quiz
			créer méthode de controller pour récupérer et afficher les données
	- Chaque titre de quiz sur la home doit comporter un lien vers cette page
	- Mélanger les propositions
	- Afficher le niveau des questions


#3 Authentification -
		*TODO*

		**DONE**
	- Mise en place du formulaire de login
	- Redirection vers la page d'accueil après login
	- Création d'un lien de logout
	- Peut jouer à un quiz au lieu de simplement consulter
	- BONUS: Création du formulaire d'inscription

#4 Jouer !
		*TODO*
	- Traitement du résultat (couleurs selon la réponse cochée)
	- Traitement du résultat (score)

		**DONE**
	- donner la possibilité à un utilisateur connecté de jouer
	 		Créer un template list-form.php pour afficher les questions dans un form
			paramétrer le controller => form que pour les utilisateurs connectés
	- Afficher le niveau des questions

#BONUS
		*TODO*
	- créer formulaire permettant de créer les questions pour les nouveaux quizzes

		**DONE**
	- page qui permet de créer un quiz (lien sur la page quand utilisateur identifié + route + méthode dans controller + template)
	- page de profil avec affichage des quiz de l'utilisateur
	- style css "sympa". Le style c'est bon, sympa par contre.....
