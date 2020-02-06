# DOCUMENTATION DE L’API REST MOVIES4EVER V0.1 #


L’API Movies4Ever vise à permettre aux utilisateurs finaux de partager avec leurs amis leurs listes de films favoris.

# API EN COURS DE DEVELOPPEMENT #

  Utiliser l’outil PostMan pour tester l’API
	Téléchargement ici -> https://www.postman.com/


* ACTIONS POSSIBLES
---------------- -------- -------- ------ --------------------------  ------ --------------------------  
  Name             	Method   	Scheme   Host   Path                      
---------------- -------- -------- ------ --------------------------  ------ --------------------------  
  _preview_error   	ANY      	ANY      ANY    /_error/{code}.{_format}  
  movies_create    	POST     	ANY      ANY    /movies                   
  movies_show     	GET      	ANY      ANY    /movies/{id}              
  movies_edit      	PUT      	ANY      ANY    /movies/{id}              
  movies_delete  	DELETE   	  ANY      ANY    /movies/{id}              
  movies_list      	GET      	ANY      ANY    /movies                   
  movies_search    	GET      	ANY      ANY    /movies/search/{title}    
  lists_create     	POST     	ANY      ANY    /lists                    
  lists_show       	GET      	ANY      ANY    /lists/{id}               
  lists_edit       	PUT      	ANY      ANY    /lists/{id}               
  lists_delete     	DELETE   	ANY      ANY    /lists/{id}               
---------------- -------- -------- ------ --------------------------  ------ --------------------------  



# DOCUMENTATION DE L’API EN COURS DE REDACTION #
