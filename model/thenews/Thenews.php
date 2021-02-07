<?php


class Thenews
{
    // cet attribut est ajouté depuis la table theuser, il sera utile pour instancier des news lorsqu'on aura besoin du le login de l'utilisateur, ceci pour permettre les jointures dans les méthodes de ThenewManager sans à avoir à utiliser des sous-requêtes ou de multiples objets.
    private string $theUserLogin;

    // EXERCICE créez les autres attributs (noms des champs dans le table "thenews")
    private int $idtheNews;
    private string $theNewsTitle;
    private string $theNewsText;
    private string $theNewsDate;
    private int $theUser_idtheUser;

    // EXERCICE créez le constructeur
    public function __construct(Array $param){
        $this->hydrate($param);
    }

    // EXERCICE créez l'hydratateur
    private function hydrate(Array $datas){
        foreach($datas as $key => $value){
            $methodSetters = "set".ucfirst($key);
            if(method_exists($this,$methodSetters)){
                $this->$methodSetters($value);
            }
        }
    }

    // EXERCICE créez les getters et setters des attributs propre à cette table, n'oubliez pas de protéger les champs avec les setters !
    /**
     * $idtheNews's getter
     * @return int
     */
    public function getidtheNews() {
        return $this->idtheNews;
    }

    /**
     * $theNewsTitle's getter
     * @return string
     */
    public function gettheNewsTitle() {
        return html_entity_decode($this->theNewsTitle,ENT_QUOTES);
    }

    /**
     * $theNewsText's getter
     * @return string
     */
    public function gettheNewsText() {
        return html_entity_decode($this->theNewsText,ENT_QUOTES);
    }

    /**
     * $theNewsDate's getter
     * @return string
     */
    public function gettheNewsDate() {
        return $this->theNewsDate;
    }

    /**
     * $theUser_idtheUser's getter
     * @return int
     */
    public function gettheUser_idtheUser() {
        return html_entity_decode($this->theUser_idtheUser,ENT_QUOTES);
    }

    /**
     * $idNews's setter
     * @param int $idtheNews
     */
    public function setidtheNews(int $idtheNews): void {
            $this->idtheNews = $idtheNews;
        }

    /**
     * $theNewsTitle's setter
     * @param string $theNewsTitle
     */
    public function settheNewsTitle(string $theNewsTitle): void {
        $title = strip_tags(trim($theNewsTitle));
        if(empty($title)){
            trigger_error("Le titre de l'article ne peut pas être vide, il faut le remplir.",E_USER_NOTICE);
        }elseif (strlen($title)>150){
            trigger_error("Votre titre ne peut pas être trop long, il ne doit pas dépasser les 150 caractères",E_USER_NOTICE);
        }else{
            $this->theNewsTitle = $title;
        }
    }

    /**
     * $theNewsText's setter
     * @param string $theNewsText
     */
    public function settheNewsText(string $theNewsText): void {
        $text = strip_tags(trim($theNewsText),"<br>,<p>,<div>,<a>,<img>");
        if(empty($text)){
            print("Vous devez renseigner un texte.");
        }else {
            $this->theNewsText = $theNewsText;
        }
    }

    /**
     * $theNewsDate's setter
     * @param string $theNewsDate
     */
    public function settheNewsDate(string $theNewsDate): void {
        $rgx = preg_grep("/^(\d{4})-(\d{2})-([\d]{2}) (\d{2}):([0-5]{1})([0-9]{1}):([0-5]{1})([0-9]{1})$/",[$theNewsDate]);
        if(empty($rgx)){
            print("Le format de la date n'est pas valide");
        }else {
            $this->theNewsDate = $theNewsDate;
        }
    }

    /**
     * $theUser_idtheUser's setter
     * @param int $theUser_idtheUser
     */
    public function settheUser_idtheUser(string $theUser_idtheUser): void {
        $this->theUser_idtheUser = $theUser_idtheUser;
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