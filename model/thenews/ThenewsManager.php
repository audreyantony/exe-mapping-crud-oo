<?php


class ThenewsManager
{
    // EXERCICE créez le manager complet avec la connexion MyPDO en argument et toutes les méthodes nécessaires au CRUD des "thenews"
    private myPDO $db;
    private $idUser;

    public function __construct(myPDO $db) {
        $this->db = $db;
        if (!empty($_SESSION['idtheUser'])) {
            $this->idUser = $_SESSION['idtheUser'];
        }
    }

    public function readAllNews(): Array {
        $sql = "SELECT * FROM thenews ORDER BY theNewsDate DESC";
        $recupAll = $this->db->query($sql);
        if($recupAll->rowCount()) {
            return $recupAll->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }

    public function readTheNewsForUser(): array {
        $read = $this->db->query("SELECT * FROM thenews WHERE theUser_idtheUser = $this->idUser ORDER BY theNewsDate DESC");
        if ($read->rowCount()) {
            return $read->fetchAll(PDO::FETCH_ASSOC);
        }

        return [];
    }

    public function soloNewsById(int $id): Array{
        $sql = "SELECT * FROM thenews WHERE idtheNews=?";
        $prepare = $this->db->prepare($sql);
        $prepare->bindValue(1,$id,PDO::PARAM_INT);
        $prepare->execute();
        if($prepare->rowCount()){
            return $prepare->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function selectTheNewsByAuthor($id): array {
        $sql = "SELECT * FROM thenews WHERE theUser_idtheUser = $id ORDER BY theNewsDate DESC";
        $read = $this->db->query($sql);
        if ($read->rowCount()) {
            return $read->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function selecttheUserLogin($id){
        $sql = "SELECT idtheUser, theUserLogin FROM theuser WHERE idtheUser= ?";
        $request = $this->db->prepare($sql);
        try {
            $request->execute([$id]);
            if ($request->rowCount()) {
                $login = $request->fetch(PDO::FETCH_ASSOC);
                return $login['theUserLogin'];
            }
            return [];
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }

    public function insertNews(Thenews $item){
        $sql = "INSERT INTO thenews (theNewsTitle, theNewsText, theNewsDate, theUser_idtheUser) VALUES (?,?,?,?); ";
        $request = $this->db->prepare($sql);
        try {
            $request->execute([
                    $item->gettheNewsTitle(),
                    $item->gettheNewsText(),
                    $item->gettheNewsDate(),
                    $item->gettheUser_idtheUser()]
            );
            return true;
        } catch (Exception $e){
                return $e->getMessage();
        }
    }

    public function deleteNewsById(int $id) {
        $sql = "DELETE FROM thenews WHERE idtheNews = ?";
        $prepare = $this->db->prepare($sql);
        try{
            $prepare->execute([$id]);
            return true;
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }

    public function updateNewsById(Thenews $item, int $idNews){
        if($idNews == $item->getidtheNews()){
            $sql = "UPDATE thenews SET theNewsTitle = :titleNews,theNewsText= :textNews, theNewsDate= :dateNews WHERE idtheNews = :idNews";
            $prepare= $this->db->prepare($sql);
            $prepare->bindValue("titleNews",$item->gettheNewsTitle(),PDO::PARAM_STR);
            $prepare->bindValue("textNews",$item->gettheNewsText(),PDO::PARAM_STR);
            $prepare->bindValue("dateNews",$item->gettheNewsDate(),PDO::PARAM_STR);
            $prepare->bindValue("idNews",$idNews,PDO::PARAM_INT);
            try{
                $prepare->execute();
                return true;
            }catch (PDOException $e){
                return $e->getMessage();
            }
        }else{
            return "Hey, touche pas à ça. Vilain.e";
        }
    }

    public static function cutTheText(string $text, int $nbChars): string{
        $cutText = substr($text,0,$nbChars);
        return $cutText = substr($cutText,0,strrpos($cutText," "));
    }

    public static function nl2br(string $text): string {
        return nl2br($text);
    }
}