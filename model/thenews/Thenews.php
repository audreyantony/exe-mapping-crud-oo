<?php


class Thenews
{
    // cet attribut est ajouté depuis la table theuser, il sera utile pour instancier des news lorsqu'on aura besoin du le login de l'utilisateur, ceci pour permettre les jointures dans les méthodes de ThenewManager sans à avoir à utiliser des sous-requêtes ou de multiples objets.
    private string $theUserLogin;

    // EXERCICE créez les autres attributs (noms des champs dans le table "thenews")
    private int $idNews;
    private string $titleNews;
    private string $textNews;
    private string $dateNews;

    // EXERCICE créez le constructeur
    public function __construct(array $datas) {
        if(!empty($datas)){
            $this->hydratation($datas);
        }
    }

    // EXERCICE créez l'hydratateur
    private function hydratation(array $values){
        foreach($values AS $key => $values){
            $setterName = "set".ucfirst($key);
            if(method_exists($this, $setterName)){
                $this->$setterName($values);
            }
        }
    }

    // EXERCICE créez les getters et setters des attributs propre à cette table, n'oubliez pas de protéger les champs avec les setters !
    public function getIdNews() {
        return $this->idNews;
    }

    public function getTitleNews() {
        return html_entity_decode($this->titleNews,ENT_QUOTES);
    }

    public function getTextNews() {
        return html_entity_decode($this->textNews,ENT_QUOTES);
    }

    public function getDateNews() {
        return $this->dateNews;
    }

    public function setIdNews(int $idNews): void {
            $this->idNews = $idNews;
        }

    public function setTitleNews(string $titleNews): void {
        $title = strip_tags(trim($titleNews));
        if(empty($title)){
            trigger_error("Le titre de l'article ne peut pas être vide, il faut le remplir.",E_USER_NOTICE);
        }elseif (strlen($title)>150){
            trigger_error("Votre titre ne peut pas être trop long, il ne doit pas dépasser les 150 caractères",E_USER_NOTICE);
        }else{
            $this->titleNews = $title;
        }
    }

    public function setTextNews(string $textNews): void {
        $text = strip_tags(trim($textNews),"<br>,<p>,<div>,<a>,<img>");
        if(empty($text)){
            print("Vous devez renseigner un texte.");
        }else {
            $this->textNews = $textNews;
        }
    }

    public function setArticleDateTime(string $dateNews): void {
        $rgx = preg_grep("/^(\d{4})-(\d{2})-([\d]{2}) (\d{2}):([0-5]{1})([0-9]{1}):([0-5]{1})([0-9]{1})$/",[$dateNews]);
        if(empty($rgx)){
            print("Le format de la date n'est pas valide");
        }else {
            $this->dateNews = $dateNews;
        }
    }


    // Getters et Setters utiles pour theUserLogin
    /**
     * $theUserLogin's getter
     * @return string
     */
    public function getTheUserLogin(): string
    {
        return $this->theUserLogin;
    }

    /**
     * $theUserLogin's setter
     * @param string $theUserLogin
     */
    public function setTheUserLogin(string $theUserLogin): void
    {
        $theUserLogin = strip_tags(trim($theUserLogin));
        if(strlen($theUserLogin)<3 || strlen($theUserLogin)>60){
            trigger_error("Le login doit être plus grand que 2 et plus petit que 60 caractères!",E_USER_NOTICE );
        }else {
            $this->theUserLogin = $theUserLogin;
        }
    }
}