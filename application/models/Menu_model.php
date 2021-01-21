<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model {
    public function getPlatsDuJour(){
        $sql = "select Plat.* from Plat 
        join MenuPlat on Plat.id = MenuPlat.idPlat
        join Menu on Menu.id = MenuPlat.idMenu
        where Menu.Date = '2021-01-07'";
        $query = $this->db->query($sql);
        $array = array();
        foreach($query->result_array() as $row){
			$array[]=$row;
		}
        return $array;
    }

    public function getEtudiant($token){
        $sql = "select * from Etudiant where token='%s'";
        $sql = sprintf($sql,$token);
        return $this->db->query($sql)->row_array();
    }

    public function commander($token,$idPlat,$idMenu,$quantite){
        $etudiant = $this->getEtudiant($token);
        if(isset($etudiant['id'])){
            $sql = "insert into Commande(idEtudiant,idMenu,idPlat,quantite) values('%s',%d,%d,%d)";
            $sql = sprintf($sql,$etudiant['id'],$idMenu,$idPlat,$quantite);
            $this->db->query($sql);
        }
        else{
            throw new Exception("Pas d'etudiant");
        }
    }
	public function mettreFavoris($token,$idPlat){
        $etudiant = $this->getEtudiant($token);
        if(isset($etudiant['id'])){
            $sql = "insert into Favoris(idEtudiant,idPlat) values('%s',%d)";
            $sql = sprintf($sql,$etudiant['id'],$idPlat);
            $this->db->query($sql);
        }
        else{
            throw new Exception("Pas d'etudiant");
        }
    }

    public function getCommande($token,$idMenu){
        $sql = "select Commande.id, Plat.id as idPlat, intitule, prix, code, idCategorie, sum(quantite) as quantite from Plat
        join Commande on Plat.id = Commande.idPlat
        where Commande.idMenu=%d and Commande.idEtudiant=(
            select id from Etudiant where token='%s'
        )
        group by Plat.id, intitule, prix, code, idCategorie";
        $sql = sprintf($sql,$idMenu,$token);
        $query = $this->db->query($sql);
        $array = array();
        foreach($query->result_array() as $row){
			$array[]=$row;
		}
        return $array;
    }

    public function modify($idCommande,$qte,$token){
        $etudiant = $this->getEtudiant($token);
        if(!isset($etudiant['id'])){
            throw new Exception("Veuillez vous connecter");
        }
        $sql = "update Commande set quantite=%d where id='%s'";
        $sql = sprintf($sql,$qte,$idCommande);
        $this->db->query($sql);
    }

    public function delete($idCommande,$token){
        $etudiant = $this->getEtudiant($token);
        if(!isset($etudiant['id'])){
            throw new Exception("Veuillez vous connecter");
        }
        $this->db->delete('commande', array('id'=>$idCommande));
    }

    public function getMontant($token,$idMenu){
        $etudiant = $this->getEtudiant($token);
        if(!isset($etudiant['id'])){
            throw new Exception("Veuillez vous connecter");
        }
        $commande = $this->getCommande($token,$idMenu);
        $montant=0;
        foreach($commande as $plat){
            $montant += $plat['quantite']*$plat['prix'];
        }
        return $montant;
    }
	public function getPlatsDetails($plat){
		$sql = "select Plat.id ,intitule,code,prix,idCategorie,nom 
				from Plat join Categorie on Plat.idCategorie=Categorie.id where Plat.id='%s'";
        $sql = sprintf($sql,$plat);
        $query = $this->db->query($sql);
        $array = array();
        foreach($query->result_array() as $row){
			$array[]=$row;
		}
        return $array;
	}
	public function getFavoris($token){
		$etudiant = $this->getEtudiant($token);
        if(!isset($etudiant['id'])){
            throw new Exception("Veuillez vous connecter");
        }
		$sql = "select Favoris.idEtudiant , Favoris.idPlat , Plat.intitule, Plat.prix, Plat.code, Plat.idCategorie  from Plat
        join Favoris on Plat.id = Favoris.idPlat
        where Favoris.idEtudiant=(
            select id from Etudiant where token='%s'
        )";
        $sql = sprintf($sql,$token);
        $query = $this->db->query($sql);
        $array = array();
        foreach($query->result_array() as $row){
			$array[]=$row;
		}
        return $array;
	}
}
?>